<?php

namespace Modules\Service\Listeners;

use Illuminate\Support\Facades\Mail;
use Modules\Service\Events\BookingRequested;
use Modules\Service\Mail\BookingModule\BookingMail;

class SendBookingRequestEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param BookingRequested $event
     * @return void
     */
    public function handle(BookingRequested $event)
    {

        /* $notification= isNotificationActive(null, 'booking', 'notification', 'user');
        $repeatOrRegular = $event->booking?->is_repeated ? 'repeat' : 'regular';
        $title = get_push_notification_message('user_booking_place', $event->booking?->customer?->current_language_key);
        if (isset($event->booking->customer->cm_firebase_token) && $title && $notification) {
            device_notification($event->booking->customer->cm_firebase_token, $title, null, null, $event->booking->id, 'booking', '', '', '', '', $repeatOrRegular);
        } */

        try {
            $email = isNotificationActive(null, 'booking', 'email', 'user');
            $emailServices =  config('mail.status');
            if (isset($event->booking->customer->email) && $emailServices && $email) {
                Mail::to($event->booking->customer->email)->send(new BookingMail($event->booking));
            }
        } catch (\Exception $exception) {
            info($exception);
        }

    }
}
