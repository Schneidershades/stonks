<?php

namespace App\Observers\Transaction;

use App\Models\Transaction;
use App\Models\Wallet;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {
        $this->processTransactions($transaction);
    }

    /**
     * Handle the Transaction "updated" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function updated(Transaction $transaction)
    {
        $this->processTransactions($transaction);
    }

    public function processTransactions(Transaction $transaction)
    {
        if($transaction->action == 'deposit' && $transaction->status == 'success'){
            $this->creditWallet($transaction->user_id, $transaction->amount);
            $transaction->response = "credit";
            $transaction->response = "Successful deposit transaction $transaction->amount";
        }

        if($transaction->action == 'withdrawal' && $transaction->status == 'success'){
            $this->debitWallet($transaction->user_id, $transaction->amount);
            $transaction->response = "credit";
            $transaction->response = "Successful withdrawal transaction $transaction->amount";
        }

        if($transaction->action == 'transfer' && $transaction->status == 'success'){
            $this->creditWallet($transaction->receiver_id, $transaction->amount);
            $this->debitWallet($transaction->user_id, $transaction->amount);
            $transaction->response = "credit";
            $transaction->response = "Successful transfer transaction $transaction->amount";
        }

        $transaction->save();
    }

    public function debitWallet($user_id, $amount)
    {
        $wallet = Wallet::find($user_id);
        $wallet->balance -= $amount;
        $wallet->save();
    }

    public function creditWallet($user_id, $amount)
    {
        $wallet = Wallet::find($user_id);
        $wallet->balance += $amount;
        $wallet->save();
    }
}
