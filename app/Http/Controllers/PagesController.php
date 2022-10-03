<?php

namespace App\Http\Controllers;

use App\Models\Additional;
use App\Models\Category;
use App\Models\Pattern;
use App\Models\Service;
use App\Models\Sub;

class PagesController extends Controller
{
    public function faq()
    {
        return view('pages.faq', [
            'title' => 'Pytania i odpowiedzi',
            'categories' => Category::all(),
        ]);
    }

    public function about()
    {
        return view('pages.about', [
            'title' => 'O nas',
        ]);
    }

    public function privacy()
    {
        return view('pages.privacy', [
            'title' => 'Polityka prywatności',
        ]);
    }

    public function review()
    {
        return view('pages.review', [
            'title' => 'Opinie',
        ]);
    }

    public function price()
    {
        return view('pages.price', [
            'title' => 'Cennik',
            'subs' => Sub::orderBy('percent')->get(),
            'patterns' => Pattern::all(),
            'additionals' => Additional::all(),
            'window' => Service::where('title', 'Mycie okien')->first(),
            'remont' => Service::where('title', 'Po Remoncie')->first(),
        ]);
    }

    public function additionals(Additional $additional)
    {
        return view('pages.additional', [
            'title' => $additional['title'],
            'app' => $additional,
        ]);
    }
}
