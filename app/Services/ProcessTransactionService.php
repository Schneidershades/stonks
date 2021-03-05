<?php

namespace App\Services;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Services\WalletBalanceService;

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
                    'code' => 401,
                    'message' => 'Insufficient balance. Please fund your wallet'
                ];
            }
        }

    	if($type == 'transfer'){
    		$receiver = User::where('email', $request->receiver_email)->first();
    		$transaction->receiver_id = $receiver->id;
    	}

        $transaction->status = 'success';

    	$transaction->save();

        return [
            'error' => false,
            'code' => 200,
            'message' => "Your $type transaction was successful"
        ];
    }
}
