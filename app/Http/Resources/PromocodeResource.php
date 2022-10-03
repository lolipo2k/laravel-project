<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PromocodeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'status' => true,
            'name' => $this['name'],
            'percent' => $this['percent'],
        ];
    }
}
