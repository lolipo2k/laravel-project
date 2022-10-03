<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Additional;
use App\Models\Furniture;
use App\Models\Pattern;
use App\Models\Service;
use App\Models\Sub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function index()
    {
        return view('admin.service.index', [
            'services' => Service::orderBy('position')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.service.create', [
            'additionals' => Additional::all(),
            'furnitures' => Furniture::all(),
            'subs' => Sub::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'menu_title' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'cover' => ['required'],
            'menu_icon' => ['required'],
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $service = Service::create($request->except('cover', 'additionals', 'subs', 'furnitures'));
        $service->cover = $request->file('cover')->store('public/service/cover');


        if ($request->input('top_index') == 1)
        {
            $service->apartment = 1;

            Service::where('top_index', 1)->update([
                'top_index' => '0',
            ]);

            $service->top_index = 1;
        }

        $service->save();

        if($request->has('subs'))
        {
            $service->subs()->attach($request->input('subs'));
        }

        if ($request->has('furnitures'))
        {
            $service->furnitures()->attach($request->input('furnitures'));
        }

        if($request->has('additionals'))
        {
            $service->apps()->attach($request->input('additionals'));
        }

        return redirect()->route('admin.service.index');
    }

    public function edit(Service $service)
    {
        return view('admin.service.edit', [
            'service' => $service,
            'additionals' => Additional::all(),
            'subs' => Sub::all(),
            'furnitures' => Furniture::all(),
        ]);
    }

    public function update(Request $request, Service $service)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string'],
            'menu_title' => ['required', 'string'],
            'price' => ['required', 'integer'],
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if($request->input('top_index') && $service['top_index'] != 1)
        {
            Service::where('top_index', 1)->update([
                'top_index' => '0',
            ]);

            if ($service['apartment'] == 0)
            {
                $service->update([
                    'top_index' => 1,
                    'apartment' => 1,
                ]);
            } else {
                $service->update([
                    'top_index' => 1,
                ]);
            }
        }

        $service->update($request->except(['additionals', 'furnitures', 'cover', 'subs', 'top_index']));

        $service->subs()->detach();
        if($request->has('subs'))
        {
            $service->subs()->attach($request->input('subs'));
        }

        $service->apps()->detach();
        if($request->has('additionals'))
        {
            $service->apps()->attach($request->input('additionals'));
        }

        $service->furnitures()->detach();
        if ($request->has('furnitures'))
        {
            $service->furnitures()->attach($request->input('furnitures'));
        }

        if($request->hasFile('cover'))
        {
            if(Storage::has($service->cover))
            {
                Storage::delete($service->cover);
            }

            $service->cover = $request->file('cover')->store('public/service/cover');
        }

        $service->save();
        return redirect()->route('admin.service.index');
    }

    public function destroy(Service $service)
    {
        // if(Storage::has($service->cover))
        // {
            // Storage::delete($service->cover);
        // }
        // Pattern::where('service_id', $service->id)->delete();
        // $service->delete();
        return back();
    }

    public function updatePos(Request $request)
    {
        $newPos = 0;
        foreach ($request->input('positions') as $position) {
            Service::where('id', $position)->update([
                'position' => $newPos,
            ]);
            $newPos++;
        }
    }
}
