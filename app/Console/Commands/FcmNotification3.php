<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;
use App\Helper\Helper;
use App\Models\Review;

class FcmNotification3 extends Command
{
    protected $signature = 'FCM:Notifcation:3';
    protected $description = 'Send Notification to User to notify to add the review When User has not added The Review On Booking End time';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $bookings = Booking::where('type', 2)->where('is_review_noti_send', 2)->whereDate('start_date', Carbon::now()->format('Y-m-d'))->whereTime('end_time', '<', Carbon::now()->format('H:i'))->get();
        foreach ($bookings as $booking) {
            $is_ratting_exist = Review::where('dome_id', $booking->dome_id)->where('user_id', $booking->user_id)->first();
            if (empty($is_ratting_exist)) {
                $booking->is_review_noti_send = 1;
                $booking->save();
                $type = 3;
                $title = "We Value Your Feedback!";
                $body = 'We would greatly appreciate it if you could spare a few moments to share your feedback by leaving a review';
                $tokens[] = $booking->user_info->fcm_token;
                Helper::send_notification($title, $body, $type, $booking->booking_id, '', $tokens);
                $this->info(' Sended Notification For Review to BOOKIN_ID(' . $booking->id . ') And USER(' . $booking->user_info->id . ')');
            }
        }
    }
}
