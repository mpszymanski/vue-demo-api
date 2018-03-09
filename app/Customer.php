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

    public function getFullnameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getEmailLinkAttribute()
    {
        $email = $this->email;
        return "<a href='mailto:$email'>$email</a>";
    }

    public function getPhoneLinkAttribute()
    {
        $phone = $this->phone;
        $solid_phone = preg_replace('/\s+/', '', $phone);
        return "<a href='tel:$solid_phone'>$phone</a>";
    }
}
