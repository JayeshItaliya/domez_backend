<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquiries;
use App\Models\Booking;
use App\Models\Transaction;
use Illuminate\Support\Facades\URL;
use App\Helper\Helper;

class LandingPagesController extends Controller
{
    public function landing(Request $request)
    {
        return view('landing.index');
    }
    public function contact(Request $request)
    {
        return view('landing.contact');
    }
    public function privacy_policy(Request $request)
    {
        return view('landing.privacy_policy');
    }
    public function terms_conditions(Request $request)
    {
        return view('landing.terms_conditions');
    }
    public function store_general_enquiries(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required|max:150',
            'message' => 'required|max:500',
        ], [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid Email Address.',
            'subject.required' => 'Subject is required.',
            'subject.max' => 'Maximum limit of characters allowed are 150.',
            'message.required' => 'Message is required.',
            'message.max' => 'Maximum limit of characters allowed are 500.',
        ]);

        $enquiry = new Enquiries();
        $enquiry->type = 2;
        $enquiry->name = $request->name;
        $enquiry->email = $request->email;
        $enquiry->subject = $request->subject;
        $enquiry->message = $request->message;
        $enquiry->save();

        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function dome_request(Request $request)
    {
        if ($request->send_otp == 1) {
            $otp = rand(1000, 9999);
            session()->put('verification_otp', $otp);
            $mail = Helper::verificationemail($request->email, $request->name, $otp);
            if ($mail == 1) {
                return response()->json(['status' => 1, 'message' => "Account Verification Otp email has been sent to you."], 200);
            } else {
                return response()->json(['status' => 0, 'message' => "Email error!!"], 200);
            }
        }
        if ($request->verify_otp == 1) {
            if ($request->otp == "") {
                return response()->json(['status' => 0, 'message' => "Please Enter OTP"], 200);
            }
            if ($request->otp != session()->get('verification_otp')) {
                return response()->json(['status' => 0, 'message' => "Please Enter Valid OTP"], 200);
            } else {
                return response()->json(['status' => 1, 'message' => "OTP Verification Successfull"], 200);
            }
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'dome_name' => 'required',
            'dome_city' => 'required',
            'dome_state' => 'required',
            'dome_country' => 'required',
            'dome_address' => 'required',
        ], [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid Email Address.',
            'phone.required' => 'Phone is required.',
            'dome_name.required' => 'Dome Name is required.',
            'dome_zipcode.required' => 'Dome Zipcode is required.',
            'dome_city.required' => 'Dome City is required.',
            'dome_state.required' => 'Dome State is required.',
            'dome_country.required' => 'Dome Country is required.',
            'dome_address.required' => 'Dome Address is required.',
        ]);

        $enquiry = new Enquiries();
        $enquiry->type = 3;
        $enquiry->name = $request->name;
        $enquiry->email = $request->email;
        $enquiry->phone = $request->phone;
        $enquiry->dome_name = $request->dome_name;
        $enquiry->dome_zipcode = $request->dome_zipcode;
        $enquiry->dome_city = $request->dome_city;
        $enquiry->dome_state = $request->dome_state;
        $enquiry->dome_country = $request->dome_country;
        $enquiry->venue_address = $request->dome_address;
        $enquiry->save();

        return redirect('/')->with('success', trans('messages.success'));
    }
    public function split_payment(Request $request)
    {
        $checkbooking = Booking::where('token', $request->token)->first();
        if (!empty($checkbooking)) {
            $page_url = URL::to('/payment/' . $request->token);
            $booking_token = $request->token;
            if ($request->ajax()) {
                if ($checkbooking->due_amount > 0) {

                    \Stripe\Stripe::setApiKey(Helper::stripe_data()->secret_key);
                    $intent = \Stripe\PaymentIntent::create([
                        'amount' => $request->amount * 100,
                        'currency' => 'cad',
                        'payment_method_types' => [
                            'card',
                            // 'bancontact',
                            // 'eps',
                            // 'giropay',
                            // 'ideal',
                            // 'p24',
                            // 'sepa_debit',
                            // 'sofort',
                        ],
                    ]);
                    return response()->json(['client_secret' => $intent->client_secret]);
                } else {
                    return response()->json(['status' => 0, 'message' => 'All Payment has been successfully paid'], 200);
                }
            }
            return view('landing.split_payment', compact('checkbooking', 'page_url', 'booking_token'));
        } else {
            abort(404);
        }
    }
    public function split_payment_process(Request $request)
    {
        try {
            $checktransaction = Transaction::where('transaction_id', $request->transaction_id)->first();
            if (empty($checktransaction)) {

                $checkbooking = Booking::where('token', $request->booking_token)->first();
                $checkbooking->due_amount -= $request->amount;
                $checkbooking->paid_amount += $request->amount;
                $checkbooking->save();

                $newcheckbooking = Booking::where('token', $request->booking_token)->first();
                if ($newcheckbooking->due_amount == 0) {
                    $newcheckbooking->booking_status = 1;
                    $newcheckbooking->payment_status = 1;
                    $newcheckbooking->save();
                }

                $checkbooking1 = Booking::where('token', $request->booking_token)->first();

                $transaction = new Transaction();
                $transaction->type = 1;
                $transaction->vendor_id = $checkbooking1->vendor_id;
                $transaction->dome_id = $checkbooking1->dome_id;
                $transaction->league_id = $checkbooking1->league_id;
                $transaction->booking_id = $checkbooking1->booking_id;
                $transaction->contributor_name = $request->contributor_name;
                $transaction->payment_method = 1;
                $transaction->transaction_id = $request->transaction_id;
                $transaction->amount = $request->amount;
                $transaction->save();
            }
            return response()->json(['status' => 1, 'message' => 'Payment Successfull'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'message' => trans('messages.wrong')], 200);
        }
    }
}
