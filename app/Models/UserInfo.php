<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Arr;

class UserInfo extends Model
{
    use HasFactory;

    // public static function getKeyvalueAttribute($value)
    // {

    //     $data = json_decode($value);
    //     $formData = Arr::pluck($data, 'value', 'name');

    //     return json_encode($formData);

    // }

    public function userInfos(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
