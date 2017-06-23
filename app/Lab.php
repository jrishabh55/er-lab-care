<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $hidden = [
        'updated_at', 'client_id',
    ];

    protected $fillable = [
        'name'
    ];

    public function owner()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
