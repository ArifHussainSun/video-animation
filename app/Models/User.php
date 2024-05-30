<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable  , HasRoles, SoftDeletes;


    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function notification(){
        return $this->hasMany(Notification::class,'id', 'data->data[0]->performed_by');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return [];
    }

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function payment_link()
    {
        return $this->hasMany(PaymentLink::class);
    }

    public function country()
    {
        return $this->belongsTo(CountryCurrencies::class,'country','id');
    }

    public function payment()
    {
        return $this->hasMany(Payments::class,'customer_id','id');
    }

    public function paymentLink()
    {
        return $this->hasMany(PaymentLink::class,'customer_id','id');
    }
   
    public function user_Infos(){
        return $this->hasMany(UserInfo::class, 'user_id', 'id');
    }
}
