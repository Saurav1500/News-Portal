<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('dashboard.index');
    }
    
    public function upload_news()
    {
        return view('dashboard.pages.upload_news');
    }

    public function login()
    {
        return view('dashboard.login');
    }
    public function register()
    {
        return view('dashboard.signup');
    }
    public function forgot_password()
    {
        return view('dashboard.forgot_password');
    }
}
