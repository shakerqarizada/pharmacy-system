<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Medicine;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //

    public function index()
    {
        $users = User::all();
        $medicines = Medicine::with(['category', 'supplier'])
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
        return view('frontend.index', compact('users', 'medicines'));
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
