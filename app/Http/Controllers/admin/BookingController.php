<?php

namespace App\Http\Controllers\admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Domes;
use App\Models\Field;
use App\Models\SetPricesDaysSlots;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Stripe;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;

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
        if ($request->has('type') && in_array($request->type, ['domes', 'leagues'])) {
            if ($request->type == 'domes') {
                $getbookingslist = $getbookingslist->where('dome_id', '!=', '');
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

                    $slot_time = $request->slot_time;
                    $old_slot_id = $request->old_slot_id;
                    $new_slot_id = $request->new_slot_id;

                    $checkoldslot = SetPricesDaysSlots::where('id', $request->old_slot_id)->first();
                    $checknewslot = SetPricesDaysSlots::where('id', $request->new_slot_id)->first();
                    if (empty($checknewslot)) {
                        return response()->json(['status' => 0, 'message' => trans('messages.invalid_slot')], 200);
                    } else if ($checknewslot->status == 0) {
                        return response()->json(['status' => 0, 'message' => 'Slot is Anavailable'], 200);
                    }

                    $bookingdata->end_time = date('H:i', strtotime($slot_time));
                    $bookingdata->slots = $bookingdata->slots . ',' . date('h:i A', strtotime($bookingdata->end_time)) . ' - ' . $slot_time;
                    $bookingdata->save();

                    $time1 = Carbon::parse($checknewslot->end_time);
                    $time2 = Carbon::parse(date('H:i', strtotime($slot_time)));
                    if ($time1->eq($time2)) {
                        $checknewslot->status = 0;
                        $checknewslot->save();
                    }else{
                        $checkoldslot->end_time = date('H:i', strtotime($slot_time));
                        $checkoldslot->save();
                        $checknewslot->start_time = date('H:i', strtotime($slot_time));
                        $checknewslot->save();
                    }

                    return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
                } else {
                    $old_slot_id = @SetPricesDaysSlots::where('sport_id', $bookingdata->sport_id)->whereDate('date', $bookingdata->start_date)->whereTime('end_time', $bookingdata->end_time)->first()->id;

                    $checkslot = SetPricesDaysSlots::where('id', $request->slot_id)->first();
                    if (empty($checkslot) || $checkslot->status == 0) {
                        return response()->json(['status' => 0, 'message' => trans('messages.invalid_slot')], 200);
                    }
                    $my_interval = 30;
                    $period = new CarbonPeriod(date('h:i A', strtotime($checkslot->start_time)), $my_interval . ' minutes', date('h:i A', strtotime("-$my_interval minutes", strtotime($checkslot->end_time))));
                    // $price = 0;
                    $html = '<div class="row">';
                    foreach ($period as $keyy => $item) {
                        // $price += round($checkslot->price / $period->count(), 2);
                        $xtime = $item->format('h:i A');
                        $value = $item->addMinutes($my_interval)->format('h:i A');
                        $html .= '<div class="form-check col-lg-4 col-6 text-center"><input class="form-check-input d-none new-slot-radio" type="radio" name="text" value="' . $value . '" id="check123' . $keyy . '" data-old-slot-id="' . $old_slot_id  . '" data-new-slot-id="' . $checkslot->id . '" onchange="manageslot(this)"><label class="form-check-label rounded px-2 py-1" for="check123' . $keyy . '">' . date('h:i A', strtotime($checkslot->start_time)) . ' - ' . $value . '    </label></div>';
                        // $html .= '<div class="form-check"><input class="form-check-input" type="radio" name="text" value="' . $value . '" id="check123' . $keyy . '"><label class="form-check-label" for="check123' . $keyy . '">' . $xtime . ' - ' . $value . '(' . Helper::currency_format($price) . ')</label></div>';
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
    public function booking(Request $request)
    {
        if ($request->user_id == "") {
            return response()->json(['status' => 0, 'message' => 'Enter Login User ID'], 200);
        }
        if ($request->field_id == "") {
            return response()->json(['status' => 0, 'message' => 'Enter Field ID'], 200);
        }
        if ($request->customer_name == "") {
            return response()->json(['status' => 0, 'message' => 'Enter Customer Name'], 200);
        }
        if ($request->customer_email == "") {
            return response()->json(['status' => 0, 'message' => 'Enter Customer Email'], 200);
        }
        if ($request->customer_mobile == "") {
            return response()->json(['status' => 0, 'message' => 'Enter Customer Mobile'], 200);
        }
        if ($request->players == "") {
            return response()->json(['status' => 0, 'message' => 'Enter Players'], 200);
        }
        if ($request->start_date == "") {
            return response()->json(['status' => 0, 'message' => 'Select Booking Date'], 200);
        }
        if ($request->start_time == "") {
            return response()->json(['status' => 0, 'message' => 'Enter Start Time'], 200);
        }
        if ($request->end_time == "") {
            return response()->json(['status' => 0, 'message' => 'Enter End Time'], 200);
        }
        if ($request->total_amount == "") {
            return response()->json(['status' => 0, 'message' => 'Enter Booking Total Amount'], 200);
        }
        if ($request->payment_type == "") {
            return response()->json(['status' => 0, 'message' => 'Select Payment Type'], 200);
        }
        $checkfield = Field::find($request->field_id);
        if (empty($checkfield)) {
            return response()->json(['status' => 0, 'message' => 'Field Not Found'], 200);
        }
        $checkdome = Domes::find($checkfield->dome_id);
        if (empty($checkdome)) {
            return response()->json(['status' => 0, 'message' => 'Invalid Dome ID'], 200);
        }
        $checkvendor = User::find($checkdome->vendor_id);
        if (empty($checkvendor)) {
            return response()->json(['status' => 0, 'message' => 'Invalid Dome Vendor ID'], 200);
        }
        $checkuser = User::find($request->user_id);
        if (empty($checkuser)) {
            return response()->json(['status' => 0, 'message' => 'User Not Found'], 200);
        }

        if ($request->payment_type == 1) {
            if ($request->payment_method == 1) {
                if ($request->card_number == "") {
                    return response()->json(["status" => 0, "message" => "Please Enter Card Number"], 200);
                }
                if ($request->card_exp_month == "") {
                    return response()->json(["status" => 0, "message" => "Please Enter Card Expire Month"], 200);
                }
                if ($request->card_exp_year == "") {
                    return response()->json(["status" => 0, "message" => "Please Enter Card Expire Year"], 200);
                }
                if ($request->card_cvv == "") {
                    return response()->json(["status" => 0, "message" => "Please Enter Card CVV"], 200);
                }
                // Payment Type = 1=Card, 2=Apple Pay, 3=Google Pay
                if ($request->payment_type == 1) {
                    try {
                        $stripekey = Helper::stripe_data()->secret_key;
                        $stripe = new \Stripe\StripeClient($stripekey);
                        $gettoken = $stripe->tokens->create([
                            'card' => [
                                'number' => $request->card_number,
                                'exp_month' => $request->card_exp_month,
                                'exp_year' => $request->card_exp_year,
                                'cvc' => $request->card_cvv,
                            ],
                        ]);
                        Stripe\Stripe::setApiKey($stripekey);
                        $payment = Stripe\Charge::create([
                            "amount" => $request->total_amount * 100,
                            "currency" => "CAD",
                            "source" => $gettoken->id,
                            "description" => "Domez Payment",
                        ]);
                        $transaction_id = $payment->id;
                    } catch (\Throwable $th) {
                        return response()->json(['status' => 0, 'message' => "Payment Failed"], 200);
                    }
                }
            }
        }
        if ($request->payment_type == 2) {
            if ($request->partial_amount == "") {
                return response()->json(["status" => 0, "message" => "Enter Partial Amount"], 200);
            }
            if ($request->payment_method == 1) {
                if ($request->card_number == "") {
                    return response()->json(["status" => 0, "message" => "Please Enter Card Number"], 200);
                }
                if ($request->card_exp_month == "") {
                    return response()->json(["status" => 0, "message" => "Please Enter Card Expire Month"], 200);
                }
                if ($request->card_exp_year == "") {
                    return response()->json(["status" => 0, "message" => "Please Enter Card Expire Year"], 200);
                }
                if ($request->card_cvv == "") {
                    return response()->json(["status" => 0, "message" => "Please Enter Card CVV"], 200);
                }
                // Payment Type = 1=Card, 2=Apple Pay, 3=Google Pay
                if ($request->payment_type == 1) {
                    try {
                        $stripekey = Helper::stripe_data()->secret_key;
                        $stripe = new \Stripe\StripeClient($stripekey);
                        $gettoken = $stripe->tokens->create([
                            'card' => [
                                'number' => $request->card_number,
                                'exp_month' => $request->card_exp_month,
                                'exp_year' => $request->card_exp_year,
                                'cvc' => $request->card_cvv,
                            ],
                        ]);
                        Stripe\Stripe::setApiKey($stripekey);
                        $payment = Stripe\Charge::create([
                            "amount" => $request->partial_amount * 100,
                            "currency" => "CAD",
                            "source" => $gettoken->id,
                            "description" => "Domez Payment",
                        ]);
                        $transaction_id = $payment->id;
                    } catch (\Throwable $th) {
                        return response()->json(['status' => 0, 'message' => "Payment Failed"], 200);
                    }
                }
            }
        }
        // Payment Type = 1=Card, 2=Apple Pay, 3=Google Pay
        $transaction = new Transaction;
        $transaction->type = 1;
        $transaction->vendor_id = $request->vendor_id;
        $transaction->dome_id = $request->dome_id;
        $transaction->user_id = $request->user_id;
        $transaction->payment_type = $request->payment_type;
        $transaction->transaction_id = $transaction_id;
        $transaction->amount = $request->amount;
        $transaction->save();
    }
    public function check_booking(Request $request)
    {
        $checkbooking = Booking::where('start_date', $request->start_date)->where('start_time', '!=', $request->start_time)->where('end_time', '!=', $request->end_time)->get();
        return response()->json($checkbooking, 200);
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
        $refund = Helper::refund_cancel_booking($request->id);
        if ($refund == 1) {
            return response()->json(['status' => 1, 'message' => trans('messages.success')], 200);
        } else {
            return response()->json(['status' => 0, 'message' => trans('messages.error')], 200);
        }
    }
}
