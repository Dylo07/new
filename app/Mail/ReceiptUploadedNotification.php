<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReceiptUploadedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $user;
    public $package;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
        $this->user = $booking->user;
        $this->package = $booking->customPackage;
    }

    public function build()
    {
        return $this->subject('Payment Receipt Uploaded - Booking #' . $this->booking->id)
                    ->view('emails.receipt-uploaded-notification');
    }
}
