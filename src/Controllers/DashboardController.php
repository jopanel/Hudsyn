<?php

namespace Jopanel\Hudsyn\Controllers;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Optionally, gather statistics or data to display on your dashboard.
        return view('hudsyn::hudsyn.dashboard.index');
    }
}
