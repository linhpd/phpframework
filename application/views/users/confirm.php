<?php //require_once ROOT ."/views/inc/header.php"  ?>


<div class="  mt-4">
    <div class="row">
        <div class="col-10 col-md-8 m-auto ">
            <?php
            //new Session();
            Session::success("confirm");
            echo isset($err) ? '<div class="text-danger">' . $err . '</div>' : null;
            if (!isset($_SESSION['email'])) {
//                Session::set('user_id', $user->user_id);
//                Session::set('user_name', $user->full_name);
//                Session::set('user_img', $user->image);
                Redirect::to('users/login');
            }
            ?>
            <h5 class='text-center my-4'>Please Confirm Your Email</h5>
            <form action="<?php echo URL ?>/users/confirm" method="POST">
                <div class="input-group">
                    <input type="text" name="vkey" class="form-control <?php echo isset($errVkey) ? 'is-invalid' : '' ?>" placeholder='Enter confirmation code...'>
                    <?php echo isset($errVkey) ? '<div class="invalid-feedback">' . $errVkey . '</div>' : '' ?>
                    <div class="input-group-btn">
                        <input type="submit" value="confirm" name="confirm" class="btn btn-success">
                    </div>
                </div>
                <small class="text-muted">Check your email and get verification code and put it in this input within 30 minutes</small>
            </form>
        </div>
    </div>
</div>
<?php //require_once ROOT ."/views/inc/footer.php"  ?>
