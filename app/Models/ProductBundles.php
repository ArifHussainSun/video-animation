<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductBundles extends Model
{
    use HasFactory,SoftDeletes;
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

    protected $casts = [
        'products' => 'json',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class,'category_id','id');
    }

    public function products()
    {
        return $this->belongsToJson(Product::class,'id');
    }

    public function productdetails()
    {
        return $this->belongsTo(Product::class,'id');
    }
}
