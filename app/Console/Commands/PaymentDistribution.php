<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helper\Helper;
use App\Models\Booking;
use App\Models\PaymentGateway;
use App\Models\User;
use Stripe\Stripe;
use Stripe\Transfer;
use Stripe\Balance;
use Stripe\Account;

class PaymentDistribution extends Command
{
    // $balance = Balance::retrieve();
    // $availableBalance = $balance->available[0]->amount;
    // $pendingBalance = $balance->pending[0]->amount;
    
    // $redirectUri = 'http://192.168.0.121/domez_backend/connects';
    // $authorizeUrl = 'https://connect.stripe.com/oauth/authorize' . '?response_type=code' . '&client_id=' . env('STRIPE_CLIENT_ID') . '&scope=read_write' .'&redirect_uri=' . urlencode($redirectUri);

    protected $signature = 'payment:distribute';
    protected $description = 'Distribute Payment Between Admin and Dome Owner On Every Wednesday 6:00 AM Using Stripe Account ID (If Account is Enabled)';
    public function handle()
    {
        Stripe::setApiKey(Helper::stripe_data()->secret_key);
        $getvendors = User::where('type', 2)->where('is_deleted', 2)->get();
        foreach ($getvendors as $key => $vendor) {

            $getaccountid = PaymentGateway::where('vendor_id', $vendor->id)->select('account_id')->first();
            if (!empty($getaccountid)) {
                $checkaccount = Account::retrieve($getaccountid->account_id);
                if ($checkaccount->charges_enabled === false || $checkaccount->payouts_enabled === false) {
                } else {
                    $getbookikings = Booking::select('id')->where('vendor_id', $vendor->id)->where('is_payment_released', 2)->where('booking_status', 1)->where('payment_status', 1);
                    $getbookingidsdome = $getbookikings->where('type', 1)->whereDate('start_date', '<', date('Y-m-d'))->get()->pluck('id')->toArray();
                    $getbookingidsleague = $getbookikings->where('type', 2)->whereDate('end_date', '<', date('Y-m-d'))->get()->pluck('id')->toArray();
                    $getbookingids = array_merge($getbookingidsdome, $getbookingidsleague);
                    if (count($getbookingids) > 0) {
                        $gettotalamount = Booking::whereIn('id', $getbookingids)->sum('total_amount');
                        $amount = $gettotalamount * 88 / 100;
                        $transfer = Transfer::create([
                            'amount' => $amount * 100,
                            'currency' => 'CAD',
                            'destination' => $getaccountid->account_id,
                        ]);
                        Booking::whereIn('id', $getbookingids)->update(['is_payment_released' => 1]);
                        $this->info(' -------------------------------------------- ');
                        $this->info(' Amount --> ' . $amount . ' ||| Distributed For Booking IDs :- ' . implode(',', $getbookingids) . ' ||| To Account --> "' . $getaccountid->account_id . '" (Vendor --> ' . $vendor->id . ') ');
                    }
                }
            }
        }
    }
}
