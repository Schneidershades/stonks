<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\Transaction\TransactionResource;
use App\Http\Resources\Transaction\TransactionCollection;
use App\Models\User;

class Transaction extends Model
{
    use HasFactory;

    public $oneItem = TransactionResource::class;
    public $allItems = TransactionCollection::class;

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function receiver()
    {
    	return $this->belongsTo(User::class, 'receiver_id', 'id');
    }
}
