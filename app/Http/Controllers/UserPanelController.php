<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function myAds()
    {
        $id = Auth::id();
        //$data['ads'] = App\Models\Ad::all();
        $data['ads'] = Ad::where('user_id', $id)->get();
        return view('user-panel.ads', $data);
    }

    public function edit()
    {
        $user = Auth::user();

        return view('user-panel.editform', ['user' => $user]);
    }

    public function update(UpdateUserRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->post('name');
        $user->email = $request->post('email');
        $user->save();

        return redirect()->route('profile');
    }

    public function index()
    {
        $user = Auth::user();
        return view('user-panel.profile', ['user' => $user]);
    }

    public function memorised()
    {
        $user = Auth::user();
        $memorised = $user->memorisedAds;

        return view('user-panel.memorised', compact('memorised'));
    }
}
