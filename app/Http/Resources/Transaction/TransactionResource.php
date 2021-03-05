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
            $this->mergeWhen($this->action == 'transfer', [
                'initializeNote' => 'You tranferred '. $this->amount.' to '. $this->reciever->username,
            ]),
            'action' => $this->action,
            'status' => $this->status,
            'description' => $this->description,
            'response' => $this->response,
            'amount' => $this->amount,
        ];
    }
}
