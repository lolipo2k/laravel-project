<?php

namespace App\Http\Controllers;

use App\Models\Addresses;
use App\Models\Orders;
use App\Models\Payments;
use App\Models\Service;
use App\Models\Sub;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function showFormChoice(Service $service)
    {
        return view('order.choice', [
            'title' => $service['title'],
            'service' => $service,
        ]);
    }

    public function choice(Service $service, Request $request)
    {
        $date = explode('.', $request->input('date'));
        $time = explode(':', $request->input('time'));

        $cost = $service['price'];

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

        $order = Orders::create($request->except('additionals', 'additionals_counts', 'furnitures', 'furnitures_counts', 'repair_stairs', 'date', 'time', 'kitchen') + [
            'service_id' => $service->id,
            'status' => 0,
            'kitchen' => $request->input('kitchen') == 'on' ? 1:0,
            'repair_stairs' => $request->input('repair_stairs') == 'on' ? 1:0,
            'cost' => $cost,
            'cleaning_date' => "$date[2]-$date[1]-$date[0] $time[0]:$time[1]:00",
        ]);

        if ($request->has('additionals'))
        {
            $counts = $request->input('additionals_counts');

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

        if ($request->has('furnitures'))
        {
            $counts = $request->input('furnitures_counts');

            foreach ($request->input('furnitures') as $key => $id)
            {
                if (isset($counts[$key]))
                {
                    $order->furnitures()->attach($id, ['count' => $counts[$key]]);
                } else {
                    $order->furnitures()->attach($id);
                }
            }

            $order->update([
                'cost' => $order->cost += $order->getCotsForFurniture(),
            ]);
        }

        if ($request->has('promocode'))
        {
            dd('Code');
        }

        return redirect()->route('order.completion', [
            'service' => $service->id,
            'order' => $order->id,
        ]);
    }

    public function completion(Request $request, Service $service, Orders $order)
    {
        if ($request->method() == 'POST')
        {
            $rules = Validator::make($request->all(), [
                'name' => ['required'],
                'phone' => ['required'],
                'email' => ['required'],
                'rules' => ['required'],
                'data' => ['required'],
                'pay' => ['required'],
            ]);

            if($rules->fails()) {
                return redirect()->back()->withErrors($rules)->withInput();
            }

            if (!Auth::check()) {
                $createUser = Validator::make($request->all(), [
                    'name' => ['required'],
                    'phone' => ['required'],
                    'email' => ['required', 'email', 'unique:users'],
                ]);

                if($createUser->fails()) {
                    return redirect()->back()->withErrors($createUser)->withInput();
                }

                $user = User::create([
                    'name' => $request->input('name'),
                    'phone' => $request->input('phone'),
                    'email' => $request->input('email'),
                    'password' => Hash::make(Str::random(8)),
                ]);

                Auth::login($user, true);
            }

            if ($request->has('address'))
            {
                $order->update([
                    'address_id' => Addresses::where('id', $request->input('address'))->first()->id,
                ]);
            } else {
                $addres = Validator::make($request->all(), [
                    'street' => ['required', 'string', 'min:3', 'max:32'],
                    'house_number' => ['required'],
                    'apartment_number' => ['required', 'integer'],
                    'entrance' => ['required', 'integer'],
                    'floor' => ['required', 'integer'],
                    'intercom' => ['required', 'integer']
                ]);

                if($addres->fails()) {
                    return redirect()->back()->withErrors($addres)->withInput();
                }

                $address = Addresses::create($request->only([ 'street', 'house_number', 'apartment_number', 'entrance', 'floor', 'intercom']) + [
                    'user_id' => Auth::id(),
                ]);

                $order->update([
                    'address_id' => $address->id,
                ]);
            }

            $order->update($request->only('name', 'phone', 'email', 'information') + [
                'user_id' => Auth::id(),
            ]);

            if($request->has('keys'))
            {
                if ($request->input('keys') == 1)
                {
                    $order->update([
                        'keys' => 1,
                        'cost' => $order->cost += config('price.1'),
                    ]);
                } else {
                    $order->update([
                        'keys' => 2,
                        'cost' => $order->cost += config('price.2'),
                    ]);
                }
            }

            if ($request->input('pay') == 2)
            {
                $payments = Payments::create([
                    'user_id' => Auth::id(),
                    'order_id' => $order->id,
                    'sum' => $order->cost,
                ]);

                $order->update([
                    'pay' => $payments->id,
                ]);

                return Redirect::to('https://secure.przelewy24.pl/trnRequest/'.$payments->registerTransfer());
            } else {
                $order->update([
                    'pay' => 0,
                    'status' => 1,
                ]);

                return redirect()->route('payments.success');
            }
        }

        if ($order['status'] == 1)
        {
            return redirect()->route('index');
        }

        return view('order.completion', [
            'title' => 'Zamow',
            'service' => $service,
            'order' => $order,
        ]);
    }
}
