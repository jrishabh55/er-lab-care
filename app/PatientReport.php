<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientReport extends Model
{
    protected $hidden = [
        'id', 'updated_at', 'patient_id'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function tests()
    {
        return $this->hasMany(PatientTest::class);
    }
}
