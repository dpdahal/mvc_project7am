<?php

class Session
{

    public static function put($key, $value = '')
    {
        if (!isset($key)) return false;

        return $_SESSION[$key] = $value;


    }

    public static function check($key = '')
    {
        if (!isset($key)) return false;
        return isset($_SESSION[$key]);
    }

    public static function get($key = '')
    {
        if (!isset($key)) return false;

        if (self::check($key)) {
            return $_SESSION[$key];

        }

        return '';

    }

    public static function delete($key = '')
    {
        if (!isset($key)) return false;

        if (self::check($key)) {
            unset($_SESSION[$key]);
        }
        return true;

    }

    public function destroy()
    {

        session_destroy();
    }

    public static function isLoginTrue()
    {

        if (!Session::check('is_log_in') || Session::get('is_log_in') != TRUE) {
            $_SESSION['error'] = "please log in first";
            Redirect::to('Admin/login');
        }
    }


//    public static function isValidUserLoginUrl()
//    {
//
//        $getHeader = getallheaders();
//        if (isset($getHeader['Referer'])) {
//          header("Location:".$getHeader['Referer']);
//          exit();
//
//        } else {
//            echo "test";
//        }
//
//    }

}