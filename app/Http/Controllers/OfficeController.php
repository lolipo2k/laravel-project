<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OfficeController extends Controller
{
    public function office(Request $request)
    {
        if ($request->method() == 'POST')
        {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'min:3', 'max:32'],
                'phone' => ['required', 'string'],
                'email' => ['required', 'email'],
                'm2' => ['required', 'integer'],
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            Office::create($request->except('window', 'chemical_cleaning', 'repairs') + [
                'window' => $request->input('window') == 'on' ? 1 : 0,
                'chemical_cleaning' => $request->input('chemical_cleaning') == 'on' ? 1 : 0,
                'repairs' => $request->input('repairs') == 'on' ? 1 : 0,
            ]);

            return redirect()->route('payments.success');
        }

        return view('order.office', [
            'title' => 'Biuro',
        ]);
    }
}
