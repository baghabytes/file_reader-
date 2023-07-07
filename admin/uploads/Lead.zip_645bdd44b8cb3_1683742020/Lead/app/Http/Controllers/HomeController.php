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
        return view('home');
    }


    public function createUser(){
        return view('auth.register');
    }

    public function store(array $data){
       User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'Role' => $data['role_id'],
            'password' => bcrypt($data['password']),
        ]);   
    
        return view('auth.register');
    }



}
