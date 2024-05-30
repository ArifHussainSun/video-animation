<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payments extends Model
{
    use HasFactory,HasRoles,SoftDeletes;

    protected $table = 'payments';


    public function category()
    {
        return $this->belongsTo(Categories::class,'category_id','id');
    }

    public function currency()
    {
        return $this->belongsTo(CountryCurrencies::class,'currency','id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class,'customer_id','id');
    }

    public function saleType()
    {
        return $this->belongsTo(PaymentSaleTypeModel::class);
    }

    public function payment_type()
    {
        return $this->belongsTo(PaymentLink::class,'id','payment_type');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'id','payment_id');
    }



}
