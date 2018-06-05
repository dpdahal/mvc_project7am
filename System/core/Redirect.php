<?php
/**
 * Created by PhpStorm.
 * User: dp
 * Date: 5/23/2018
 * Time: 7:38 AM
 */

class Redirect
{

    public static function to($path = null)
    {
        if (empty($path)) throw new PDOException('path not set');
        if (strpos($path, '/')) {
            $pathData = explode('/', $path);
            $redirectPath = BASE_URL . $pathData[0] . '/' . $pathData[1];
            header('Location:' . $redirectPath);
            exit();
        }

    }

}