<?php

namespace App\Console\Commands;

use App\Helper\Helper;
use Illuminate\Console\Command;
use App\Models\Booking;
use App\Models\SetPrices;
use App\Models\SetPricesDaysSlots;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AutoCancelBooking extends Command
{
    protected $signature = 'bookings:cancel';

    protected $description = 'Command description';

    public function handle()
    {

        // Example - 1 >> If the customer is creating a booking at "11:00 AM, 11 July 2023" for "10:00 PM, 11-07-2023" with "Full payment" of "$100" then, the Customer will be able to Cancel the booking within 2 hours of "Booking create time(11:00 AM, 11 July 2023)" which is "01:00 PM, 11 July 2023". and customer will get "Full amount($100)" as Refund Right??

        // Example - 2 >> If the customer is creating a booking at "11:00 AM, 11 July 2023" for "10:00 PM, 11-07-2023" with a "Split payment" of "$50" where the Full payment is $100, then the Customer will be able to Cancel the booking within 2 hours of "Booking create time(11:00 AM, 11 July 2023)" which is "01:00 PM, 11 July 2023". and customer will get "Total paid amount($50)" as Refund right??

        // dd(date('Y-m-d h:i A',strtotime($created_at_plus_2_hours)),date('Y-m-d h:i A',strtotime($now)),$created_at_plus_2_hours->lessThan($now));
        // $payment_time_limit = Carbon::parse($bookingdata->start_date . ' ' . $bookingdata->start_time)->subHours(2);

        date_default_timezone_set(config('app.timezone'));
        $title = 'Booking cancelled - Payment not made';
        $description = "We're sorry to inform you that your booking has been cancelled due to not making payment on time. We would have loved to have you stay with us, but unfortunately we were unable to hold the Slots for you any longer.";
        $getbookings = Booking::where('payment_type', '2')->where('booking_status', 2)->get();
        foreach ($getbookings as $bookingdata) {
            $created_at = Carbon::parse($bookingdata->created_at);
            $booking_at = Carbon::parse($bookingdata->start_date . ' ' . $bookingdata->start_time);
            $now = Carbon::now();
            if ($created_at->diffInHours($booking_at) < 2) {
                $payment_time_limit = $booking_at;
                if ($now->greaterThan($payment_time_limit)) {
                    $bookingdata->cancelled_by = 1;
                    $bookingdata->booking_status = 3;
                    $bookingdata->save();
                    Helper::booking_cancelled_email($title, $description, $bookingdata, 1);
                    $this->info("=====================================");
                    $this->info("\n created_at ---> " . date('Y-m-d h:i A', strtotime($created_at)) . "\n booking_at ---> " . date('Y-m-d h:i A', strtotime($booking_at)) . "\n payment_time_limit ---> " . date('Y-m-d h:i A', strtotime($payment_time_limit)));
                    $this->info('===== Booking Cancelled Without Refund due to time limitation =====> ' . $bookingdata->id);
                    $this->info("=====================================");
                }
            } else {
                $created_at_plus_2_hours = Carbon::parse($bookingdata->created_at)->addHours(2);
                $now = Carbon::now();
                if ($created_at_plus_2_hours->lessThan($now)) {
                    if ($bookingdata->paid_amount != $bookingdata->total_amount) {
                        $refund = Helper::refund_cancel_booking($bookingdata->id);
                        if ($refund == 1) {
                            $bookingdata->cancelled_by = 1;
                            $bookingdata->save();
                            $bdata = Booking::find($bookingdata->id);
                            Helper::booking_cancelled_email($title, $description, $bdata, 1);
                            $this->info('Booking Cancelled & Refunded =====> ' . $bookingdata->id);
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
                    } else {
                        $this->info(' =====> ' . $bookingdata->id);
                    }
                }
            }
        }
    }
}
