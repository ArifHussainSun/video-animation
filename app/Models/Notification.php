<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
    use HasFactory;
    protected $casts = [
        'id' => 'string',
        'data' => 'json'
    ];


    public function user()
    {
        return $this->belongsTo(User::class,'data->data->performed_by','id');
    }

    // public function data(): Attribute
    // {
    //     return new Attribute(
    //         get: fn ($value) => json_decode($value)

    //     );
    // }
}
