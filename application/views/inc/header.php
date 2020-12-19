<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="<?php echo URL ?>/css/header.css">

        <title><?php echo $title ?></title>
        <link href="<?php echo URL ?>/public/css/reset.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo URL ?>/public/css/style.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <!-- Header -->
        <div class="header">
            <div class="header-top">
                <div class="navbar-link">
                    <ul>
                    <?php if (!Session::existed('user_id')) { ?>
                        <li><a href="<?php echo URL ?>/users/login">Đăng nhập</a></li>
                        <li><a href="<?php echo URL ?>/users/register">Đăng ký</a></li>
                    <?php } else { ?>
                        <?php if (Session::existed('user_cart')) { ?>
                            <li class = "cart">
                                <a href = "<?php echo URL ?>/carts/cart">
                                    <img src = "<?php echo URL?>/public/uploads/cart.png" alt = "cart logo"> 
                                    <span id="card-element" class="badge badge-danger ml-0" style='border-radius:50%'>
                                        <?php Session::get('user_cart') ?>
                                    </span></a>
    <body>

        <div class="header">
            <div class="top-header">
                <div class="container">
                    <div class="menu">
                        <ul class="">
                        <li><a class="" href="<?php echo URL ?>/home/index">DKLN</a></li>
                        <?php if (!Session::existed('user_id')) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo URL ?>/users/register">Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo URL ?>/users/login">Login</a>
                            </li>
                        <?php } else { ?>
                            <?php if (Session::existed('user_cart')) { ?>
                                <li class="nav-item">
                                    <a class="" href="<?php echo URL ?>/carts/cart">Cart<i class=""></i>
                                        <span class="badge badge-danger ml-0" style='border-radius:50%'>
                                            <?php Session::get('user_cart') ?>
                                        </span>
                                    </a>
                                </li>
                            <?php } ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo URL ?>/carts/orders">My Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo URL ?>/users/profile">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo URL ?>/users/logout">Logout</a>
                            </li>

                        <?php }

                        if (Session::existed('email')) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo URL ?>/users/confirm">Confirm</a>
                            </li>
                        <?php } ?>
                        <li><a class="nav-link" href="<?php echo URL ?>/carts/orders">Đơn hàng</a></li>
                        <li><a class="nav-link" href="<?php echo URL ?>/users/profile">Hồ sơ</a></li>
                        <li><a class="nav-link" href="<?php echo URL ?>/users/logout">Đăng suất</a></li>
                        <?php
                    }
                    if (Session::existed('email')) {
                        ?>
<!--                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo URL ?>/users/confirm"></a>
                        </li>-->

                    <?php }
                    ?>
                    <li><a href="#">Thông báo</a></li>
                    <li><a href="#">Trợ giúp</a></li>
                    </ul>
                    </div>
                </div>
            </div>  
            <div class="bot-header">
                <div class="container">
                    <div class="search">
                        <h2>SHOPDKLN</h2>
                        <form class="" action='<?php echo URL ?>/home/search' method='POST'>
                            <input class="" type="text" name='search' placeholder="Search">
                            <button type="submit"><img src="<?php echo URL ?>/img/Search.png"></button>
                        </form>
                    </div>  
                    <ul class="category">
                        <?php 
                if($categories){
                    foreach ($categories as $cat) {?>
                        <li class="item">
                            <a href="<?php echo URL ?>/home/proCategory/<?php echo $cat->cat_id ?>"><?php echo $cat->cat_name ?>
                            </a>
                            <ul class="sub_item">
                            <?php 
                            if($manufactures){
                                foreach ($manufactures as $man) {?>
                                <li>
                                    <a href="<?php echo URL ?>/home/proManufacture/<?php echo $man->man_id ?>"><?php echo $man->man_name ?></a>
                                </li>
                                <?php }
                            }?>
                            </ul>
                        </li>
                    <?php }
                }?>
                                <!-- <li class="item" id="item1">
                                    <a href="#">PC</a>
                                    <ul class="sub_item">
                                        <li><a href="#">Apple</a></li>
                                        <li><a href="#">Dell</a></li>
                                        <li><a href="#">Acer</a></li>
                                        <li><a href="#">Asus</a></li>
                                        <li><a href="#">MSI</a></li>
                                    </ul>
                                </li>
                                <li class="item">
                                    <a href="#">Laptop</a>
                                    <ul class="sub_item">
                                        <li><a href="#">Apple</a></li>
                                        <li><a href="#">Dell</a></li>
                                        <li><a href="#">Acer</a></li>
                                        <li><a href="#">Asus</a></li>
                                        <li><a href="#">MSI</a></li>
                                    </ul>
                                </li>
                                <li class="item">
                                    <a href="#">Tab</a>
                                    <ul class="sub_item">
                                        <li><a href="#">Apple</a></li>
                                        <li><a href="#">Samsung</a></li>
                                        <li><a href="#">Xiaomi</a></li>
                                        <li><a href="#">Huawei</a></li>
                                        <li><a href="#">Lenovo</a></li>
                                    </ul>
                                </li>
                                <li class="item">
                                    <a href="#">Phone</a>
                                    <ul class="sub_item">
                                        <li><a href="#">Apple</a></li>
                                        <li><a href="#">Samsung</a></li>
                                        <li><a href="#">Xiaomi</a></li>
                                        <li><a href="#">Huawei</a></li>
                                        <li><a href="#">Oppo</a></li>
                                    </ul>
                                </li>
                                <li class="item">
                                    <a href="#">Gear</a>
                                </li> -->
                    </ul>
                </div>    
            </div>
            <div class = "header-content">
                <div class = "logo">
                    <a href = "<?php echo URL ?>/home/index">SHOPDKLN</a>
                </div>
                <div class = "search">
                    <div class = "search-input">
                        <form action="<?php echo URL ?>/home/search" method='POST' id="form1">
                            <input type = "text" placeholder = "Enter keyword here" name="search" id="searchText">
                            <button type="submit" form="form1" class = "search-button"><img src = "<?php echo URL?>/public/uploads/search.png" alt = "search logo"></button>
                        </form>
                    </div>
                   
                </div>

            </div>
        </div>
        </div>
        <div class="container all">
            <?php //require_once ROOT ."/views/inc/messages.php" ?>
            <?php
            if (isset($_SESSION['admin_id'])) {
                require_once ROOTDIR . "/application/views/inc/sidebar.php";
            }?>
