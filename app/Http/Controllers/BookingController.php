<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\CustomPackage;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function create(Room $room)
    {
        return view('bookings.create', compact('room'));
    }

    public function store(Request $request, Room $room)
    {
        $validated = $request->validate([
            'guest_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        $nights = \Carbon\Carbon::parse($validated['check_in'])
            ->diffInDays($validated['check_out']);
        
        $booking = new Booking($validated);
        $booking->room_id = $room->id;
        $booking->total_price = $room->price_per_night * $nights;
        $booking->status = 'pending';
        $booking->save();

        return redirect()->route('bookings.confirmation', $booking)
            ->with('success', 'Booking created successfully.');
    }

    public function confirmation(Booking $booking)
    {
        return view('bookings.confirmation', compact('booking'));
    }

    public function reviewPackage()
    {
        $bookingData = session('pending_booking');

        if (!$bookingData) {
            return redirect()->route('package-builder')
                ->with('error', 'Session expired. Please build your package again.');
        }

        $package = CustomPackage::findOrFail($bookingData['package_id']);

        return view('bookings.package-review', compact('bookingData', 'package'));
    }

    /**
     * Step 2: Show Payment Method Selection
     */
    public function showPaymentMethod()
    {
        $bookingData = session('pending_booking');

        if (!$bookingData) {
            return redirect()->route('package-builder')
                ->with('error', 'Session expired. Please build your package again.');
        }

        $package = CustomPackage::findOrFail($bookingData['package_id']);

        return view('bookings.payment-method', compact('bookingData', 'package'));
    }

    /**
     * Step 3: Save to Database with Payment Info
     */
    public function storePackage(Request $request)
    {
        $data = session('pending_booking');

        if (!$data) {
            return redirect()->route('package-builder');
        }

        $paymentMethod = $request->input('payment_method', 'bank_transfer');
        $paymentReceipt = null;
        $paymentStatus = 'pending';

        // Handle receipt upload if provided
        if ($request->hasFile('payment_receipt')) {
            $file = $request->file('payment_receipt');
            $filename = 'receipt_' . time() . '_' . auth()->id() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/receipts', $filename);
            $paymentReceipt = 'receipts/' . $filename;
            $paymentStatus = 'uploaded';
        }

        // Create the Booking in Database
        $booking = Booking::create([
            'user_id'           => auth()->id(),
            'custom_package_id' => $data['package_id'],
            'check_in'          => $data['check_in'],
            'check_out'         => $data['check_out'],
            'guests'            => $data['adults'],
            'total_price'       => $data['total_price'],
            'status'            => 'pending',
            'payment_method'    => $paymentMethod,
            'payment_receipt'   => $paymentReceipt,
            'payment_status'    => $paymentStatus,
            'package_details'   => [
                'adults'   => $data['adults'],
                'children' => $data['children'] ?? 0
            ]
        ]);

        // Send email notification to customer
        $user = auth()->user();
        $package = CustomPackage::find($data['package_id']);
        
        $paymentInfo = $paymentMethod === 'bank_transfer' 
            ? "Payment Method: Bank Transfer\nPayment Status: " . ($paymentReceipt ? "Receipt Uploaded" : "Awaiting Receipt") 
            : "Payment Method: Card (Pending)";

        try {
            Mail::raw(
                "Dear {$user->name},\n\n" .
                "Thank you for your booking at Soba Lanka Hotel!\n\n" .
                "Booking Details:\n" .
                "Booking ID: #{$booking->id}\n" .
                "Package: {$package->name}\n" .
                "Check-in: {$booking->check_in}\n" .
                "Check-out: {$booking->check_out}\n" .
                "Guests: {$data['adults']} Adults" . (isset($data['children']) && $data['children'] > 0 ? ", {$data['children']} Children" : "") . "\n" .
                "Total Price: Rs {$booking->total_price}\n\n" .
                "{$paymentInfo}\n\n" .
                "Bank Account Details for Payment:\n" .
                "Account Name: Soba Lanka Holiday Resort (PVT) LTD\n" .
                "Account Number: 0090201000175926\n" .
                "Bank: Union Bank of Colombo PLC\n" .
                "Branch: Kurunegala\n\n" .
                "Please use Booking #{$booking->id} as your payment reference.\n" .
                "You can upload your payment receipt from your profile page.\n\n" .
                "Best regards,\n" .
                "Soba Lanka Hotel Team",
                function($msg) use ($user) {
                    $msg->to($user->email)
                        ->subject('Booking Confirmation - Soba Lanka Hotel');
                }
            );

            $adminEmail = config('mail.admin_email');
            Mail::raw(
                "New Booking Received!\n\n" .
                "Booking Details:\n" .
                "Booking ID: #{$booking->id}\n" .
                "Customer: {$user->name}\n" .
                "Email: {$user->email}\n" .
                "Package: {$package->name}\n" .
                "Check-in: {$booking->check_in}\n" .
                "Check-out: {$booking->check_out}\n" .
                "Guests: {$data['adults']} Adults" . (isset($data['children']) && $data['children'] > 0 ? ", {$data['children']} Children" : "") . "\n" .
                "Total Price: Rs {$booking->total_price}\n\n" .
                "{$paymentInfo}\n\n" .
                "Please review and confirm this booking.",
                function($msg) use ($adminEmail) {
                    $msg->to($adminEmail)
                        ->subject('New Booking Notification - Soba Lanka Hotel');
                }
            );
        } catch (\Exception $e) {
            \Log::error('Booking email failed: ' . $e->getMessage());
        }

        session()->forget('pending_booking');

        return redirect()->route('bookings.success', $booking);
    }

    /**
     * Show booking success page
     */
    public function showSuccess(Booking $booking)
    {
        // Ensure user owns this booking
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $booking->load('customPackage');
        
        return view('bookings.success', compact('booking'));
    }

    /**
     * Upload payment receipt for existing booking
     */
    public function uploadReceipt(Request $request, Booking $booking)
    {
        // Ensure user owns this booking
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'payment_receipt' => 'required|file|max:5120'
        ]);

        $file = $request->file('payment_receipt');
        
        if (!$file) {
            return redirect()->back()->with('error', 'No file was uploaded. Please select a file.');
        }

        // Check file extension manually for better error messages
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, $allowedExtensions)) {
            return redirect()->back()->with('error', 'Invalid file type. Please upload JPG, PNG, GIF or PDF files only.');
        }

        try {
            // Delete old receipt if exists
            if ($booking->payment_receipt) {
                \Storage::delete('public/' . $booking->payment_receipt);
            }

            $filename = 'receipt_' . time() . '_' . $booking->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/receipts', $filename);
            
            if (!$path) {
                return redirect()->back()->with('error', 'Failed to store the file. Please try again.');
            }
            
            $booking->update([
                'payment_receipt' => 'receipts/' . $filename,
                'payment_status' => 'uploaded'
            ]);

            return redirect()->back()->with('success', 'Payment receipt uploaded successfully!');
        } catch (\Exception $e) {
            \Log::error('Receipt upload failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Upload failed: ' . $e->getMessage());
        }
    }

    // --- Admin: View All Bookings ---
    public function index()
    {
        // Fetch all bookings with their related User and Package data
        // Ordered by newest first
        $bookings = Booking::with(['user', 'customPackage', 'room'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.bookings.index', compact('bookings'));
    }

    // --- Admin: Update Booking Status (Confirm/Cancel) ---
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        $booking->update(['status' => $validated['status']]);

        return redirect()->back()->with('success', 'Booking status updated successfully.');
    }
    
    // --- Admin: Delete Booking ---
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->back()->with('success', 'Booking deleted successfully.');
    }
}