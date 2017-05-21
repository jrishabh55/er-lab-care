<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = "promotions";

    protected $casts = [
        'product_id' => 'int'
    ];

    protected $dates = [
        'valid_until'
    ];

    public function product()
    {
        return $this->belongsTo("App\Product");
    }
}
