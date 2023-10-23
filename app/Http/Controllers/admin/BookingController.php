<?php

namespace App\Http\Controllers\admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Domes;
use App\Models\SetPricesDaysSlots;
use App\Models\Sports;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bname = basename(request()->url());
        $now = CarbonImmutable::today();
        $weekStartDate = $now->startOfWeek();
        $weekEndDate = $now->endOfWeek();
        $getbookingslist = Booking::select('*');
        if ($bname == 'autometic-bookings') {
            $getbookingslist = $getbookingslist->where('booking_mode', 1);
        }
        if ($bname == 'bookings-requests') {
            $getbookingslist = $getbookingslist->where('booking_mode', 2);
        }
        $authuser = auth()->user();
        if (in_array($authuser->type, [2, 4])) {
            $getbookingslist = $getbookingslist->where('vendor_id', $authuser->type == 2 ? $authuser->id : $authuser->vendor_id);
        }
        if ($authuser->type == 5) {
            $getbookingslist = $getbookingslist->where('provider_id', $authuser->id);
        }
        if ($request->has('type') && in_array($request->type, ['domes', 'leagues'])) {
            if ($request->type == 'domes') {
                $getbookingslist = $getbookingslist->where('dome_id', '!=', '')->where('league_id', '=', '');
            }
            if ($request->type == 'leagues') {
                $getbookingslist = $getbookingslist->where('league_id', '!=', '');
            }
        }
        if ($request->has('filter') && $request->filter != "") {
            if ($request->filter == 'this-month') {
                $getbookingslist = $getbookingslist->whereMonth('start_date', Carbon::now()->month);
            } else if ($request->filter == 'this-year') {
                $getbookingslist = $getbookingslist->whereYear('start_date', Carbon::now()->year);
            } else if ($request->filter == 'custom-date') {
                $weekStartDate = @explode(' to ', $request->dates)[0];
                $weekEndDate = @explode(' to ', $request->dates)[1];
                if ($weekStartDate != "" && $weekEndDate != "") {
                    $getbookingslist = $getbookingslist->whereBetween('start_date', [$weekStartDate, $weekEndDate]);
                } else {
                    $getbookingslist = $getbookingslist->whereDate('start_date', $weekStartDate);
                }
            } else {
                $getbookingslist = $getbookingslist->whereBetween('start_date', [$weekStartDate, $weekEndDate]);
            }
        }
        $getbookingslist = $getbookingslist->orderByDesc('id')->get();
        return view('admin.bookings.index', compact('getbookingslist'));
    }
    public function calendar(Request $request)
    {
        $getbookingslist = Booking::orderByDesc('id')->get();
        $authuser = auth()->user();
        if ($authuser->type == 1) {
            $getbookingslist = Booking::where('vendor_id', $authuser->type == 2 ? $authuser->id : $authuser->vendor_id)->orderByDesc('id')->get();
        }
        return view('admin.bookings.calendar', compact('getbookingslist'));
    }
    public function details(Request $request)
    {
        $bookingdata = Booking::where('booking_id', $request->booking_id)->first();
        abort_if(empty($bookingdata), 404);
        if ($request->ajax()) {
            try {
                if ($request->has('manage_slot') && $request->manage_slot == 1) {
                    $slot_price = $request->slot_price;
                    $slot_time = $request->slot_time;
                    $slot = $request->slot;
                    $old_slot_id = $request->old_slot_id;
                    $new_slot_id = $request->new_slot_id;
                    $checkoldslot = SetPricesDaysSlots::where('id', $request->old_slot_id)->first();
                    $checknewslot = SetPricesDaysSlots::where('id', $request->new_slot_id)->first();
                    if (empty($checknewslot)) {
                        return response()->json(['status' => 0, 'message' => trans('messages.invalid_slot')], 200);
                    } else if (@$checknewslot->status == 0) {
                        return response()->json(['status' => 0, 'message' => trans('messages.unavailable_slot')], 200);
                    }
                    $bookingdata->token = str_replace(['$', '/', '.', '|'], '', Hash::make($bookingdata->booking_id));
                    $bookingdata->save();
                    try {
                        $service_fee = $slot_price * 5 / 100;
                        $hst = $slot_price * $bookingdata->dome_info->hst / 100;
                        $total_amount = $slot_price + $service_fee + $hst;
                        $data = ['title' => 'Booking Extend Time', 'email' => $bookingdata->customer_email, 'booking_id' => $bookingdata->booking_id, 'booking_date' => $bookingdata->start_date, 'time' => $slot,  'payment_link' => URL::to('/payment/' . $bookingdata->token), 'sub_total' => Helper::currency_format($slot_price), 'service_fee' => Helper::currency_format($service_fee), 'hst' => Helper::currency_format($hst), 'total_amount' => Helper::currency_format($total_amount)];
                        Mail::send('email.extend_time', $data, function ($message) use ($data) {
                            $message->from(env('MAIL_USERNAME'))->subject($data['title']);
                            $message->to($data['email']);
                        });
                        $sendmail = 1;
                    } catch (\Throwable $th) {
                        return response()->json(['status' => 0, 'message' => trans('messages.email_error')], 200);
                    }
                    if ($sendmail == 1) {
                        $bookingdata->end_time = date('H:i', strtotime($slot_time));
                        $bookingdata->sub_total += $slot_price;
                        $bookingdata->due_amount += $slot_price;
                        $bookingdata->service_fee += $service_fee;
                        $bookingdata->hst += $hst;
                        $bookingdata->total_amount += $slot_price;
                        $bookingdata->slots = $bookingdata->slots . ',' . $slot;
                        $bookingdata->save();
                        $time1 = Carbon::parse($checknewslot->end_time);
                        $time2 = Carbon::parse(date('H:i', strtotime($slot_time)));
                        if ($time1->eq($time2)) {
                            $checknewslot->status = 0;
                            $checknewslot->save();
                        } else {
                            $checkold = $request->old_slot_id + 1;
                            if ($checkold == $request->new_slot_id) {
                                $checkoldslot->end_time = date('H:i', strtotime($slot_time));
                                $checkoldslot->save();
                            }
                            $checknewslot->start_time = date('H:i', strtotime($slot_time));
                            $checknewslot->price -= $slot_price;
                            $checknewslot->save();
                        }
                        return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
                    }
                } else {
                    $old_slot_id = @SetPricesDaysSlots::where('sport_id', $bookingdata->sport_id)->whereDate('date', $bookingdata->start_date)->whereTime('end_time', $bookingdata->end_time)->first()->id;
                    $checkslot = SetPricesDaysSlots::where('id', $request->slot_id)->first();
                    if (empty($checkslot) || $checkslot->status == 0) {
                        return response()->json(['status' => 0, 'message' => trans('messages.invalid_slot')], 200);
                    }
                    $my_interval = 30;
                    $makeslots = new CarbonPeriod(date('h:i A', strtotime($checkslot->start_time)), $my_interval . ' minutes', date('h:i A', strtotime("-$my_interval minutes", strtotime($checkslot->end_time))));
                    $price = 0;
                    $html = '<hr><div class="row">';
                    foreach ($makeslots as $keyy => $slot) {
                        $price += round($checkslot->price / $makeslots->count(), 0);
                        $xtime = $slot->format('h:i A');
                        $value = $slot->addMinutes($my_interval)->format('h:i A');
                        $html .= '<div class="form-check col-lg-4 col-6 text-center"><input class="form-check-input d-none new-slot-radio" type="radio" name="text" value="' . $value . '" id="check123' . $keyy . '"
                        data-old-slot-id="' . $old_slot_id  . '"
                        data-new-slot-id="' . $checkslot->id . '"
                        data-slot-price="' . $price . '"
                        data-slot="' . date('h:i A', strtotime($checkslot->start_time)) . ' - ' . $value . '"
                        onchange="manageslot(this)"><label class="form-check-label rounded px-2 py-1 d-grid" for="check123' . $keyy . '">' . date('h:i A', strtotime($checkslot->start_time)) . ' - ' . $value . '<span><b>(' . Helper::currency_format($price) . ')</b></span> </label></div>';
                    }
                    $html .= '</div><div class="text-center"><button type="button" class="btn btn-primary btn-submit" onclick="submitdata()" style="display:none">' . trans('labels.submit') . '</button></div>';
                    return response()->json(['status' => 1, 'message' => trans('messages.success'), 'slots' => $html], 200);
                }
            } catch (\Throwable $th) {
                Log::channel('bookings_logs')->error("=====> " . __FUNCTION__ . " error :- " . $th->getMessage() . " =====> At :- " . date('j F, Y | h:i A', strtotime(now())));
                return response()->json(['status' => 0, 'message' => trans('messages.wrong'), 'err_msg' => $th->getMessage()], 200);
            }
        }
        $slots = SetPricesDaysSlots::where('sport_id', $bookingdata->sport_id)->whereDate('date', date('Y-m-d', strtotime($bookingdata->start_date)))->get();
        return view('admin.bookings.details', compact('bookingdata', 'slots'));
    }
    public function deletedata(Request $request)
    {
        try {
            $checkbooking = Booking::find($request->id);
            $checkbooking->booking_status = 3;
            $checkbooking->save();
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            Log::channel('bookings_logs')->error("=====> " . __FUNCTION__ . " error :- " . $th->getMessage() . " =====> At :- " . date('j F, Y | h:i A', strtotime(now())));
            return response()->json(['status' => 0, 'message' => trans('messages.wrong'), 'err_msg' => $th->getMessage()], 200);
        }
    }
    public function cancel_booking(Request $request)
    {
        $checkbooking = Booking::find($request->id);
        if ($checkbooking->booking_status == 3) {
            return response()->json(['status' => 0, 'message' => trans('messages.already_cancelled')], 200);
        }
        $refund = Helper::refund_cancel_booking($request->id);
        if ($refund == 1) {
            $checkbooking->cancelled_by = 2;
            $title = 'Booking Cancellation';
            $description = "We regret to inform you that your booking <b>#" . $checkbooking->booking_id . "</b> has been cancelled by The Dome Owner.<br><br>
            We understand that this news may cause inconvenience to you, and we apologize for any inconvenience this cancellation may have caused. We assure you that our team has taken necessary steps to ensure that such an incident does not happen in the future.<br><br>
            In case you need any further assistance, please do not hesitate to contact our customer support team. We would be more than happy to help you in any way we can.<br><br>
            Thank you for your understanding.<br><br>
            Best regards.<br><br>";
            Helper::booking_cancelled_email($title, $description, $checkbooking, 2);
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } else {
            return response()->json(['status' => 0, 'message' => trans('messages.error')], 200);
        }
    }
    function cancelmsg($booking_id)
    {
        return "We regret to inform you that your booking request <b>#" . $booking_id . "</b> has been cancelled by The Dome Owner.<br><br>
        We understand that this news may cause inconvenience to you, and we apologize for any inconvenience this request cancellation may have caused. We assure you that our team has taken necessary steps to ensure that such an incident does not happen in the future.<br><br>
        In case you need any further assistance, please do not hesitate to contact our customer support team. We would be more than happy to help you in any way we can.<br><br>
        Thank you for your understanding.<br><br>
        Best regards.<br><br>";
    }
    public function cancel_booking_request(Request $request)
    {
        $checkbooking = Booking::find($request->id);
        if ($checkbooking->booking_status == 3) {
            return response()->json(['status' => 0, 'message' => trans('messages.already_cancelled')], 200);
        }
        try {
            $checkbooking->booking_status = 3;
            $checkbooking->cancelled_by = 2;
            $checkbooking->save();
            $title = 'Booking Request Cancellation';
            $description = $this->cancelmsg($checkbooking->booking_id);
            Helper::booking_request_reply_email($title, $description, $checkbooking);
            $body = "We regret to inform you that your booking request has been cancelled by The Dome Owner";
            $u = User::find($checkbooking->user_id);
            $tokens = [$u->fcm_token];
            Helper::send_notification($title, $body, 7, $checkbooking->id, $checkbooking->league_id ?? "", $tokens);
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.error')], 200);
        }
    }
    public function manage_booking_request(Request $request)
    {
        $checkbooking = Booking::find($request->id);
        if ($checkbooking->booking_status == 3) {
            return response()->json(['status' => 0, 'message' => trans('messages.already_cancelled')], 200);
        }
        DB::beginTransaction();
        try {
            date_default_timezone_set(env('SET_TIMEZONE'));
            $checkbooking->booking_status = 2;
            $checkbooking->booking_accepted_at = Carbon::now();
            $checkbooking->save();

            $checkbooking = Booking::find($request->id);

            $title = 'Booking Request Cancellation';
            $description = $this->cancelmsg($checkbooking->booking_id);
            $body = "We regret to inform you that your booking request has been cancelled by The Dome Owner";
            foreach (explode(',', $checkbooking->slots) as $key => $slot) {

                $start_time = date('H:i', strtotime(explode(' - ', $slot)[0]));
                $end_time = date('H:i', strtotime(explode(' - ', $slot)[1]));
                SetPricesDaysSlots::where('dome_id', $checkbooking->dome_id)->whereDate('date', date('Y-m-d', strtotime($checkbooking->date)))->where('sport_id', $checkbooking->sport_id)->where('start_time', $start_time)->where('end_time', $end_time)->where('status', 1)->update(['status' => 0]);

                $getbookings = Booking::where('id', '!=', $checkbooking->id)->whereDate('start_date', $checkbooking->start_date)->whereRaw("find_in_set('" . $slot . "',slots)")->where('booking_mode', 2)->where('booking_status', 4)->get();
                foreach ($getbookings as $key => $booking) {
                    $booking->booking_status = 3;
                    $booking->cancelled_by = 2;
                    $booking->save();
                    Helper::booking_request_reply_email($title, $description, $checkbooking);
                    $u = User::find($booking->user_id);
                    $tokens = [$u->fcm_token];
                    Helper::send_notification($title, $body, 7, $booking->id, $league_id = "", $tokens);
                }
            }

            $title = 'Booking Request Accepted';
            $description = "Great news! Your booking request <b>#{$checkbooking->booking_id}</b> has been accepted by The Dome Owner! You can now proceed with the payment directly through the application.<br><br>
            We're excited to have you and hope you have a wonderful experience. If you have any further questions or need assistance, feel free to reach out to our customer support team. We're here to help you in any way we can.<br><br>
            Thank you for choosing us for your booking!<br><br>";
            Helper::booking_request_reply_email($title, $description, $checkbooking);

            $body = "Great news! Your booking request <b>#{$checkbooking->booking_id}</b> has been accepted by The Dome Owner!";
            $u = User::find($checkbooking->user_id);
            $tokens = [$u->fcm_token];
            Helper::send_notification($title, $body, 7, $checkbooking->id, $league_id = "", $tokens);
            DB::commit();
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status' => 0, 'message' => trans('messages.wrong'), 'error' => $th->getMessage()], 200);
        }
    }

    function blocked_timeslots(Request $request)
    {
        $domelist = Domes::NotDeleted();
        if (auth()->user()->type != 1) {
            $domelist = $domelist->where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id);
        }
        $domelist = $domelist->get();
        return view('admin.slots.index', compact('domelist'));
    }
    function getdomesports(Request $request)
    {
        try {
            if ($request->filled('id')) {
                $getdomedata = Domes::where('id', $request->id)->where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id)->NotDeleted()->first();
                if (!empty($getdomedata)) {
                    $sports = Sports::whereIn('id', explode(',', $getdomedata->sport_id))->Available()->NotDeleted()->orderByDesc('id')->get();
                    return response()->json(['status' => 1, 'message' => trans('messages.success'), 'sportsdata' => $sports], 200);
                }
                return response()->json(['status' => 0, 'message' => trans('messages.invalid_dome')], 200);
            } else {
                $sports = Sports::Available()->NotDeleted()->orderByDesc('id')->get();
                return response()->json(['status' => 1, 'message' => trans('messages.success'), 'sportsdata' => $sports], 200);
            }
        } catch (\Throwable $th) {
            Log::channel('bookings_logs')->error("=====> " . __FUNCTION__ . " error :- " . $th->getMessage() . " =====> At :- " . date('j F, Y | h:i A', strtotime(now())));
            return response()->json(['status' => 0, 'message' => trans('messages.wrong'), 'err_msg' => $th->getMessage()], 200);
        }
    }
    function blocked_timeslots_fetch(Request $request)
    {
        if ($request->dome == "") {
            return response()->json(['status' => 0, 'message' => 'Dome selection is required',], 200);
        }
        if ($request->sport == "") {
            return response()->json(['status' => 0, 'message' => 'Sport selection is required',], 200);
        }
        if ($request->date_range == "") {
            return response()->json(['status' => 0, 'message' => 'Date selectionis required',], 200);
        }
        try {
            $startdate = date('Y-m-d', strtotime(explode(' to ', $request->date_range)[0]));
            $enddate = date('Y-m-d', strtotime(explode(' to ', $request->date_range)[1]));
            $getslotslist = SetPricesDaysSlots::where('dome_id', $request->dome)->where('sport_id', $request->sport)->whereBetween('date', [$startdate, $enddate]);
            $getslotslist = $getslotslist->whereIn('status', [1, 2]);
            $getslotslist = $getslotslist->orderBy('date')->orderBy('start_time')->get();
            $requestdata = $request->input();

            $dome = Domes::with(['working_hours'])->where('id', $request->dome)->first();
            $closedays = $dome->working_hours->where('is_closed', 1)->pluck('day')->toArray();

            $slotshtml = view('admin.slots.content', compact('getslotslist', 'requestdata', 'closedays'))->render();
            return response()->json(['status' => 1, 'message' => trans('messages.success'), 'slotshtml' => $slotshtml], 200);
        } catch (\Throwable $th) {
            Log::channel('bookings_logs')->error("=====> " . __FUNCTION__ . " error :- " . $th->getMessage() . " =====> At :- " . date('j F, Y | h:i A', strtotime(now())));
            return response()->json(['status' => 0, 'message' => trans('messages.wrong'), 'err_msg' => $th->getMessage()], 200);
        }
    }
    function blockslots(Request $request)
    {
        if ($request->ids == "") {
            return response()->json(['status' => 0, 'message' => 'Slots selection is required',], 200);
        }
        try {
            $ids = explode(',', $request->ids);
            $cnt = SetPricesDaysSlots::whereIn('id', $ids)->where('status', 1)->count();
            if (count($ids) == $cnt) {
                SetPricesDaysSlots::whereIn('id', $ids)->update(['status' => 2]);
                return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
            }
            return response()->json(['status' => 2, 'message' => trans('messages.some_slots_recent_blocked')], 200);
        } catch (\Throwable $th) {
            Log::channel('bookings_logs')->error("=====> " . __FUNCTION__ . " error :- " . $th->getMessage() . " =====> At :- " . date('j F, Y | h:i A', strtotime(now())));
            return response()->json(['status' => 0, 'message' => trans('messages.wrong'), 'err_msg' => $th->getMessage()], 200);
        }
    }
    function unblockslots(Request $request)
    {
        if ($request->ids == "") {
            return response()->json(['status' => 0, 'message' => 'Slots selection is required',], 200);
        }
        try {
            SetPricesDaysSlots::whereIn('id', explode(',', $request->ids))->update(['status' => 1]);
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } catch (\Throwable $th) {
            Log::channel('bookings_logs')->error("=====> " . __FUNCTION__ . " error :- " . $th->getMessage() . " =====> At :- " . date('j F, Y | h:i A', strtotime(now())));
            return response()->json(['status' => 0, 'message' => trans('messages.wrong'), 'err_msg' => $th->getMessage()], 200);
        }
    }
}
