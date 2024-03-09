<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginCotronller extends Controller
{
    //
    public function index(){
        return view('login');
    }
}
