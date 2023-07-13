<?php

namespace App\Http\Controllers\admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\SetPricesDaysSlots;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $now = CarbonImmutable::today();
        $weekStartDate = $now->startOfWeek();
        $weekEndDate = $now->endOfWeek();
        $getbookingslist = Booking::select('*');
        if (in_array(auth()->user()->type, [2, 4])) {
            $getbookingslist = $getbookingslist->where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id);
        }
        if (auth()->user()->type == 5) {
            $getbookingslist = $getbookingslist->where('provider_id', auth()->user()->id);
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
        $getbookingslist = $getbookingslist->get();
        // Filter the bookings based on their order date
        $today_orders = $getbookingslist->where('start_date', date('Y-m-d'));
        $future_orders = $getbookingslist->where('start_date', '>', date('Y-m-d'));
        $past_orders = $getbookingslist->where('start_date', '<', date('Y-m-d'));
        $bookingslist = $today_orders->concat($future_orders)->concat($past_orders);
        return view('admin.bookings.index', compact('bookingslist'));
    }
    public function calendar(Request $request)
    {
        if (auth()->user()->type == 1) {
            $getbookingslist = Booking::orderByDesc('id')->get();
        } else {
            $getbookingslist = Booking::where('vendor_id', auth()->user()->type == 2 ? auth()->user()->id : auth()->user()->vendor_id)->orderByDesc('id')->get();
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
                            $message->from(config('app.mail_username'))->subject($data['title']);
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
                return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
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
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
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
}
