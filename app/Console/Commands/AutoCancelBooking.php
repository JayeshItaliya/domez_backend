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
        // Carbon::createFromFormat('h:i A', date('h:i A', strtotime($booking->start_time)), 'UTC')->format('H:i')
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

    // public function handle()
    // {
    //     $getbookings = Booking::where('payment_type', '2')->where('booking_status', 2)->get();
    //     foreach ($getbookings as $booking) {

    //         // payment_status == 1 == Complete
    //         // payment_status == 2 == Partial

    //         $createdTime = Carbon::parse($booking->created_at);
    //         $currentTime = Carbon::parse($booking->start_date . ' ' . date('h:i A', strtotime($booking->start_time)));

    //         $getSecDiff = $createdTime->diffInSeconds($currentTime);

    //         if ($getSecDiff > 2 * 60 * 60 && $booking->payment_status == 2) {
    //             $booking->booking_status = 3;
    //             $booking->save();
    //             $this->info('============' . $getSecDiff . '============');
    //         }

    //         if ($getSecDiff <= 2 * 60 * 60) {
    //             $start_date_time = Carbon::createFromFormat('Y-m-d h:i A', $booking->start_date . ' ' . date('h:i A', strtotime($booking->start_time)));
    //             $now = Carbon::now();
    //             $current_date_time = $now->format('Y-m-d h:i A');
    //             if ($start_date_time->lessThan($current_date_time) == true && $booking->payment_status == 2) {
    //                 // $booking->booking_status = 3;
    //                 // $booking->save();
    //                 $this->info('---------');
    //                 $this->info('Booking Updated =====> ' . $booking->id);
    //                 $this->info('---------');
    //             }
    //             $islessthen = $start_date_time->lessThan($current_date_time) == true ? "true" : 'false';
    //             $this->info('---------');
    //             $this->info('Booking           =====> ' . $booking->id);
    //             $this->info('start_date_time   =====> ' . $start_date_time);
    //             $this->info('current_date_time =====> ' . $current_date_time);
    //             $this->info('DIFF              =====> ' . $start_date_time->diffInSeconds($current_date_time));
    //             $this->info('islessthen        =====> ' . $islessthen);
    //             $this->info('---------');
    //         }
    //         $this->info('---------' . $getSecDiff . '---------');
    //     }
    //     // $getbookings = Booking::where('status', 'pending')->where('created_at', '<', now()->subMinutes(10))->get();
    //     // $this->info('Bookings. --> ' . implode(',', $getbookings->pluck('booking_id')->toArray()));
    // }
}
