<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;

class CustomerController extends Controller
{

    function index(){
         return response()->json(Customers::get());
    }

    function store(Request $req){

        Customers::create([
            'name' => $req->name,
            'email' => $req->email,
            'cnic' => $req->cnic,
            'phone' => $req->phone,
            'address' => $req->address,
        ]);

        return response()->json('Success');

    }

}