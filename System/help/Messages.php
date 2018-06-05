<?php


if (!function_exists('Messages')) {

    function Messages()
    {

        if (isset($_SESSION['success'])) {
            $class = 'alert alert-success';
            $message = $_SESSION['success'];
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            $class = 'alert alert-danger';
            $message = $_SESSION['error'];
            unset($_SESSION['error']);
        }
        $output = '';

        if (isset($message)) {
            $output .= "<div class='{$class}'>";
            $output .= $message;
            $output .= "</div>";

        }

        return $output;

    }
}