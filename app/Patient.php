<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use function encrypt;

class Patient extends Model
{

    protected $hidden = [
        'id', 'updated_at',
    ];

    public function reports()
    {
        return $this->hasMany('App\PatientReport');
    }

    public function tests()
    {
        return $this->hasManyThrough('App\PatientTest', 'App\PatientReport');
    }

    public function setNumberAttribute($value)
    {
        $this->attributes['number'] = encrypt($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = encrypt($value);
    }


    public function getEmailAttribute($value)
    {
        return decrypt($value);
    }

    public function getNumberAttribute($value)
    {
        return decrypt($value);
    }

    public function getGenderAttribute($value)
    {
        return $value ? 'Male' : 'Female';
    }


}
