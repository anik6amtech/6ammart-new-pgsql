<?php

namespace Modules\Service\Mail\BookingModule;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Service\Entities\BookingModule\Booking;

class BookingMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected Booking $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        $pdf = PDF::loadView('service::admin.BookingModule.invoice', ['booking' => $this->booking]);
        return $this->subject(translate('Booking Place'))->view('service::mail-templates.booking-module.booking-request-sent', ['booking' => $this->booking])->attachData($pdf->output(), "invoice.pdf");
    }
}
