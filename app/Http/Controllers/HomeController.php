<?php

namespace App\Http\Controllers;

use App\Models\Additional;
use App\Models\FAQ;
use App\Models\Pattern;
use App\Models\Service;
use App\Models\Sub;

class HomeController extends Controller
{
    public function index()
    {
        return view('index.index', [
            'title' => 'Strona główna',
            'top_index_service' => Service::where('top_index', 1)->first(),
            'faqs' => FAQ::where('index', 1)->get(),
            'services' => Service::all(),
            'additionals' => Additional::all(),
            'patterns' => Pattern::all(),
            'subs' => Sub::all(),
        ]);
    }
}
