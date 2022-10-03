<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\Vacancies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VacanciesController extends Controller
{
    public function vacancy()
    {
        return view('pages.vacancies', [
            'title' => 'Oferty pracy',
            'faqs' => FAQ::where('vacancies', 1)->get(),
        ]);
    }

    public function registerNewVacancy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3', 'max:32'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'email'],
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Vacancies::create($request->all());

        return redirect()->route('vacancy.success');
    }

    public function vacancySuccess()
    {
        return view('pages.job_success', [
            'title' => 'Success pracy'
        ]);
    }
}
