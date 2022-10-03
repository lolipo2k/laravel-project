<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'index'
    ];

    public function faq()
    {
        return $this->hasMany('App\Models\FAQ', 'category_id', 'id');
    }

}
