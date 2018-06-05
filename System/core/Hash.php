<?php
/**
 * Created by PhpStorm.
 * User: dp
 * Date: 5/22/2018
 * Time: 8:13 AM
 */

class Hash
{
    public static function has($field)
    {

        return password_hash($field, PASSWORD_BCRYPT);

    }

    public static function decrypt($string, $hash)
    {

        return password_verify($string,$hash);
    }

}