<?php
require_once "../Config/Config.php";
require_once(ROOT . 'Vender/Autoload/Autoload.php');

$url = isset($_GET['url']) ? $_GET['url'] : 'dashboard';
$title = ucfirst($url);
$url = $url . '.php';

Session::isLoginTrue();


?>

<?php require_once(ROOT . 'Admin/Layouts/header.php') ?>

<?php
$pagePath = ROOT . 'Admin/pages/' . $url;

if (file_exists($pagePath) && is_file($pagePath)) {
    require_once(ROOT . 'Admin/Layouts/aside.php');
    require_once(ROOT . 'Admin/Layouts/main_header.php');
    require_once $pagePath;
    require_once(ROOT . 'Admin/Layouts/main_footer.php');
} else {
    require_once(ROOT . 'System/errors/404.php');
}


?>

<?php require_once(ROOT . 'Admin/Layouts/footer.php') ?>
