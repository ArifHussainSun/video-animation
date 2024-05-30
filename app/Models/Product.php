<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,HasRoles,SoftDeletes;
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

    protected $casts = [
        'products' => 'json',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class,'categories_id','id');
    }

    public function Subcategory()
    {
        return $this->belongsTo(SubCategories::class,'sub_categories_id','id');
    }

    public function currency()
    {
        return $this->belongsTo(CountryCurrencies::class,'currency','id');
    }



    public function product_bundle()
    {
        return $this->hasManyJson(ProductBundle::class,'products','id');
    }

    public function bundle()
    {
        return $this->hasMany(ProductBundle::class,'id');
    }
}
