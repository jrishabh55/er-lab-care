<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use function decrypt;
use function encrypt;

class Licence extends Model
{
    protected $fillable = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function product()
    {
        return $this->belongsTo(Client::class);
    }

    public function order()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Setting up query mutator and extractors
     */

    public function getIpRegisteredAttribute($value)
    {
        return decrypt($value);
    }

    public function getHddIdAttribute($value)
    {
        return decrypt($value);
    }

    public function getLongitudeAttribute($value)
    {
        return decrypt($value);
    }

    public function getLatitudeAttribute($value)
    {
        return decrypt($value);
    }

    public function getDeviceIdAttribute($value)
    {
        return decrypt($value);
    }

    public function getMacAddressAttribute($value)
    {
        return decrypt($value);
    }

    public function getValueAttribute($value)
    {
        return decrypt($value);
    }

    public function setHddIdAttribute($value)
    {
        $this->attributes['hdd_id'] = encrypt($value);
    }

    public function setLongitudeAttribute($value)
    {
        $this->attributes['longitude'] = encrypt($value);
    }

    public function setLatitudeAttribute($value)
    {
        $this->attributes['latitude'] = encrypt($value);
    }

    public function setDeviceIdAttribute($value)
    {
        $this->attributes['device_id'] = encrypt($value);
    }

    public function setMacAddressAttribute($value)
    {
        $this->attributes['mac_address'] = encrypt($value);
    }

    public function setIpRegisteredAttribute($value)
    {
        $this->attributes['ip_registered'] = encrypt($value);
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = encrypt($value);
    }
}
