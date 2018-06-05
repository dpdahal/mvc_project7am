<?php

class Request
{


    public static function Method($method = 'post')
    {

        switch ($method) {
            case "post":
                return $_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST);
                break;
            case 'get':
                return $_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET);
                break;
        }
    }

    public static function post($field)
    {

        return filter_input(INPUT_POST, $field, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    }
    public static function get($field)
    {

        return filter_input(INPUT_GET, $field, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    }

}