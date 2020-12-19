<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
