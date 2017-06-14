<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use function decrypt;
use function encrypt;

class Client extends Model
{
    protected $fillable = ['name', 'email', 'number', 'ip_registered'];

    public function patients()
    {
        return $this->hasManyThrough(Patient::class, Lab::class);
    }

    public function labs()
    {
        return $this->hasMany(Lab::class);
    }

    public function licences()
    {
        return $this->hasMany(Licence::class);
    }

    public function getEmailAttribute($value)
    {
        return decrypt($value);
    }

    public function getNumberAttribute($value)
    {
        return decrypt($value);
    }

    public function getIpRegisteredAttribute($value)
    {
        return decrypt($value);
    }

    public function getGenderAttribute($value)
    {
        return $value ? 'Male' : 'Female';
    }

    public function setIpRegisteredAttribute($value)
    {
        return $this->attributes['ip_registered'] = encrypt($value);
    }

    public function setEmailAttribute($value)
    {
        return $this->attributes['email'] = encrypt($value);
    }

    public function setNumberAttribute($value)
    {
        return $this->attributes['number'] = encrypt($value);
    }

}
