<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    protected $guarded = [];

    public function receipt()
    {
        return $this->belongTo('App\Receipt');
    }

    public function scopeIsAvailable($query)
    {
    	return $query->where('status', 1);
    }
}
