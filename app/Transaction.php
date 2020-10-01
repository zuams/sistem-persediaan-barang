<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [''];

    public function transactionDetails()
    {
    	return $this->hasMany('App\TransactionDetail');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
