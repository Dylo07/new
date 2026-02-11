<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\CustomPackage;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;
use App\Mail\AdminBookingNotification;
use App\Mail\ReceiptUploadedNotification;
use App\Mail\BookingConfirmedMail;
use App\Models\Lead;

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
            
            // Create directory if it doesn't exist - same pattern as gallery uploads
            $uploadDir = public_path('storage/receipts');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            // Move file directly to public/storage/receipts (same as gallery)
            $file->move($uploadDir, $filename);
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

        // Mark any matching lead as converted
        try {
            $lead = Lead::where('user_id', auth()->id())
                ->whereIn('status', ['started', 'browsing', 'reviewed', 'paid'])
                ->orderBy('updated_at', 'desc')
                ->first();

            if ($lead) {
                $lead->markAsConverted($booking->id);
            }
        } catch (\Exception $e) {
            \Log::error('Lead conversion tracking failed: ' . $e->getMessage());
        }

        // Send email notification to customer
        $user = auth()->user();
        $package = CustomPackage::find($data['package_id']);
        
        try {
            // Send modern HTML email to customer
            Mail::to($user->email)->send(new BookingConfirmation($booking, $package, $user));

            // Send modern HTML email to admin
            $adminEmail = config('mail.admin_email');
            Mail::to($adminEmail)->send(new AdminBookingNotification($booking, $package, $user));
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
                $oldPath = public_path('storage/' . $booking->payment_receipt);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $filename = 'receipt_' . time() . '_' . $booking->id . '.' . $file->getClientOriginalExtension();
            
            // Create directory if it doesn't exist - same pattern as gallery uploads
            $uploadDir = public_path('storage/receipts');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            // Move file directly to public/storage/receipts (same as gallery)
            $file->move($uploadDir, $filename);
            
            $booking->update([
                'payment_receipt' => 'receipts/' . $filename,
                'payment_status' => 'uploaded'
            ]);

            // Send email notification to admin about receipt upload
            try {
                $booking->load(['user', 'customPackage']);
                $adminEmail = config('mail.admin_email');
                Mail::to($adminEmail)->send(new ReceiptUploadedNotification($booking));
            } catch (\Exception $e) {
                \Log::error('Receipt upload notification email failed: ' . $e->getMessage());
            }

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
        // Prioritize: pending bookings with uploaded receipts first, then by date
        $bookings = Booking::with(['user', 'customPackage', 'room'])
            ->orderByRaw("CASE 
                WHEN status = 'pending' AND payment_status = 'uploaded' THEN 0 
                WHEN status = 'pending' THEN 1 
                ELSE 2 
            END")
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

        // Send confirmation email to customer when status changes to confirmed
        if ($validated['status'] === 'confirmed') {
            $this->sendBookingConfirmedEmail($booking);
        }

        return redirect()->back()->with('success', 'Booking status updated successfully.');
    }

    // --- Admin: Quick Approve (Confirm + Verify Payment in one click) ---
    public function quickApprove(Booking $booking)
    {
        $booking->update([
            'status' => 'confirmed',
            'payment_status' => 'verified'
        ]);

        // Send confirmation email to customer
        $this->sendBookingConfirmedEmail($booking);

        return redirect()->back()->with('success', 'Booking #' . $booking->id . ' approved and payment verified!');
    }

    // --- Send Booking Confirmed Email to Customer ---
    private function sendBookingConfirmedEmail(Booking $booking)
    {
        try {
            $booking->load(['user', 'customPackage']);
            if ($booking->user && $booking->user->email) {
                Mail::to($booking->user->email)->send(new BookingConfirmedMail($booking));
            }
        } catch (\Exception $e) {
            \Log::error('Booking confirmed email failed: ' . $e->getMessage());
        }
    }
    
    // --- Admin: Delete Booking ---
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->back()->with('success', 'Booking deleted successfully.');
    }
}