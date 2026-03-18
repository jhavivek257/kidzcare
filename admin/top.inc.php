<?php
require('connection.inc.php');
require('functions.inc.php');
if (isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN'] != '') {
} else {
   header('location:login.php');
   die();
}

date_default_timezone_set("Asia/Kolkata");
$hour = date("H");

if ($hour < 12) {
   $greeting = "Good Morning";
} elseif ($hour < 17) {
   $greeting = "Good Afternoon";
} elseif ($hour < 21) {
   $greeting = "Good Evening";
} else {
   $greeting = "Good Night";
}
?>
<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>Dashboard Page</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="assets/css/normalize.css">
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="assets/css/font-awesome.min.css">
   <link rel="stylesheet" href="assets/css/themify-icons.css">
   <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
   <link rel="stylesheet" href="assets/css/flag-icon.min.css">
   <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
   <link rel="stylesheet" href="assets/css/style.css">
   <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
   <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css" />
</head>

<body>
   <aside id="left-panel" class="left-panel">
      <nav class="navbar navbar-expand-sm navbar-default">
         <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
               <li class="active">
                  <a href="index.php"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
               </li>
               <li class="menu-title">Menu</li>
               <li class="menu-item-has-children dropdown">
                  <a href="categories.php"><i class="menu-icon fa fa-list"></i>Categories Master</a>
               </li>
               <li class="menu-item-has-children dropdown">
                  <a href="sub_categories.php"><i class="menu-icon fa fa-sitemap"></i>Sub Categories Master</a>
               </li>
               <li class="menu-item-has-children dropdown">
                  <a href="product.php"><i class="menu-icon fa fa-cube"></i>Product Master</a>
               </li>
               <li class="menu-item-has-children dropdown">
                  <a href="order_master.php"><i class="menu-icon fa fa-shopping-cart"></i>Order Master</a>
               </li>
               <li class="menu-item-has-children dropdown">
                  <a href="users.php"><i class="menu-icon fa fa-users"></i>User Master</a>
               </li>
               <li class="menu-item-has-children dropdown">
                  <a href="banner.php"><i class="menu-icon fa fa-image"></i>Banner</a>
               </li>
               <li class="menu-item-has-children dropdown">
                  <a href="product_review.php"><i class="menu-icon fa fa-star"></i>Product Review</a>
               </li>
               <li class="menu-item-has-children dropdown">
                  <a href="contact_us.php"><i class="menu-icon fa fa-envelope"></i>Contact Us</a>
               </li>

            </ul>
         </div>
      </nav>
   </aside>
   <div id="right-panel" class="right-panel">
      <header id="header" class="header">
         <div class="top-left">
            <div class="navbar-header">
               <a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="Logo"></a>
               <a class="navbar-brand hidden" href="index.php"><img src="images/logo2.png" alt="Logo"></a>
               <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
            </div>
         </div>
         <div class="top-right">
            <div class="header-menu">
               <div class="user-area dropdown float-right">
                  <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <span style="margin-right: 10px;"><?php echo $greeting . ", " . $_SESSION['ADMIN_USERNAME'] . " 👋"; ?>! </span>
                     <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                  </a>
                  <div class="user-menu dropdown-menu">
                     <a class="nav-link" href="javascript:void()"><i class="fa fa-user"></i>My Profile</a>
                     <a class="nav-link" href="javascript:void()"><i class="fa fa-cog"></i>Settings</a>
                     <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>Logout</a>
                  </div>
               </div>
            </div>
         </div>
      </header>