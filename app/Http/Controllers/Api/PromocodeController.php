<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PromocodeResource;
use App\Models\Promocode;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class PromocodeController extends Controller
{
    public function check(Request $request)
    {
        $code = Promocode::where('name', $request->input('name'))->where('deleted', 0)->first();

        if ($code)
        {
            return new PromocodeResource($code);
        }

        return response()->json([
            'data' => [
                'status' => false,
            ]
        ]);
    }
}
