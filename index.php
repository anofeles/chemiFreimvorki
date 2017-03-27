<?php
define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');
@session_start();
if(isset($_GET['aut'])){
    session_destroy();
    header('Location http://intranet.tsu.ge/grantebi/index.php/home/index');
}
switch (ENVIRONMENT) {
    case 'development':
        error_reporting(-1);
        ini_set('display_errors', 1);
        break;

    case 'testing':
    case 'production':
        ini_set('display_errors', 0);
        if (version_compare(PHP_VERSION, '5.3', '>=')) {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        } else {
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
        }
        break;

    default:
        header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
        echo 'The application environment is not set correctly.';
        exit(1); // EXIT_ERROR
}
if(isset($_SERVER['PATH_INFO']) && !empty($_SERVER['PATH_INFO'])) {
    $indexUrl = explode("/", $_SERVER['PATH_INFO']);
}else{$indexUrl[1] = "home";$indexUrl[2] = "index";}
require_once 'setings/db.php';
require_once 'setings/viuvseting.php';
$viu = new viuvset($indexUrl[1]);
$viu->post($_POST);
$viu->url($indexUrl);
$viu->controler($indexUrl[1], $indexUrl[2], $indexUrl, $_POST);
$viu->baseurl("http://intranet.tsu.ge/grantebi/index.php");
require_once 'views/' . $viu->viufile . '.php';
?>