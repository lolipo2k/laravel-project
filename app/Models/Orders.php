<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Orders extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->HasMany('App\Models\User', 'id', 'user_id');
    }

    public function service()
    {
        return $this->HasMany('App\Models\Service', 'id', 'service_id');
    }

    public function apps()
    {
        return $this->belongsToMany('App\Models\Additional')->withPivot('count');
    }

    public function sub()
    {
        return $this->HasMany('App\Models\Sub', 'id', 'sub_id');
    }

    public function payment()
    {
        return $this->hasMany('App\Models\Payments', 'id', 'pay');
    }

    public function address()
    {
        return $this->hasMany('App\Models\Addresses', 'id', 'address_id');
    }

    public function furnitures()
    {
        return $this->morphToMany('App\Models\Furniture', 'furnituretables')->withPivot('count');
    }

    public function getCotsForApps()
    {
        $cost = 0;

        foreach ($this->apps()->get() as $app)
        {
            $cost += $app['price'] * $app->pivot['count'];
        }

        return $cost;
    }

    public function getCotsForFurniture()
    {
        $cost = 0;

        foreach ($this->furnitures()->get() as $furniture)
        {
            $cost += $furniture['price'] * $furniture->pivot['count'];
        }

        return $cost;
    }

}
