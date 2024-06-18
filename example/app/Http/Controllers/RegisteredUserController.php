<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        // dd(request()->all());

        // validate
        $attributes = request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'max:254'],
            'password' => ['required', Password::min(6), 'confirmed'], //min(6)->letters()->numbers()->symbols()
            // confirmed will look for password_confirmation attribute, this will alow the password confirmtion
        ]);

        // create the user
        $user = User::create($attributes);

        // instead of one-by-one
        // User::create([
        //     'first_nmae' => request('first_name');
        // ]);

        // or in line the validation
        // User::create(request()->validate([
        //     'first_name' => ['required'],
        //     'last_name' => ['required'],
        //     'email' => ['required', 'email', 'max:254'],
        //     'password' => ['required', Password::min(6), 'confirmed'],
        // ]));

        // log in
        Auth::login($user);

        // redirect
        return redirect('/jobs');   
    }
}
