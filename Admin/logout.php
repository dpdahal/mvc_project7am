<?php
require_once "../Config/Config.php";
require_once(ROOT . 'Vender/Autoload/Autoload.php');

session_start();
session_destroy();

Redirect::to('Admin/login');

