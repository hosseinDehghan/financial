<?php

namespace Hosein\Financial;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable=[
        'id','stock','month','year'
    ];
}
