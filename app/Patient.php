<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use function encrypt;

class Patient extends Model
{
    public function setNumberAttribute($value)
    {
        $this->attributes['number'] = encrypt($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = encrypt($value);
    }
}
