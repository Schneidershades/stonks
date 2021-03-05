<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\Wallet\WalletResource;
use App\Http\Resources\Wallet\WalletCollection;
use App\Models\User;

class Wallet extends Model
{
    use HasFactory;

    public $oneItem = WalletResource::class;
    public $allItems = WalletCollection::class;

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
