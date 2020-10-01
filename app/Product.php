<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'code', 'stock', 'description', 'image_url', 'category_id', 'unit_id'];

    public function category()
    {
    	return $this->belongsTo('App\Categories');
    }

    public function unit()
    {
    	return $this->belongsTo('App\Unit');
    }

    public function transactionDetails()
    {
        return $this->hasMany('App\TransactionDetail');
    }
}
