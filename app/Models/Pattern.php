<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pattern extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function service()
    {
        return $this->hasOne('App\Models\Service', 'id', 'service_id');
    }

    public function getPrice()
    {
        $service = $this->service()->first();
        $price = $service['price'];

        $price += ($service['rooms_price'] * $this['rooms']);
        $price += ($service['bathrooms_price'] * $this['bathrooms']);

        return $price;
    }
}
