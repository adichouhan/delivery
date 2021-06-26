<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingDetail extends Model
{
    protected $guarded = [];


    public function sender(){
        return $this->hasOne(User::class, 'sender_id', 'id')->pluck('username', 'phone_number');
    }

    public function receiver(){
        return $this->hasOne(User::class, 'sender_id', 'id')->pluck('username', 'phone_number');
    }

}
