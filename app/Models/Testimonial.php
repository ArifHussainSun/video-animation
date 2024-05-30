<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Testimonial extends Model
{
    use HasFactory,HasRoles, SoftDeletes;
    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
