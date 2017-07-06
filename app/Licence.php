<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use function func_get_args;

class Licence extends Model
{
    protected $fillable = [];

    public function getRouteKey()
    {
        return 'key';
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function isActive()
    {
        return $this->active;
    }

    public function disable()
    {
        $this->active = false;
        return $this->saveOrFail();
    }

    /**
     * @param array $parameters
     * @return bool
     * @internal param $mac
     * @internal param $hdd
     * @internal param $device_id
     * @internal param $longitude
     * @internal param $latitude
     */
    public function activate(Array $parameters = [])
    {
        $parameters = count($parameters) > 0 ? $parameters : func_get_args();

        $this->mac_address = $parameters['mac'] ?? $parameters[0];
        $this->hdd_id = $parameters['hdd'] ?? $parameters[1];
        $this->device_id = $parameters['device_id'] ?? $parameters[2];
        $this->longitude = $parameters['longitude'] ?? $parameters[3];
        $this->latitude = $parameters['latitude'] ?? $parameters[4];
        $this->active = true;

        return $this->saveOrFail();
    }

//    /**
//     * Setting up query mutator and extractors
//     */
//
//    public function getIpRegisteredAttribute($value)
//    {
//        return decrypt($value);
//    }
//
//    public function getHddIdAttribute($value)
//    {
//        return decrypt($value);
//    }
//
//    public function getLongitudeAttribute($value)
//    {
//        return decrypt($value);
//    }
//
//    public function getLatitudeAttribute($value)
//    {
//        return decrypt($value);
//    }
//
//    public function getDeviceIdAttribute($value)
//    {
//        return decrypt($value);
//    }
//
//    public function getMacAddressAttribute($value)
//    {
//        return decrypt($value);
//    }
//
//    public function getValueAttribute($value)
//    {
//        return decrypt($value);
//    }
//
//    public function setHddIdAttribute($value)
//    {
//        $this->attributes['hdd_id'] = encrypt($value);
//    }
//
//    public function setLongitudeAttribute($value)
//    {
//        $this->attributes['longitude'] = encrypt($value);
//    }
//
//    public function setLatitudeAttribute($value)
//    {
//        $this->attributes['latitude'] = encrypt($value);
//    }
//
//    public function setDeviceIdAttribute($value)
//    {
//        $this->attributes['device_id'] = encrypt($value);
//    }
//
//    public function setMacAddressAttribute($value)
//    {
//        $this->attributes['mac_address'] = encrypt($value);
//    }
//
//    public function setIpRegisteredAttribute($value)
//    {
//        $this->attributes['ip_registered'] = encrypt($value);
//    }
//
//    public function setValueAttribute($value)
//    {
//        $this->attributes['value'] = encrypt($value);
//    }
}
