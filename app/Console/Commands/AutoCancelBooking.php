<?php

namespace App\Console\Commands;

use App\Helper\Helper;
use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class AutoCancelBooking extends Command
{
    protected $signature = 'bookings:cancel';

    protected $description = 'Command description';

    public function handle()
    {
        date_default_timezone_set('Asia/Kolkata');
        $getbookings = Booking::where('payment_type', '2')->where('booking_status', 2)->get();
        foreach ($getbookings as $booking) {
            $created_at_plus_2_hours = Carbon::parse($booking->created_at)->addHours(2);
            $now = Carbon::now();
            if ($created_at_plus_2_hours->lessThan($now)) {
                if ($booking->paid_amount != $booking->total_amount) {
                    $refund = Helper::refund_cancel_booking($booking->id);
                    if ($refund == 1) {
                        $this->info('Booking Updated & Refunded =====> ' . $booking->id);
                    } else {
                        $this->info('Something Went Wrong While Refunding Amount (Booking Status Not Change) =====> ' . $booking->id);
                    }
                }
            } else {
                $start_date_time = Carbon::parse($booking->start_date . ' ' . $booking->start_time);
                $current_date_time = Carbon::now();
                if ($start_date_time->lessThan($current_date_time) == true && $booking->payment_status == 2) {
                    $refund = Helper::refund_cancel_booking($booking->id);
                    $data = ['title' => 'Booking Cancelled - Payment Not Made', 'email' => $booking->customer_email, 'bookingdata' => $booking];

                    Mail::send('email.auto_booking_cancel', $data, function ($message) use ($data) {
                        $message->from($data['email'])->subject($data['title']);
                        $message->to(env('MAIL_USERNAME'));
                    });
                    if ($refund == 1) {
                        $this->info('Booking Updated & Refunded =====> ' . $booking->id);
                    } else {
                        $this->info('Something Went Wrong While Refunding Amount (Booking Status Not Change) =====> ' . $booking->id);
                    }
                }
            }
        }
    }
}
