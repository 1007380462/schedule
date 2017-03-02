<?php

namespace App\Http\Controllers;

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
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo 'sdsd';exit;
        //in the early  The project does use file to store blog content instead of database
        //user info stored in the cookie,user log in doesn't use session.
        //$_COOKIE[''];
        //setcookie('','');
        //return view('home');
    }
}
