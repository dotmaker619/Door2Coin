<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = [
        'user_id', 'order_id', 'amount', 'comment', 'transaction_id', 'rate', 'crypto', 'wallet_address'
    ];
}
