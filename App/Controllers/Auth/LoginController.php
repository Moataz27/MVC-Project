<?php

namespace App\Controllers\Auth;

use App\Models\User;
use Trinto\Support\Hash;
use Trinto\Validation\Validator;

class LoginController
{
    public function index()
    {
        return (!user()) ? view('auth.login') : redirect('/');
    }

    public function login()
    {

        $v = new Validator;

        $v->setRules([
            'email' => 'required|email',
            'password' => 'required|between:8,64',
        ]);

        $v->make(request()->all());

        if (!$v->passes()) {
            app()->session->setFlash('errors', $v->errors());
            app()->session->setFlash('old', request()->all());

            return back();
        }


        $user = User::where(['email', '=', request('email')]);

        if (count($user) != 0) {
            $password = request('password');

            $hashedPassword = $user[0]->password;

            if (Hash::verify($password, $hashedPassword)) {
                app()->session->set('isLogged', true);
                app()->session->set('email', request('email'));
                app()->session->set('username', $user[0]->username);
                app()->session->set('id', $user[0]->id);
                app()->session->set('name', $user[0]->name);
                return redirect('/');
            } else {
                app()->session->setFlash('failed', 'credentials are incorrect');
                app()->session->setFlash('old', request()->all());
                return back();
            }
        } else {
            app()->session->setFlash('failed', 'credentials are incorrect');
            app()->session->setFlash('old', request()->all());
            return back();
        }
    }

    public function logout()
    {
        if(user()){
            app()->session->remove('isLogged');
            app()->session->remove('username');
            app()->session->remove('id');
            app()->session->remove('name');
            app()->session->remove('email');

            return redirect('/');
        }
        return back();
    }
}
