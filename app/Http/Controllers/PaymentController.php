<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Create a PayHere Checkout Form
     */
    public function checkout(Request $request, Booking $booking)
    {
        // Ensure user owns this booking
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if already paid
        if ($booking->payment_status === 'paid' || $booking->payment_status === 'verified') {
            return redirect()->route('bookings.my-bookings')->with('error', 'This booking has already been paid for.');
        }

        $merchant_id = config('services.payhere.merchant_id');
        $merchant_secret = config('services.payhere.secret');
        $currency = 'LKR';
        $amount = number_format($booking->total_price, 2, '.', '');
        $order_id = $booking->id;

        // Generate PayHere Hash
        $hash = strtoupper(
            md5(
                $merchant_id . 
                $order_id . 
                $amount . 
                $currency . 
                strtoupper(md5($merchant_secret))
            )
        );

        $itemName = $booking->room ? $booking->room->name : ($booking->package ? $booking->package->name : 'Hotel Booking');
        $env = config('services.payhere.env', 'sandbox');
        $actionUrl = $env === 'production' 
            ? 'https://www.payhere.lk/pay/checkout' 
            : 'https://sandbox.payhere.lk/pay/checkout';

        // Prepare data for the view to auto-submit
        $payhereData = [
            'merchant_id' => $merchant_id,
            'return_url' => route('payment.success', ['booking' => $booking->id]),
            'cancel_url' => route('payment.cancel', ['booking' => $booking->id]),
            'notify_url' => route('payment.webhook'),
            'order_id' => $order_id,
            'items' => 'Booking ID: ' . $booking->id . ' - ' . $itemName,
            'currency' => $currency,
            'amount' => $amount,
            'first_name' => auth()->user()->name,
            'last_name' => '', // Split name if needed, but PayHere accepts empty last_name
            'email' => auth()->user()->email,
            'phone' => auth()->user()->phone ?? '000000000',
            'address' => 'Sri Lanka',
            'city' => 'Colombo',
            'country' => 'Sri Lanka',
            'hash' => $hash,
        ];

        return view('bookings.payhere-checkout', compact('actionUrl', 'payhereData'));
    }

    /**
     * Handle successful payment redirection
     */
    public function success(Request $request, Booking $booking)
    {
        // PayHere handles actual status updates via webhook, 
        // this is just for the user experience redirect
        return redirect()->route('bookings.my-bookings')->with('success', 'Payment processing. It will be confirmed shortly.');
    }

    /**
     * Handle cancelled payment redirection
     */
    public function cancel(Request $request, Booking $booking)
    {
        return redirect()->route('bookings.my-bookings')->with('error', 'Payment was cancelled. You can try again later.');
    }

    /**
     * Handle PayHere Webhook Notification
     */
    public function webhook(Request $request)
    {
        $merchant_id         = request('merchant_id');
        $order_id            = request('order_id');
        $payhere_amount      = request('payhere_amount');
        $payhere_currency    = request('payhere_currency');
        $status_code         = request('status_code');
        $md5sig              = request('md5sig');
        $payment_id          = request('payment_id');

        $merchant_secret = config('services.payhere.secret');

        $local_md5sig = strtoupper(
            md5(
                $merchant_id . 
                $order_id . 
                $payhere_amount . 
                $payhere_currency . 
                $status_code . 
                strtoupper(md5($merchant_secret))
            )
        );

        if (($local_md5sig === $md5sig) && ($status_code == 2) ) {
            // Valid Payment
            $booking = Booking::find($order_id);
            if ($booking) {
                $booking->payment_status = 'paid';
                $booking->status = 'confirmed';
                $booking->amount_paid = $payhere_amount;
                $booking->payment_method = 'card';
                $booking->payment_gateway_id = $payment_id;
                $booking->save();
            }
        } else {
            Log::warning('PayHere Signature Mismatch or Failed Payment', request()->all());
        }

        return response()->json(['status' => 'success']);
    }
}
