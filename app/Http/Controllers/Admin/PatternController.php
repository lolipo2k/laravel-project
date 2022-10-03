<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pattern;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatternController extends Controller
{
    public function index()
    {
        return view('admin.pattern.index', [
            'service' => Service::where('title', 'Zwykłe')->first(),
            'patterns' => Pattern::all(),
        ]);
    }

    public function create()
    {
        return view('admin.pattern.create', [
            'service' => Service::where('title', 'Zwykłe')->first(),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'min:3'],
            'service_id' => ['required', 'integer'],
            'description' => ['required', 'string', 'min:10'],
            'rooms' => ['required', 'integer'],
            'bathrooms' => ['required', 'integer']
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Pattern::create($request->all());

        return redirect()->route('admin.pattern.index');
    }

    public function edit(Pattern $pattern)
    {
        return view('admin.pattern.edit', [
            'pattern' => $pattern,
            'service' => Service::where('title', 'Zwykłe')->first(),
        ]);
    }

    public function update(Request $request, Pattern $pattern)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'min:3'],
            'service_id' => ['required', 'integer'],
            'description' => ['required', 'string', 'min:10'],
            'rooms' => ['required', 'integer'],
            'bathrooms' => ['required', 'integer']
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $pattern->update($request->all());

        return redirect()->route('admin.pattern.index');
    }

    public function destroy(Pattern $pattern)
    {
        $pattern->delete();
        return back();
    }
}
