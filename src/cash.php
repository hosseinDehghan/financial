<?php

namespace Hosein\Financial;

use Illuminate\Database\Eloquent\Model;

class cash extends Model
{
    protected $fillable=[
        'id','details','debtorOrCreditor','stocks','receiveOrPay','day','amount'
    ];
}
