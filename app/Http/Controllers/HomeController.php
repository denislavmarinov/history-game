<?php

namespace App\Http\Controllers;

use App\GameLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $logs = GameLog::get_last_5_logs_for_user(Auth::user()->id);

        return view('home', compact('logs'));
    }
}
