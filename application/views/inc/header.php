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
                    <?php if (!Session::existed('user_id')) { ?>
                        <a href="<?php echo URL ?>/users/login">Đăng nhập</a>
                        <a href="<?php echo URL ?>/users/register">Đăng ký</a>
                    <?php } else { ?>
                        <?php if (Session::existed('user_cart')) { ?>
                            <div class = "cart">
                                <a href = "<?php echo URL ?>/carts/cart">
                                    <img src = "<?php echo URL?>/public/uploads/cart.png" alt = "cart logo"> 
                                    <span id="card-element" class="badge badge-danger ml-0" style='border-radius:50%'>
                                        <?php Session::get('user_cart') ?>
                                    </span></a>
                            </div>
                        <?php } ?>
                        <a class="nav-link" href="<?php echo URL ?>/carts/orders">Đơn hàng</a>
                        <a class="nav-link" href="<?php echo URL ?>/users/profile">Hồ sơ</a>
                        <a class="nav-link" href="<?php echo URL ?>/users/logout">Đăng suất</a>
                        <?php
                    }
                    if (Session::existed('email')) {
                        ?>
<!--                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo URL ?>/users/confirm"></a>
                        </li>-->

                    <?php }
                    ?><a href="#">Thông báo</a>
                    <a href="#">Trợ giúp</a>
                </div>
            </div>
            <div class = "header-content">
                <div class = "logo">
                    <a href = "index.php"><img src = "<?php echo PATH_URL_IMG ?>logo.png" alt = "shop logo"></a>
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
