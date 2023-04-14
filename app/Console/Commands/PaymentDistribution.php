<?php

namespace App\Console\Commands;

use App\Helper\Helper;
use App\Models\PaymentGateway;
use App\Models\Transaction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Transfer;

class PaymentDistribution extends Command
{
    protected $signature = 'payment:distribute';
    protected $description = 'Command description';
    public function handle()
    {
        // Set your Stripe API key
        Stripe::setApiKey(Helper::stripe_data()->secret_key);

        $balance = \Stripe\Balance::retrieve();
        $availableBalance = $balance->available[0]->amount;
        $pendingBalance = $balance->pending[0]->amount;
        // dd($availableBalance);

        $transfer = Transfer::create([
            'amount' => 1 * 100,
            'currency' => 'CAD',
            'destination' => 'acct_1MvzUpLzmzgjQ4eS',
        ]);

        $this->info(' Destination -> acct_1MvzUpLzmzgjQ4eS');
        $this->info(' Sended ' .$transfer);
    }
    // public function handle()
    // {
    //     // Set your Stripe API key
    //     Stripe::setApiKey(Helper::stripe_data()->secret_key);
    //     $transactions = Transaction::where('is_payment_released', 2)->select('vendor_id', 'booking_id', DB::raw('SUM(amount) as amount'))->groupBy('booking_id')->get();
    //     foreach ($transactions as $transaction) {
    //         $dome_owner = PaymentGateway::where('vendor_id', $transaction->vendor_id)->select('account_id')->first();
    //         if (!empty($dome_owner)) {
    //             // $account = \Stripe\Account::retrieve('acct_1MtkxuKQdlw84kQX');
    //             // Transfer funds to another Stripe account

    //             $balance = \Stripe\Balance::retrieve();
    //             $availableBalance = $balance->available[0]->amount;
    //             $pendingBalance = $balance->pending[0]->amount;
    //             // dd($availableBalance);

    //             $transfer = Transfer::create([
    //                 'amount' => 1 * 100,
    //                 'currency' => 'CAD',
    //                 'destination' => 'acct_1MtkxuKQdlw84kQX',
    //             ]);

    //             $this->info(' Destination -> acct_1MtkxuKQdlw84kQX');
    //             $this->info(' Sended ' .$transfer);
    //         }
    //     }
    // }
}
