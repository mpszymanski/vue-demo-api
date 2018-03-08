<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
	protected $guarded = [];

    public function customer()
    {
    	return $this->belongsTo('App\Customer');
    }
}
