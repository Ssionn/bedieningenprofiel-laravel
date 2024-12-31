<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard');
    }
}
