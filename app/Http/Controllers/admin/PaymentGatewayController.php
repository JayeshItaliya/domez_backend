<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PaymentGateway;
use Illuminate\Support\Facades\Auth;

class PaymentGatewayController extends Controller
{
    public function store_stripe(Request $request)
    {
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
