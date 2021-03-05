<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\User;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Observers\User\UserObserver;
use App\Observers\Transaction\TransactionObserver;
use App\Observers\Wallet\WalletObserver;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Transaction::observe(TransactionObserver::class);
        Wallet::observe(WalletObserver::class);
    }
}
