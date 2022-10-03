<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promocode;
use Illuminate\Http\Request;

class PromocodeController extends Controller
{
    public function index()
    {
        return view('admin.promocode.index', [
            'promocodes' => Promocode::all(),
        ]);
    }

    public function create()
    {
        return view('admin.promocode.create');
    }

    public function store(Request $request)
    {
        Promocode::create($request->all());
        return redirect()->route('admin.promocode.index');
    }

    public function edit(Promocode $promocode)
    {
        return view('admin.promocode.edit', [
            'promocode' => $promocode,
        ]);
    }

    public function update(Request $request, Promocode $promocode)
    {
        $promocode->update($request->all());

        return redirect()->route('admin.promocode.index');
    }

    public function destroy(Promocode $promocode)
    {
        $promocode->delete();
        return redirect()->route('admin.promocode.index');
    }
}
