<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['ads'] = Ad::all();
        return view('home', $data);
    }

    public function landing()
    {
        $data["new_ads"] = Ad::where('active', 1)
                            ->orderByDesc('id')
                            ->take(4)
                            ->get();

        $data["popular_ads"] = Ad::where('active', 1)
                                ->orderByDesc('views')
                                ->take(4)
                                ->get();

        return view('landing', $data);
    }
}
