
<?php //require_once ROOT ."/views/inc/header.php" ?>
<div class="content">
            <div class="profile">
                
                        <h5 class='signup-heading' style="font-size: 24px">Add Picture</h5>
                        <div class="card-body">
                            <form enctype="multipart/form-data" action="<?php echo URL?>/users/avatar/<?php echo Session::get('user_id') ?>" method="POST">
                                <div class="">
                                    <div style="margin-bottom: 20px;" class="">
                                        <input name='image' type="file" class="custom-file-input <?php echo  isset($errImg) ?  'is-invalid' : '' ?>" id="inputGroupFile01">
                                    </div>
                                    <div class="">
                                        <input class="" name='addAvatar' type="submit" value='Upload'>
                                    </div>
                                </div>
                                <small><?php echo  isset($errImg) ?  '<div class="text-danger">'.$errImg.'</div>' : '' ?></small>
                            </form>
                        </div>
                    </div>
        </div>
<style>
    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
    }
</style>
<?php //require_once ROOT ."/views/inc/footer.php" ?>