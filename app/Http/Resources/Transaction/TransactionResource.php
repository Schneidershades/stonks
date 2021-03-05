<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            $this->mergeWhen($this->action == 'deposit', [
                'initializeNote' => 'You deposited '. $this->amount.' to your account',
            ]),
            $this->mergeWhen($this->action == 'withdrawal', [
                'initializeNote' => 'You withdrew '. $this->amount.' from your account',
            ]),
            $this->mergeWhen($this->action == 'transfer' && $this->user_id == auth()->user()->id, [
                'initializeNote' => 'You made a transfer of '. $this->amount.' from your account',
                'transferAccount' => $this->receiver,
            ]),

            $this->mergeWhen($this->action == 'transfer' && $this->receiver_id == auth()->user()->id, [
                'initializeNote' => 'You received '. $this->amount.' to your account',
                'transferAccount' => $this->user,
            ]),
            'action' => $this->action,
            'status' => $this->status,
            'description' => $this->description,
            'response' => $this->response,
            'amount' => $this->amount,
        ];
    }
}
