<?php

namespace App\Http\Controllers;

use App\Models\Addresses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AddressesController extends Controller
{
    public function index()
    {
        return view('addresses.index', [
           'addresses' => Addresses::orderBy('id', 'desc')->where('user_id', Auth::user()->id)->where('deleted', 0)->paginate(25),
        ]);
    }

    public function create(Request $request)
    {
        if($request->method() == "POST")
        {
            $validator = Validator::make($request->all(), [
                'street' => ['required', 'string', 'min:3', 'max:32'],
                'house_number' => ['required'],
                'apartment_number' => ['required', 'integer'],
                'entrance' => ['required', 'integer'],
                'floor' => ['required', 'integer'],
                'intercom' => ['required', 'integer'],
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            Addresses::create($request->all() + [
                'user_id' => Auth::user()->id
            ]);

            return redirect()->route('profile.index');
        }

        return view('profile.address.create', [
            'title' => 'Dodaj adres',
        ]);
    }

    public function edit(Request $request, Addresses $address)
    {
        if ($request->method() == 'POST')
        {
            $validator = Validator::make($request->all(), [
                'street' => ['required', 'string', 'min:3', 'max:32'],
                'house_number' => ['required'],
                'apartment_number' => ['required', 'integer'],
                'entrance' => ['required', 'integer'],
                'floor' => ['required', 'integer'],
                'intercom' => ['required', 'integer'],
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $address->update($request->all());

            return redirect()->route('profile.index');
        }

        return view('profile.address.edit', [
            'title' => 'Edytuj adres',
            'address' => $address,
        ]);
    }




}
