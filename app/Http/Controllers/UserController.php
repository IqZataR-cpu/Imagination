<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPasswordRequests;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('personal.show', ['User' => \Auth::user()]);
    }

    public function editPassword(User $user, UserPasswordRequests $requests)
    {

    }
}
