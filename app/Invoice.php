<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use function is_null;

class Invoice extends Model
{
    protected $casts = [
        'discount' => 'float',
        'amount' => 'float',
        'paid' => 'boolean',
        'paid_amount' => 'float',
        'paid_date' => 'date'
    ];

    protected $appends = ['owner'];

    public function pay(String $transaction_id = null, float $amount = null)
    {
        if (!is_null($amount)) {
            $this->paid_amount += $amount;
            $this->paid = $this->amount == $this->paid_amount;
        } else {
            $this->paid_amount = $this->amount;
            $this->paid = true;
        }
        $this->transaction_id = $transaction_id;
        $this->paid_date = Carbon::now();
        return $this->saveOrFail();
    }

    public function isPayable()
    {
        return !$this->paid;
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getOwnerAttribute()
    {
        return $this->owner();
    }

    public function owner()
    {
        return $this->order->client;
    }
}
