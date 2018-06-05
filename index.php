<?php
require_once "Config/Config.php";
// required autoload
require_once "Vender/Autoload/Autoload.php";

$url=isset($_GET['url']) ? $_GET['url'] : 'home';
$title=ucfirst($url);
$url=$url.'.php';

?>

<?php require_once(ROOT.'Layouts/header.php') ?>

<?php
$pagePath=ROOT.'views/pages/'.$url;

if(file_exists($pagePath) && is_file($pagePath)){
    require_once (ROOT.'Layouts/top_header.php');
    require_once $pagePath;
    require_once (ROOT.'Layouts/main_section.php');

    require_once (ROOT.'Layouts/main_footer.php');

}else{
    require_once(ROOT.'System/errors/404.php');
}


?>

<?php require_once(ROOT.'Layouts/footer.php') ?>
