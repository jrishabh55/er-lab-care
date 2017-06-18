<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'name', 'email', 'number', 'lab_id', 'gender', 'dob', 'address', 'referred_by',
    ];


    protected $hidden = [
        'updated_at', 'client_id', 'lab_id'
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
        $this->attributes['number'] = ($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = ($value);
    }


    public function getEmailAttribute($value)
    {
        return ($value);
    }

    public function getNumberAttribute($value)
    {
        return ($value);
    }

    public function getGenderAttribute($value)
    {
        return $value ? 'Male' : 'Female';
    }

}
