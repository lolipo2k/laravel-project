<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Addresses;
use App\Models\Orders;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OrdersController extends Controller
{
    public function createNewOrder(Request $request)
    {
        $service = Service::find($request->input('service_id'));

        $cost = 0;

        if ($service['window'])
        {
            $cost += $request->input('window_count') * $service['window_price'];
        }

        if ($service['apartment'])
        {
            if ($request->has('private_house'))
            {
                $cost += ($request->input('rooms') * $service['rooms_price']) * $service['private_house'];
                $cost += ($request->input('bathrooms') * $service['bathrooms_price']) * $service['private_house'];
            } else {
                $cost += $request->input('rooms') * $service['rooms_price'];
                $cost += $request->input('bathrooms') * $service['bathrooms_price'];
            }
        }

        if ($service['repairs'])
        {
            $cost += $request->input('repair_m2') * $service['repair_price'];
            $cost += $request->input('repair_window') * $service['repair_window_price'];

            if ($request->has('repair_stairs'))
            {
                $cost += $service['repair_stairs_price'];
            }
        }

        if ($request->has('userid'))
        {
            $user = User::find($request->input('userid'));
        } else {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => Hash::make(Str::random(8)),
            ]);
        }

        if ($request->has('address_id'))
        {
            $address_id = $request->input('address_id');
        } else {
            $address_id = Addresses::create([
                'user_id' => $user['id'],
                'street' => $request->input('street'),
                'house_number' => $request->input('house_number'),
                'apartment_number' => $request->input('apartment_number'),
                'entrance' => $request->input('entrance'),
                'floor' => $request->input('floor'),
                'intercom' => $request->input('intercom'),
            ]);
        }


        $order = Orders::create([
            'service_id' => $service['id'],
            'address_id' => $address_id,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),

            // хата
            'rooms' => $request->input('rooms') ?? 0,
            'bathrooms' => $request->input('bathrooms') ?? 0,
            'private_house' => $request->has('private_house') ? 1:0,

            // Окна
            'window_count' => $request->input('window_count') ?? 0,

            // Ремонт
            'repair_m2' => $request->input('repair_m2') ?? 0,
            'repair_window' => $request->input('repair_window') ?? 0,
            'repair_stairs' => $request->input('repair_stairs') ?? 0,

            'cost' => $cost,
            'status' => 1,
            'user_id' => $user['id'],
            'kitchen' => $request->input('kitchen') == 'on' ? 1:0,
            'cleaning_date' => $request->input('cleaning_date'),
        ]);

        if ($request->has('additionals'))
        {
            $counts = $request->input('additionals_counts');

            Log::info($counts, $request->input('additionals'));

            foreach ($request->input('additionals') as $key => $id)
            {
                if (isset($counts[$key]))
                {
                    $order->apps()->attach($id, ['count' => $counts[$key]]);
                } else {
                    $order->apps()->attach($id);
                }
            }

            $order->update([
                'cost' => $order->cost += $order->getCotsForApps(),
            ]);
        }
    }
}
