<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    public function redirect()
    {
        if (Auth::check()) {
            if (Auth::user()->usertype === '0') {
                return redirect('index');
            }
            else {
                return view('admin.home');
            }
        }
    }
}
