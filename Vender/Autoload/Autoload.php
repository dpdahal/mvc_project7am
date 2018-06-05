<?php


function Autoload($class = '')
{
    $class = $class . '.php';
    $ControllerPath = ROOT . 'Application/Controller/' . $class;
    $corePath = ROOT . 'System/core/' . $class;
    $modelPath = ROOT . 'Application/Model/' . $class;
    if (file_exists($ControllerPath) && is_file($ControllerPath)) {
        require_once $ControllerPath;
    } elseif (file_exists($corePath) && is_file($corePath)) {
        require_once $corePath;
    }
    elseif (file_exists($modelPath) && is_file($modelPath)) {
        require_once $modelPath;
    }
    else {
        throw new PDOException('path not found');
    }


}

spl_autoload_register('Autoload');

require_once (ROOT.'System/help/Compiler.php');
require_once (ROOT.'System/help/Messages.php');
require_once (ROOT.'System/help/Public.php');
