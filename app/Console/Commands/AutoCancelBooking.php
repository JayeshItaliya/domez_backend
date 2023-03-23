<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;

class AutoCancelBooking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:cancel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $getbookings = Booking::where('payment_type', '2')->get();
        // return $getbookings;
        foreach ($getbookings as $booking) {

            // payment_status == 1 == Complete
            // payment_status == 2 == Partial

            $createdTime = Carbon::parse($booking->created_at);
            $currentTime = Carbon::parse($booking->start_date);

            $hoursDiff = $createdTime->diffInHours($currentTime);

            if ($hoursDiff > 24 && $booking->payment_status == 2) {
                $booking->booking_status = 3;
                $booking->save();
            }

            if ($hoursDiff <= 24) {
                $start_date_time = Carbon::createFromFormat('Y-m-d h:i A', $booking->start_date . ' ' . $booking->start_time);
                $current_date_time = Carbon::now();
                if ($start_date_time->lessThan($current_date_time) == true && $booking->payment_status == 2) {
                    $booking->booking_status = 3441;
                    $booking->save();
                }
                $booking->team_name = $start_date_time.'--'.$current_date_time;
                // $booking->team_name = $start_date_time->lessThan($current_date_time) == true ? $hoursDiff.'--111' : $hoursDiff.'--222' ;
                $booking->save();
            }
        }
        $this->info('Updated ' . $getbookings->count() . ' bookings.');
    }
}
