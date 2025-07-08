<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentRescheduled extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $day;
    public $time;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $day, $time)
    {
        $this->name = $name;
        $this->day = $day;
        $this->time = $time;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your Appointment Has Been Rescheduled')
                    ->view('emails.reschedule');
    }
}
