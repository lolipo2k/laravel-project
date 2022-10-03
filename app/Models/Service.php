<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function apps()
    {
        return $this->belongsToMany('App\Models\Additional');
    }

    public function subs()
    {
        return $this->belongsToMany('App\Models\Sub');
    }

    public function furnitures()
    {
        return $this->morphToMany('App\Models\Furniture', 'furnituretables');
    }
}
