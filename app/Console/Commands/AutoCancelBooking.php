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
        date_default_timezone_set(env('SET_TIMEZONE'));
        $title = 'Booking Cancelled - Payment Not Made';
        $description = "We're sorry to inform you that your booking has been cancelled due to not making payment on time. We would have loved to have you stay with us, but unfortunately we were unable to hold the Slots for you any longer.";
        $getbookings = Booking::where('payment_type', '2')->where('booking_status', 2)->get();
        foreach ($getbookings as $bookingdata) {
            $created_at_plus_2_hours = Carbon::parse($bookingdata->created_at)->addHours(2);
            $now = Carbon::now();
            if ($created_at_plus_2_hours->lessThan($now)) {
                if ($bookingdata->paid_amount != $bookingdata->total_amount) {
                    $refund = Helper::refund_cancel_booking($bookingdata->id);
                    if ($refund == 1) {
                        $bookingdata->cancelled_by = 1;
                        $bookingdata->save();
                        Helper::booking_cancelled_email($title, $description, $bookingdata, 1);
                        $this->info('Booking Updated & Refunded =====> ' . $bookingdata->id);
                    } else {
                        $this->info('Something Went Wrong While Refunding Amount (Booking Status Not Change) =====> ' . $bookingdata->id);
                    }
                }
            } else {
                $start_date_time = Carbon::parse($bookingdata->start_date . ' ' . $bookingdata->start_time);
                $current_date_time = Carbon::now();
                if ($start_date_time->lessThan($current_date_time) == true && $bookingdata->payment_status == 2) {
                    $refund = Helper::refund_cancel_booking($bookingdata->id);
                    if ($refund == 1) {
                        $bookingdata->cancelled_by = 1;
                        $bookingdata->save();
                        Helper::booking_cancelled_email($title, $description, $bookingdata, 1);
                        $this->info('Booking Updated & Refunded =====> ' . $bookingdata->id);
                    } else {
                        $this->info('Something Went Wrong While Refunding Amount (Booking Status Not Change) =====> ' . $bookingdata->id);
                    }
                }
            }
        }
    }
}
