<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Office;
use App\Models\Orders;
use App\Models\User;
use App\Models\Vacancies;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'users' => User::count(),
            'orders' => Orders::where('user_id', '>', 0)->count(),
            'offices' => Office::count(),
            'vacancies' => Vacancies::count(),
            'users_last' => User::orderBy('created_at', 'desc')->limit(10)->get(),
        ]);
    }

    public function orders()
    {
        return view('admin.orders.index', [
            'orders' => Orders::orderBy('id', 'desc')->where('user_id', '>', 0)->paginate(25),
        ]);
    }

    public function orderShow(Orders $order)
    {
        return view('admin.orders.show', [
            'order' => $order,
        ]);
    }

    public function office()
    {
        return view('admin.office', [
            'offices' => Office::orderBy('id', 'desc')->paginate(30),
        ]);
    }

    public function vacancies()
    {
        return view('admin.vacancies', [
            'vacancies' => Vacancies::orderBy('id', 'desc')->paginate(30)
        ]);
    }
}
