<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSaleTypeModel extends Model
{
    use HasFactory;

    protected $table = 'payment_sale_type';

    protected $fillable = [
        'name',
        'created_by',
    ];

    public function payments()
    {
        return $this->hasMany(Payments::class);
    }

    public function PaymentLink()
    {
        return $this->hasMany(PaymentLink::class);
    }





}
