<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	protected $guarded = [];

    public function receipts()
    {
    	return $this->hasMany('App\Receipt');
    }
}
