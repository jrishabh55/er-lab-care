<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $hidden = [
        'id', 'updated_at', 'client_id',
    ];

    public function owner()
    {
        return $this->belongsTo(Client::class);
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
