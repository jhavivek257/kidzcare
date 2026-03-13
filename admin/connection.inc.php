<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$con=mysqli_connect("localhost","root","Test@123","kidzCare");
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/kidzcare/');
define('SITE_PATH','http://127.0.0.1/kidzcare/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/product/');
?>