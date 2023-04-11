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
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:distribute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Set your Stripe API key
        Stripe::setApiKey(Helper::stripe_data()->secret_key);
        $transactions = Transaction::where('is_payment_released', 2)->select('vendor_id', 'booking_id', DB::raw('SUM(amount) as amount'))->groupBy('booking_id')->get();
        foreach ($transactions as $transaction) {
            $dome_owner = PaymentGateway::where('vendor_id', $transaction->vendor_id)->select('account_id')->first();
            if (!empty($dome_owner)) {
                // $account = \Stripe\Account::retrieve('acct_1MtkxuKQdlw84kQX');
                // Transfer funds to another Stripe account
                $transfer = Transfer::create([
                    'amount' => $transaction->amount * 100, // Amount in cents
                    'currency' => 'CAD',
                    'destination' => 'acct_1MtkxuKQdlw84kQX',
                ]);
            }
        }


        // Log the transfer ID for debugging purposes
        Log::info('Data: ' . $transfer);
    }
}
