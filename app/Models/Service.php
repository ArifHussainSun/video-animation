<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory,HasRoles,SoftDeletes;

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    
    public function portfolios()
    {
        return $this->hasMany(Portfolio::class, 'service_id', 'id');
    }
}
