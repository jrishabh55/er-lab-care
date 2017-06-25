<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function pay(float $amount)
    {
        $this->paid_amount = $amount;
        $this->paid = $this->paid_amount == $amount;
        return $this->saveOrFail();
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
