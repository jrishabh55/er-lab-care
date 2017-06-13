<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientTest extends Model
{
    protected $hidden = [
        'id', 'updated_at', 'patient_report_id', 'test_id',
    ];

    public function report()
    {
        return $this->belongsTo('App\PatientReport');
    }
}
