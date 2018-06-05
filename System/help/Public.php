<?php

if (!function_exists('public_path')) {

    function public_path($path = '', $rootPath = false)
    {
        if (empty($path)) return false;

        if ($rootPath == true) {
            return $rootPath = ROOT . 'Public/' . $path;

        }


        $publicPath = BASE_URL . 'Public/' . $path;
        return $publicPath;
    }

}