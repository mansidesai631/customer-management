<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\User;
use App\Product;

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
        if (Auth::check() && Auth::user()->role_id == 2) {
            $data = Product::where('user_id', [Auth::user()->id])->orderBy('id','DESC')->paginate(5);
            return view('products.index')
                ->with('products', $data);
        }
        else {
            $data = User::whereNotIn('id', [Auth::user()->id])->orderBy('id','DESC')->paginate(5);
            return view('index')
                ->with('users', $data);
        }
    }
}
