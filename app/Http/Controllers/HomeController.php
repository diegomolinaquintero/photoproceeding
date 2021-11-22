<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// import user model
use App\Models\User;
// import auth facade
use Auth;
// import image model
use App\Models\Image;

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
        $userlog = Auth::user();
        $imagenes = Image::where('image_path','LIKE', '%content%')->orderBy('created_at', 'desc')->get();
        return view('home',compact('userlog','imagenes'));
    }
}
