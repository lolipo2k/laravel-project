<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FAQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    public function index()
    {
        return view('admin.faq.index', [
            'items' => FAQ::all(),
        ]);
    }

    public function create()
    {
        return view('admin.faq.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'min:3'],
            'category_id' => ['required'],
            'index' => ['required'],
            'description' => ['required', 'string', 'min:10'],
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        FAQ::create([
            'title' => $request->input('title'),
            'index' => $request->input('index'),
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description')
        ]);

        return redirect()->route('admin.faq.index');
    }

    public function show(FAQ $faq)
    {
        //
    }

    public function edit(FAQ $faq)
    {
        return view('admin.faq.edit', [
            'faq' => $faq,
            'categories' => Category::all(),
        ]);
    }

    public function update(Request $request, FAQ $faq)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'min:3'],
            'category_id' => ['required'],
            'index' => ['required'],
            'description' => ['required', 'string', 'min:10'],
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $faq->update($request->all());
        return redirect()->route('admin.faq.index');
    }

    public function destroy(FAQ $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faq.index');
    }
}
