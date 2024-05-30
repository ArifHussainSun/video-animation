<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Customer extends Model
{
    use HasFactory,HasRoles, SoftDeletes;

    public function payment_link()
    {
        return $this->hasMany(PaymentLink::class);
    }

    public function country()
    {
        return $this->belongsTo(CountryCurrencies::class,'country','id');
    }

    public function payment()
    {
        return $this->hasMany(Payments::class,'customer_id','id');
    }

    public function paymentLink()
    {
        return $this->hasMany(PaymentLink::class,'customer_id','id');
    }
    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }


}
