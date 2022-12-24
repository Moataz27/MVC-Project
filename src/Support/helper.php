<?php

use Trinto\View\View;
use Trinto\Application;
use Trinto\Http\Request;
use Trinto\Http\Response;
use Trinto\Support\Hash;

if (!function_exists('env')) {
    function env($key, $default = null)
    {
        return $_ENV[$key] ?? value($default);
    }
}

if (!function_exists('old')) {
    function old($key)
    {
        if(app()->session->hasFlash('old')){
            return app()->session->getFlash('old')[$key];
        }
    }
}

if(!function_exists('request')){
    function request($key = null){
        $instance = new Request;

        if($key) {
            return $instance->get($key);
        }

        if(is_array($key)){
            return $instance->only($key);
        }

        return $instance;
    }
}

if(!function_exists('back')){
    function back(){
        return (new Response)->back();
    }
}

if(!function_exists('redirect')){
    function redirect($path){
        return (new Response)->redirect($path);
    }
}

if(!function_exists('user')){
    function user(){
        if(app()->session->has('isLogged')){
            $user['id'] = app()->session->get('id');
            $user['username'] = app()->session->get('username');
            $user['email'] = app()->session->get('email');
            $user['name'] = app()->session->get('name');
            return $user;
        }
        return false;
    }
}

if (!function_exists('bcrypt')) {

    function bcrypt($password)
    {
        return Hash::password($password);
    }
}
if (!function_exists('app')) {
    function app()
    {
        static $instance = null;

        if (!$instance) {
            $instance = new Application;
        }

        return $instance;
    }
}

if (!function_exists('config')) {
    function config($key = null, $default = null)
    {
        if (is_null($key)) {
            return app()->config;
        }

        if (is_array($key)) {
            return app()->config->set($key);
        }

        return app()->config->get($key, $default);
    }
}


if (!function_exists('value')) {
    function value($value)
    {
        return ($value instanceof Closure) ? $value() : $value;
    }
}

if (!function_exists('base_path')) {
    function base_path($path = '')
    {
        return dirname(__DIR__) . "/../" . $path;
    }
}
if (!function_exists('view_path')) {
    function view_path()
    {
        return base_path('views/');
    }
}

if (!function_exists('view')) {
    function view($view, $params = [])
    {
        View::make($view, $params);
    }
}

if (!function_exists("config_path")) {
    function config_path()
    {
        return base_path('config/');
    }
}


if(!function_exists('class_basename')){
    function class_basename($class) {
        $class = is_object($class) ? get_class($class) : $class;


        return basename(str_replace('\\', '/', $class));
    }
}