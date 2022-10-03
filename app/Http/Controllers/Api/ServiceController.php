<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdditionalsController;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    public function getAdditionals(Request $request)
    {
        $additionals = Service::find($request->input('id'));

        if ($additionals)
        {
            return AdditionalsController::collection($additionals->apps()->get());
        }

        return response()->json([
            'data' => [
                'status' => false,
            ]
        ]);
    }

    public function getFurniture(Request $request)
    {
        $furnitures = Service::find($request->input('id'));

        if ($furnitures)
        {
            return AdditionalsController::collection($furnitures->furnitures()->get());
        }

        return response()->json([
            'data' => [
                'status' => false,
            ]
        ]);
    }
}
