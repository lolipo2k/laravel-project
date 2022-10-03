<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Additional;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdditionalController extends Controller
{
    public function index()
    {
        return view('admin.additional.index', [
            'additionals' => Additional::all(),
        ]);
    }

    public function create()
    {
        return view('admin.additional.create', [
            'services' => Service::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'min:3'],
            'price' => ['required'],
            'minutes' => ['required', 'integer'],
            'description' => ['required', 'string', 'min:3'],
            'cover' => ['required'],
            'multi' => ['required'],
            'big_cover' => ['required'],
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Additional::create($request->except('cover', 'big_cover') + [
            'cover' => $request->file('cover')->store('public/additional/cover/small'),
            'big_cover' => $request->file('big_cover')->store('public/additional/cover/big')
        ]);

        return redirect()->route('admin.additional.index');
    }

    public function edit(Additional $additional)
    {
        return view('admin.additional.edit', [
            'additional' => $additional,
            'services' => Service::all(),
        ]);
    }

    public function update(Request $request, Additional $additional)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'min:3'],
            'price' => ['required'],
            'minutes' => ['required', 'integer'],
            'description' => ['required', 'string', 'min:3'],
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $additional->update($request->except('cover', 'big_cover'));

        if($request->hasFile('cover'))
        {
            if(Storage::has($additional->cover))
            {
                Storage::delete($additional->cover);
            }

            $additional->cover = $request->file('cover')->store('public/additional/cover/small');
        }

        if($request->hasFile('big_cover'))
        {
            if(Storage::has($additional->big_cover))
            {
                Storage::delete($additional->big_cover);
            }

            $additional->cover = $request->file('big_cover')->store('public/additional/cover/big');
        }

        $additional->save();
        return redirect()->route('admin.additional.index');
    }

    public function destroy(Additional $additional)
    {
        if (Storage::has($additional->cover))
        {
            Storage::delete($additional->cover);
        }
        $additional->delete();
        return back();
    }
}
