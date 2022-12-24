<?php
namespace Trinto\Http;



class Response {
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public function back()
    {
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }

    public function redirect($path)
    {
        header('Location:' . $path);
    }
}