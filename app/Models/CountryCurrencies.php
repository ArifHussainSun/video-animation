<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryCurrencies extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->hasMany(User::class, 'country', 'id');
    }

    public function payment()
    {
        return $this->hasMany(Payments::class, 'currency', 'id');
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'currency', 'id');
    }


    public function paymentLink()
    {
        return $this->hasMany(PaymentLink::class, 'currency', 'id');
    }


}

