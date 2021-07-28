<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Walletaddress extends Model
{
    //
    protected $fillable = [
        'user_id', 'type', 'wallet_address'
    ];
}
