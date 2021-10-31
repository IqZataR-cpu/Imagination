<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('personal.show', ['User' => \Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        if (isset($request->name)) {
            $user->name = $request->name;
        }

        if (isset($request->email)) {
            $user->email = $request->email;
        }

        if (isset($request->password) & isset($request->password_confirmation))  {
            if ($request->password == $request->password_confirmation) {
                $user->password = bcrypt($request->password);

                $user->save();

                return redirect('/')->with(Auth::logout());
            }
        }

        $user->save();

        return redirect()->route('personal.index');
    }
}
