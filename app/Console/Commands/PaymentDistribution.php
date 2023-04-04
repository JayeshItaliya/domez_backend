<?php

namespace App\Console\Commands;

use App\Helper\Helper;
use App\Models\User;
use Illuminate\Console\Command;
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
        $dome_owners = User::where('type', 2)->where('is_available', 1)->where('is_deleted', 2)->get();
        foreach ($dome_owners as $dome_owner) {
            $transactions = 0;
        }

        // Transfer funds to another Stripe account
        $transfer = Transfer::create([
            'amount' => 1000, // Amount in cents
            'currency' => 'CAD',
            'destination' => 'DESTINATION_STRIPE_ACCOUNT_ID',
        ]);

        // Log the transfer ID for debugging purposes
        Log::info('Data: ' . $transfer);
    }
}
