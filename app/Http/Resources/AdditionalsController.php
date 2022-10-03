<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AdditionalsController extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'images' => Storage::url($this['cover']),
            'name' => $this['title'],
            'price' => $this['price'],
            'multi' => $this['multi']
        ];
    }
}
