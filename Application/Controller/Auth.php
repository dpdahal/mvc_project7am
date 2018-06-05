<?php

trait Auth
{

    public function isLogIn($username = '', $password = '')
    {
        $result = $this->getBy('username', $username);

        if ($result) {
            $userPassword = $result->password;
            if (Hash::decrypt($password, $userPassword)) {
                return $this->isSuccessLogin($result);
            } else {
                $_SESSION['error'] = "username and password not match";
                Redirect::to('Admin/login');
            }

        } else {
            $_SESSION['error'] = " invalid access ";
            Redirect::to('Admin/login');
        }

        return false;

    }

    public function isSuccessLogin($result = '')
    {
        if (empty($result)) return false;
        Session::put('user_id', $result->id);
        Session::put('user_name', $result->name);
        Session::put('user_username', $result->username);
        Session::put('user_email', $result->email);
        Session::put('user_type', $result->user_type);
        Session::put('user_image', $result->image);
        Session::put('is_log_in', TRUE);
        Redirect::to('Admin/dashboard');

    }
}