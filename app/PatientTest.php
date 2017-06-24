<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property  test_id
 * @property  price
 * @property  value
 */
class PatientTest extends Model
{
    protected $hidden = [
        'id', 'created_at', 'updated_at', 'patient_report_id', 'test_id',
    ];

    protected $appends = [
        'name'
    ];

    public function report()
    {
        return $this->belongsTo(PatientReport::class);
    }

    public function getNameAttribute()
    {
        return 'Test Name';
    }
}
