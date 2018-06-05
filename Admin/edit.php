<?php

require_once "../Config/Config.php";
require_once(ROOT . 'Vender/Autoload/Autoload.php');

if (Request::get('criteria')) {
    $criteria=Request::get('criteria');
    $obj = new UserController();
    $obj->editUser($criteria);

} else {
    $_SESSION['error'] = 'invalid access';
    Redirect::to('Admin/show_users');
}