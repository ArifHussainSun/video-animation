<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategories extends Model
{
    use HasFactory,HasRoles,SoftDeletes;

    public function categories(){
        return $this->belongsTo(Categories::class);

    }

    public function product()
    {
        return $this->hasMany(Product::class,'sub_categories_id','id');
    }

}
