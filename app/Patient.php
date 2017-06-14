<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use function encrypt;

class Patient extends Model
{

    protected $hidden = [
        'id', 'updated_at', 'client_id', 'lab_id'
    ];

    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }

    public function reports()
    {
        return $this->hasMany(PatientReport::class);
    }

    public function tests()
    {
        return $this->hasManyThrough(PatientTest::class, PatientReport::class);
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
