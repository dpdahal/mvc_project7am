<?php
/**
 * Created by PhpStorm.
 * User: dp
 * Date: 5/24/2018
 * Time: 7:33 AM
 */

class Token
{

    public static function generate()
    {
        return Session::put('token', md5(time() . uniqid()));
    }

    public static function check($tokenValue = '')
    {
        if (!isset($tokenValue)) return false;
        if (Session::get('token') == $tokenValue) {
            return Session::delete('token');

        }

        return false;


    }

    public static function input()
    {

        return "<input type='hidden' name='token' value=" . self::generate() . ">";
    }

}