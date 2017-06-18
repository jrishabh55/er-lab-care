<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'username', 'email', 'number', 'ip_registered', 'api_token'];

    public function patients()
    {
        return $this->hasManyThrough(Patient::class, Lab::class);
    }

    public function licences()
    {
        return $this->hasMany(Licence::class);
    }

    public function getEmailAttribute($value)
    {
        return ($value);
    }

    public function getNumberAttribute($value)
    {
        return ($value);
    }

    public function getIpRegisteredAttribute($value)
    {
        return ($value);
    }

    public function getGenderAttribute($value)
    {
        return $value ? 'Male' : 'Female';
    }

    public function setIpRegisteredAttribute($value)
    {
        return $this->attributes['ip_registered'] = ($value);
    }

    public function setEmailAttribute($value)
    {
        return $this->attributes['email'] = ($value);
    }

    public function setNumberAttribute($value)
    {
        return $this->attributes['number'] = ($value);
    }

    public function ownLab(int $id)
    {
        return $this->labs()->where('id', $id)->count() > 0 ? true : false;
    }

    public function labs()
    {
        return $this->hasMany(Lab::class);
    }

}
