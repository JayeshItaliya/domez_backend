<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PaymentGateway;

class PaymentGatewayController extends Controller
{
    public function stripe(Request $request)
    {
        $stripe = PaymentGateway::where('type', 1)->first();
        return view('admin.payment_gateway.stripe', compact('stripe'));
    }

    public function store_stripe(Request $request)
    {
        $request->validate([
            'public_key' => 'required',
            'secret_key' => 'required'
        ],[
            'public_key.required' => 'This Field is Required',
            'secret_key.required' => 'This Field is Required'
        ]);

        $data = PaymentGateway::where('type', 1)->first();
        if(!empty($data)){
            $data->public_key = $request->public_key;
            $data->secret_key = $request->secret_key;
            $data->save();
        }else{
            $payment_gateway = new PaymentGateway;
            $payment_gateway->type = 1;
            $payment_gateway->public_key = $request->public_key;
            $payment_gateway->secret_key = $request->secret_key;
            $payment_gateway->save();
        }

        return redirect()->back()->with('success', 'Successfully');
    }
}
