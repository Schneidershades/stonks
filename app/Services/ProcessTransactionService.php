<?php

namespace App\Services;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Services\WalletBalanceService;
use Carbon\Carbon;

class ProcessTransactionService
{
    public function process($request, $type)
    {
        $error = false;
    	$transaction = new Transaction;
    	$transaction->user_id = auth()->user()->id;
    	$transaction->action = $type;
    	$transaction->description = $request->description;
    	$transaction->amount = $request->amount;

        if($type == 'withdrawal'){

            $receiver = Wallet::where('user_id', auth()->user()->id)->first();

            if($receiver->balance < $request->amount){
                $error = true;
                $transaction->status = 'failed';
                $transaction->response = 'Insufficient balance. Please fund your wallet';

                return [
                    'error' => true,
                    'code' => 403,
                    'message' => 'Insufficient balance. Please fund your wallet'
                ];
            }
        }

    	if($type == 'transfer'){
    		$receiver = User::where('email', $request->receiver_email)->first();
    		$transaction->receiver_id = $receiver->id;
    	}

        // enforce limits per day
        $transactionCount = Transaction::where('action', $type)
            ->whereDate('created_at', Carbon::today()->toDateString())
            ->where('status', 'success')
            ->where('user_id', auth()->user()->id)
            ->get();

        if($transactionCount->count() >= 4) {
            return [
                'error' => true,
                'code' => 403,
                'message' => 'Sorry!!! You have exceeded your limit for the day.'
            ];
        }

        $remainderLimit = $transactionCount->count() - 4;

        $transaction->status = 'success';

    	$transaction->save();

        return [
            'error' => false,
            'code' => 200,
            'message' => "Your $type transaction was successful!!! You have $remainderLimit $type transactions left for the day"
        ];
    }
}
