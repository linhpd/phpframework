
<?php //require_once ROOT ."/views/inc/header.php"  ?>
<div class="content">
    <div class="profile" style="padding: 20px 0">
        <?php 
            if(Session::existed('admin_id')){?>
                <ul class="admin-menu">
                    <li><a href="<?php echo URL ?>/manufactures/all">All</a></li>
                    <li><a href="<?php echo URL ?>/manufactures/add">Add</a></li>
                </ul>
        <?php } ?>
    </div>
    <div class="profile">
            <div class= 'avatar'>
                <a href="<?php echo URL ?>/users/avatar/<?php Session::get('user_id') ?>" class=''>
                <img style='height:200px;width:200px;border-radius: 50%;' class="" src="<?php echo URL ?>/uploads/<?php Session::get('user_img') ?>" alt="Card image cap">
                </a>
                <div class="fullname">
                    <h5 class=''><?php Session::get('user_name') ?></h5>
                </div>
            </div>

            <div class="">
                <div class="fullname">
                    <a href="<?php echo URL ?>/users/edit/<?php echo Session::get('user_id') ?>" class="btn btn-sm btn-info float-right">Edit Infomation</a>
                </div>
                <div class="info-user">
                    <ul class="">
                        <li class=""><span class="key">ID </span><span><?php Session::get('user_id') ?></span></li>
                        <li class=""><span class="key">Name </span><span><?php Session::get('user_name') ?></span></li>
                        <li class=""><span class="key">Email </span><span><?php echo $user->email ?></span></li>
                        </li>
                    </ul>
                </div>
            </div>
    </div>
</div>
<style>
    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
    }
    .fullname {
        margin-bottom: 10px;
    }
    .info-user ul li {
        width: 100%;
        text-align: left;
    }
</style>
<?php
//require_once ROOT ."/views/inc/footer.php" ?>