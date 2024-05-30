<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use HasFactory,HasRoles,SoftDeletes;

    protected $table = 'categories';

    public function subcategories(){
        return $this->hasMany(SubCategories::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class,'categories_id','id');
    }

    public function product_Bundle()
    {
        return $this->hasMany(ProductBundles::class,'category_id','id');
    }


    public function payments()
    {
        return $this->belongsToMany(Payments::class,'category_id','id');
    }

    public function paymentLink()
    {
        return $this->hasMany(PaymentLink::class,'category_id','id');
    }


}
