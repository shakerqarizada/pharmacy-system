<?php

namespace App\Http\Controllers;

use App\Models\User;



use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //

    public function index()
    {
        $user = User::all();
        return view('frontend.index', compact('user'));
    }
    public function about()
    {
        return view('frontend.about');
    }
    public function contact()
    {
        return view('frontend.contact');
    }
}
