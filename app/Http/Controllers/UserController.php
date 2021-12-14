<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showDetails(User $user)
    {
        return view('details')->with('user', $user);
    }
}
