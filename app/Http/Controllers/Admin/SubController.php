<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubController extends Controller
{
    public function index()
    {
        return view('admin.sub.index', [
            'subs' => Sub::all(),
        ]);
    }

    public function create()
    {
        return view('admin.sub.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'min:3'],
            'percent' => ['required', 'integer', 'min:0', 'max:99'],
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        sub::create($request->all());

        return redirect()->route('admin.sub.index');
    }

    public function edit(Sub $sub)
    {
        return view('admin.sub.edit', [
            'sub' => $sub,
        ]);
    }

    public function update(Request $request, Sub $sub)
    {
        $sub->update($request->all());
        return redirect()->route('admin.sub.index');
    }

    public function destroy(Sub $sub)
    {
        return redirect()->route('admin.sub.index');
    }
}
