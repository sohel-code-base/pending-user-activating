<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $ordinaryUsers = $users->filter(function ($value, $key){
            return !$value->is_admin && $value->status === 'pending';
        });
        return view('home', [
            'users' => $ordinaryUsers
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @param User $user
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function status(User $user, $status)
    {
        $user->status = $status;
        $user->save();

        return redirect()->route('home');
    }
}
