<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use function decrypt;
use function encrypt;

class Client extends Model
{
    protected $fillable = ['name', 'email', 'number', 'ip_registered'];

    public function licences()
    {
        return $this->hasMany('App\Licence');
    }

    /**
     * Setting up query mutator and extractors
     */

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
