<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $appends = [
        'value'
    ];

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }

    public function getValueAttribute()
    {
        return $this->price . " " . $this->currecny;
    }

    public function isApplicable(Promotion $promotion)
    {
        return $this->id == $promotion->product_id && Carbon::now()->diff($promotion->asDateTime('valid_till')) > 0;
    }
}
