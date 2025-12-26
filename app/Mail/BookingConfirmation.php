<?php

namespace App\Mail;

use App\Models\Booking;
use App\Models\CustomPackage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $package;
    public $user;
    public $checkInTime;
    public $checkOutTime;

    public function __construct(Booking $booking, CustomPackage $package, $user)
    {
        $this->booking = $booking;
        $this->package = $package;
        $this->user = $user;
        
        // Set check-in/check-out times based on package type
        $this->setTimes();
    }

    private function setTimes()
    {
        $packageType = $this->package->type ?? 'full_board';
        
        switch ($packageType) {
            case 'day_out':
                $this->checkInTime = '9:00 AM';
                $this->checkOutTime = '5:00 PM';
                break;
            case 'half_board':
                $this->checkInTime = '3:00 PM';
                $this->checkOutTime = '10:00 AM';
                break;
            case 'full_board':
            default:
                $this->checkInTime = '3:00 PM';
                $this->checkOutTime = '3:00 PM';
                break;
        }
    }

    public function build()
    {
        return $this->subject('Booking Confirmation - Soba Lanka Hotel')
                    ->view('emails.booking-confirmation');
    }
}
