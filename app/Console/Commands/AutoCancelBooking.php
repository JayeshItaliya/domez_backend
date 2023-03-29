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
        // date_default_timezone_set('Asia/Kolkata');
        $getbookings = Booking::where('payment_type', '2')->where('booking_status', 2)->get();
        foreach ($getbookings as $booking) {

            // payment_status == 1 == Complete
            // payment_status == 2 == Partial

            $createdTime = Carbon::parse($booking->created_at);
            $currentTime = Carbon::parse($booking->start_date . ' ' . date('h:i A', strtotime($booking->start_time)));

            $hoursDiff = $createdTime->diffInHours($currentTime);

            if ($hoursDiff > 24 && $booking->payment_status == 2) {
                $booking->booking_status = 3;
                $booking->save();
            }

            if ($hoursDiff <= 24) {
                $start_date_time = Carbon::createFromFormat('Y-m-d h:i A', $booking->start_date . ' ' . date('h:i A', strtotime($booking->start_time)));
                $now = Carbon::now();
                $current_date_time = $now->format('Y-m-d h:i A');
                if ($start_date_time->lessThan($current_date_time) == true && $booking->payment_status == 2) {
                    $booking->booking_status = 3;
                    $booking->save();
                    $this->info('---------');
                    $this->info('Booking Updated =====> ' . $booking->id);
                    $this->info('---------');
                }
                $islessthen = $start_date_time->lessThan($current_date_time) == true ? "true" : 'false' ;
                $this->info('Booking =====> ' . $booking->id . ' ** ' . $start_date_time . ' -- ' . $current_date_time . ' == ' . $start_date_time->diffInHours($current_date_time) . ' ____ ' . $islessthen);
            }
        }
        // $getbookings = Booking::where('status', 'pending')->where('created_at', '<', now()->subMinutes(10))->get();
        // $this->info('Bookings. --> ' . implode(',', $getbookings->pluck('booking_id')->toArray()));
    }
}
