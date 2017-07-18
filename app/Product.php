<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $appends = [
        'full_price'
    ];

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }

    public function getFullPriceAttribute()
    {
        return $this->price . " " . $this->currency;
    }

    public function isApplicable(Promotion $promotion)
    {
        return $this->id == $promotion->product_id && Carbon::now()->diff($promotion->asDateTime('valid_till')) > 0;
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
