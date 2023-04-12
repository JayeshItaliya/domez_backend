<?php

namespace App\Http\Controllers\admin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PaymentGateway;
use Illuminate\Support\Facades\Auth;
use Stripe\Account;
use Stripe\Stripe;
use Stripe\Token;
use Stripe\Transfer;

class PaymentGatewayController extends Controller
{
    public function store_stripe(Request $request)
    {
        // Stripe::setApiKey(Helper::stripe_data()->secret_key);
        // $token = Token::create([
        //     'bank_account' => [
        //         'country' => 'CA',
        //         'currency' => 'cad',
        //         'account_holder_name' => 'John Doe',
        //         'account_holder_type' => 'individual',
        //         'routing_number' => '11000-000',
        //         'account_number' => '000123456789',
        //     ],
        // ]);

        // // Get the bank account ID from the token object
        // $bank_account_id = $token->bank_account->id;
        // dd(Account::retrieve($bank_account_id));

        // // Create a new transfer object
        // $transfer = Transfer::create([
        //     'amount' => 1000,
        //     'currency' => 'usd',
        //     'destination' => $bank_account_id,
        // ]);
        if ($request->has('account_id')) {
            $request->validate([
                'account_id' => 'required',
            ], [
                'account_id.required' => 'This Field is Required',
            ]);
        } else {
            $request->validate([
                'public_key' => 'required',
                'secret_key' => 'required'
            ], [
                'public_key.required' => 'This Field is Required',
                'secret_key.required' => 'This Field is Required'
            ]);
        }


        $data = PaymentGateway::where('type', 1)->where('vendor_id', Auth::user()->id)->first();
        if (!empty($data)) {
            if ($request->has('account_id')) {
                $data->account_id = $request->account_id;
            } else {
                $data->public_key = $request->public_key;
                $data->secret_key = $request->secret_key;
            }
            $data->save();
        } else {
            $payment_gateway = new PaymentGateway();
            $payment_gateway->type = 1;
            $payment_gateway->vendor_id = Auth::user()->id;
            if ($request->has('account_id')) {
                $payment_gateway->account_id = $request->account_id;
            } else {
                $payment_gateway->public_key = $request->public_key;
                $payment_gateway->secret_key = $request->secret_key;
            }

            $payment_gateway->save();
        }

        return redirect()->back()->with('success', trans('messages.success'));
    }
}
