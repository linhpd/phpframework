<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="<?php echo URL ?>/public/css/reset.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo URL ?>/public/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- Header -->
    <div class="header">
        <div class="header-top">
            <div class="navbar-link">
                <a href="#">Thông báo</a>
                <a href="#">Trợ giúp</a>
                <a href="#">Đăng nhập</a>
                <a href="#">Đăng ký</a>
            </div>
        </div>
        <div class="header-content">
            <div class="logo">
                <a href="index.php"><img src="<?php echo PATH_URL_IMG ?>logo.png" alt="shop logo"></a>
            </div>
            <div class="search">
                <div class="search-input">
                    <form>
                        <input type="text" placeholder="Enter keyword here">
                    </form>
                </div>
                <button class="search-button"><img src="<?php echo PATH_URL_IMG ?>search.png" alt="search logo"></button>
            </div>
            <div class="cart">
                <a href="#"><img src="<?php echo PATH_URL_IMG ?>cart.png" alt="cart logo"> </a>
            </div>
        </div>
    </div>
