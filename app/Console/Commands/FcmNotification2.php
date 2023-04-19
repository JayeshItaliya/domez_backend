<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Helper\Helper;

class FcmNotification2 extends Command
{
    protected $signature = 'FCM:Notifcation:2';
    protected $description = 'Send Notitification One Day Before to League Booked Users To Notify That League Is going To Start Tomorrow';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $bookings = Booking::where('type', 2)->whereDate('start_date', Carbon::now()->addDay()->format('Y-m-d'))->get();
        foreach ($bookings as $booking) {
            $type = 2;
            $title = "Hello! A League that you've booked is starting tomorrow.";
            $body = 'Get ready to show your skills and have a great time with fellow participants! Good luck and have a blast!';
            $tokens[] = $booking->user_info->fcm_token;
            Helper::send_notification($title, $body, $type, $booking->booking_id, '', $tokens);
            $this->info(' Sended Notification For BOOKIN_ID(' . $booking->id.') To USER('.$booking->user_info->id.')');
        }
    }
}
