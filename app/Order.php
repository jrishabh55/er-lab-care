<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $casts = [
        'amount' => 'float',
        'discount' => 'float',
        'active' => 'boolean'
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

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
