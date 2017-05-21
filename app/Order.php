<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $casts = [
        'amount' => 'float',
    ];

    function getPaymentTypeAttribute($value)
    {
        switch ($value) {
            case 1 :
                return "PayUMoney";
            default :
                return "Invalid";
        }
    }

    public function client()
    {
        return $this->belongsTo("App\Client");
    }

    public function product()
    {
        return $this->belongsTo("App\Product");
    }
}
