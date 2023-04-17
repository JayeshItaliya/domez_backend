<?php

namespace App\Console\Commands;

use App\Helper\Helper;
use App\Models\Booking;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Transfer;
use Stripe\Balance;
use Stripe\Account;
use Stripe\AccountLink;

class PaymentDistribution extends Command
{
    // $balance = Balance::retrieve();
    // $availableBalance = $balance->available[0]->amount;
    // $pendingBalance = $balance->pending[0]->amount;

    protected $signature = 'payment:distribute';
    protected $description = 'Command description';
    // public function handle()
    // {
    //     Stripe::setApiKey(Helper::stripe_data()->secret_key);

    //     // $redirectUri = 'http://192.168.0.121/domez_backend/connects';
    //     // $authorizeUrl = 'https://connect.stripe.com/oauth/authorize' . '?response_type=code' . '&client_id=' . env('STRIPE_CLIENT_ID') . '&scope=read_write' .'&redirect_uri=' . urlencode($redirectUri);

    //     // dd($authorizeUrl);

    //     $transfer = Transfer::create([
    //         'amount' => 1 * 100,
    //         'currency' => 'CAD',
    //         'destination' => 'acct_1MxlbHSGerkMxhaI',
    //     ]);
    //     $this->info(' --------------------------------------------- ');
    //     $this->info(' Destination -> acct_1MvzUpLzmzgjQ4eS');
    //     $this->info(' Sended ' . $transfer);
    //     $this->info(' --------------------------------------------- ');
    // }
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
    // public function handle()
    // {
    //     Stripe::setApiKey(Helper::stripe_data()->secret_key);

    //     $getvendors = User::where('type', 2)->where('is_deleted', 2)->get();
    //     foreach ($getvendors as $key => $vendor) {
    //         $getids = Transaction::select('id')->where('vendor_id', $vendor->id)->where('type', 1)->where('is_payment_released', 2)->get()->pluck('id')->toArray();
    //         if (count($getids) > 0) {
    //             $getaccountid = PaymentGateway::where('vendor_id', $vendor->id)->select('account_id')->first();
    //             if (!empty($getaccountid)) {
    //                 $checkaccount = Account::retrieve($getaccountid->account_id);
    //                 if ($checkaccount->charges_enabled === false || $checkaccount->payouts_enabled === false) {
    //                 } else {
    //                     $gettotalamount = Transaction::whereIn('id', $getids)->sum('amount');
    //                     $transfer = Transfer::create([
    //                         'amount' => $gettotalamount * 100,
    //                         'currency' => 'CAD',
    //                         'destination' => $getaccountid->account_id,
    //                     ]);
    //                     Transaction::whereIn('id', $getids)->update(['is_payment_released' => 1]);
    //                     $this->info(' -------------------------------------------- ');
    //                     $this->info(' Destination -> ' . $getaccountid->account_id);
    //                     $this->info(' Amount Distributed For IDs :- ' . implode(',', $getids));
    //                 }
    //             }
    //         }
    //     }
    // }
}
