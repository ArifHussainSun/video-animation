<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentLink extends Model
{
    use HasFactory,HasRoles,SoftDeletes;
    
    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasMany(Payments::class,'id','payment_type');
    }

    public function countrycurrencies()
    {
        return $this->belongsTo(CountryCurrencies::class,'currency','id');
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class,'category_id','id');
    }

    public function PaymentSaleType()
    {
        return $this->belongsTo(PaymentSaleTypeModel::class, 'sale_type_id', 'id');
    }
}
