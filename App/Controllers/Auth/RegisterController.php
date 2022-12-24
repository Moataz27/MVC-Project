<?php

namespace App\Controllers\Auth;


use App\Models\User;
use Trinto\Validation\Validator;

class RegisterController
{
    public function index()
    {
        return (!user()) ? view('auth.signup') : redirect('/');
    }

    public function store()
    {
        $v = new Validator;

        $v->setRules([
            'name' => 'required|alnum|between:8, 32',
            'username' => 'required|alnum|between:8, 32|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|between:8, 64',
            'password_confirmation' => 'required|between:8, 64',
        ]);

        $v->setAliases(['password_confirmation' => 'Password Confirmation']);

        $v->make(request()->all());

        if(!$v->passes()){
            app()->session->setFlash('errors', $v->errors());
            app()->session->setFlash('old', request()->all());

            return back();
        }

        User::create([
            'username' => request('username'),
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
        ]);

        app()->session->setFlash('success', 'Registered successfully');

        return back();
    }
}
