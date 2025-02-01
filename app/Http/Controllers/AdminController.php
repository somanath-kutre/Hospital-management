<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function index(){
        return view('pages.admin.dashboard');
    }

    public function users(){
        return view('pages.admin.registered_users');
    }

    public function creat_user(Request $req){
        $values = $req->all();
        $validatedData = $req->validate([
            // 'name' => 'required|max:255',
            // 'email' => 'required|email|unique:users',
            // 'phone' => 'required|min:6',
        ]);
        return response()->json(['message' => $values]);       
    }
}
