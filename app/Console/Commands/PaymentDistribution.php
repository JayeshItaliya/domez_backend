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
                    $getbookings_q = Booking::select('id')->where('vendor_id', $vendor->id)->where('is_payment_released', 2)->where('booking_status', 1)->where('payment_status', 1);
                    $getbookingidsdome = $getbookings_q->where('type', 1)->whereDate('start_date', '<', date('Y-m-d'))->get()->pluck('id')->toArray();
                    $getbookingidsleague = $getbookings_q->where('type', 2)->whereDate('end_date', '<', date('Y-m-d'))->get()->pluck('id')->toArray();
                    $getbookingids = array_merge($getbookingidsdome, $getbookingidsleague);
                    if (count($getbookingids) > 0) {

                        try {
                            $distribution_amount = Booking::whereIn('id', $getbookingids)->sum('total_amount') * 88 / 100;

                            $getbookings_q_c = Booking::select('id')->where('vendor_id', $vendor->id)->where('is_payment_released', 2)->where('booking_status', 3)->where('cancelled_by', 2)->where('payment_status', 1);
                            $getbookingidsdome_ = $getbookings_q_c->where('type', 1)->whereDate('start_date', '<', date('Y-m-d'))->get()->pluck('id')->toArray();
                            $getbookingidsleague_ = $getbookings_q_c->where('type', 2)->whereDate('end_date', '<', date('Y-m-d'))->get()->pluck('id')->toArray();
                            $getbookingids__ = array_merge($getbookingidsdome_, $getbookingidsleague_);
                            $cancellation_charges = Booking::whereIn('id', $getbookingids__)->sum('paid_amount') * 3.50 / 100;

                            $final_amount = $distribution_amount - $cancellation_charges;

                            Transfer::create([
                                'amount' => $final_amount * 100,
                                'currency' => 'CAD',
                                'destination' => $getaccountid->account_id,
                            ]);
                            $b_ids = array_merge($getbookingids, $getbookingids__);
                            Booking::whereIn('id', $b_ids)->update(['is_payment_released' => 1]);
                            $this->info(' -------------------------------------------- ');
                            $this->info(' Amount --> ' . $final_amount . ' ||| Distributed For Booking IDs :- ' . implode(',', $getbookingids) . ' ||| To Account --> "' . $getaccountid->account_id . '" (Vendor --> ' . $vendor->id . ') ');
                        } catch (\Throwable $th) {
                            $this->info(' ================================================== ');
                            $this->info(' Unable To Distribute Amount For Booking IDs :- ' . implode(',', $getbookingids) . ' ||| To Account --> "' . $getaccountid->account_id . '" (Vendor --> ' . $vendor->id . ') ');
                            $this->info(' REASON :- ' . $th->getMessage());
                            $this->info(' ================================================== ');
                        }
                    }
                }
            }
        }
    }
}
