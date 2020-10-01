<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $guarded = [''];

    public function Transaction()
    {
    	return $this->belongsTo('App/Transaction');
    }

    public function product()
    {
        return $this->belongsTo('App/Product');
    }
}