<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Furniture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FurnitureController extends Controller
{
    public function index()
    {
        return view('admin.furniture.index', [
            'furnitures' => Furniture::all(),
        ]);
    }

    public function create()
    {
        return view('admin.furniture.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'min:3'],
            'price' => ['required'],
            'minutes' => ['required', 'integer'],
            'cover' => ['required'],
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Furniture::create($request->except('cover') + [
            'cover' => $request->file('cover')->store('public/furniture/cover'),
        ]);

        return redirect()->route('admin.furniture.index');
    }

    public function show(Furniture $furniture)
    {
        //
    }

    public function edit(Furniture $furniture)
    {
        return view('admin.furniture.edit', [
            'furniture' => $furniture,
        ]);
    }

    public function update(Request $request, Furniture $furniture)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'min:3'],
            'price' => ['required'],
            'minutes' => ['required', 'integer'],
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $furniture->update($request->except('cover'));

        if ($request->has('cover'))
        {
            if (Storage::exists($furniture['cover']))
            {
                Storage::delete($furniture['cover']);
            }
            $furniture->update([
                'cover' => $request->file('cover')->store('public/furniture/cover'),
            ]);
        }

        return redirect()->route('admin.furniture.index');
    }

    public function destroy(Furniture $furniture)
    {
        //
    }
}
