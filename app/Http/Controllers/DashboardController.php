<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->level === 'admin') {
                return redirect('/admin');
            } elseif (Auth::user()->level === 'user') {
                return redirect('/user');
            }
        }

        return view('welcome');
    }
}
