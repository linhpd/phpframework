<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="<?php echo URL ?>/css/style.css">

        <title><?php echo $title ?></title>

    </head>
    <body>
        <header class="f-header">
            <div class="f-top-header">
                <div class="f-container">
                    <a class="f-logo" href="<?php echo URL ?>/home/index">DKLN</a>
                    <ul class="f-hdmn">
                        <?php if (Session::existed('user_cart')) { ?>
                            <li class="nav-item">
                                <a class="" href="<?php echo URL ?>/carts/cart">Cart<i class=""></i>
                                    <span style='border-radius:50%'>
                                        <?php Session::get('user_cart') ?>
                                    </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php
                        if (!Session::existed('user_id')) {
                            ?>
                            <li class="item">
                                <a class="" href="<?php echo URL ?>/users/login">Login</a>

                                <ul class="sub_item">

                                    <li>
                                        <a href="<?php echo URL ?>/users/login">Login</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo URL ?>/users/register">Register</a>
                                    </li>
                                </ul>

                            </li><?php } ?>
                        <?php
                        if (Session::existed('user_id')) {
                            ?>
                            <li class="item">
                                <a class="" href="<?php echo URL ?>/users/profile">Profile</a>

                                <ul class="sub_item">

                                    <li>
                                        <a href="<?php echo URL ?>/users/profile">Profile</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo URL ?>/users/logout">Logout</a>
                                    </li>

                                </ul>

                            </li><?php } ?>



                    </ul>
                    <div class="f-search">
                        <form class="" action='<?php echo URL ?>/home/search' method='POST'>
                            <label for="key" class="mf-vhiditem">Nhập tên điện thoại, máy tính, phụ kiện... cần tìm</label>

                            <input class="" type="text" name='search' placeholder="Search">
                            <button type="submit"><img src="<?php echo URL ?>/img/Search.png"></button>
                        </form>
                    </div>
                </div>
            </div> 
            <nav class="f-menu">
                <div class="f-container">
                    <ul class="f-mnul ">
                        
                        <li>
                            <a href="<?php echo URL ?>/home/proCategory/10">Phone
                            </a>

                        </li> 
                        <li>
                            <a href="<?php echo URL ?>/home/proCategory/11">Laptop
                            </a>

                        </li> 
                        <li>
                            <a href="#">News
                            </a>

                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="root">
            <div class="container-all">
                <?php //require_once ROOT ."/views/inc/messages.php"  ?>
                <?php
                if (isset($_SESSION['admin_id'])) {
                    require_once ROOTDIR . "/application/views/inc/sidebar.php";
                }?>