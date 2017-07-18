<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use function bcrypt;

class Client extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{

    use Authenticatable, Authorizable, CanResetPassword, Notifiable;

    protected $fillable = ['name', 'username', 'email', 'number', 'ip_registered', 'api_token'];

    protected $hidden = ['id', 'password', 'api_token', 'ip_registered', 'remember_token', 'updated_at'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function invoices()
    {
        return $this->hasManyThrough(Invoice::class, Order::class);
    }

    public function patients()
    {
        return $this->hasManyThrough(Patient::class, Lab::class);
    }

    public function getGenderAttribute($value)
    {
        return $value ? 'Male' : 'Female';
    }

//    public function getEmailAttribute($value)
//    {
//        return decrypt($value);
//    }
//
//    public function getNumberAttribute($value)
//    {
//        return decrypt($value);
//    }
//
//    public function getIpRegisteredAttribute($value)
//    {
//        return decrypt($value);
//    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

//    public function setIpRegisteredAttribute($value)
//    {
//        return $this->attributes['ip_registered'] = encrypt($value);
//    }
//
//    public function setEmailAttribute($value)
//    {
//        return $this->attributes['email'] = encrypt($value);
//    }
//
//    public function setNumberAttribute($value)
//    {
//        return $this->attributes['number'] = encrypt($value);
//    }

    public function ownLab(int $id)
    {
        return $this->labs()->where('id', $id)->count() > 0 ? true : false;
    }

    public function labs()
    {
        return $this->hasMany(Lab::class);
    }

    public function hasFreeLicences()
    {
        return $this->licences()->where('active', false)->count() > 0;
    }

    public function licences()
    {
        return $this->hasMany(Licence::class);
    }

    public function getFreeLicence()
    {
        return $this->licences()->where('active', false)->first();
    }
}
