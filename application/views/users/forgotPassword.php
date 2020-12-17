<?php //require_once ROOT ."/views/inc/header.php" ?>
    <div class="  mt-4">
        <div class="row">
            <div class="col-10 col-md-8 m-auto">
            <?php
            //new Session();
            Session::success("check");
            echo  isset($err) ?  '<div class="text-danger mt-2">'.$err.'</div>' : '' 
             ?>
            <h5 class='text-center m-4'>Type Your Email</h5>
            <form method="POST" action='<?php echo URL ?>/users/forgotPassword'>
                <div class="input-group">
                    <input type="email" name='email' class="form-control" placeholder='Enter email'>
                    <div class="input-group-btn">
                        <input type="submit" name='forgotPassword' value="Send" class="btn btn-success">
                    </div>
                </div>
                <small class="text-muted">enter your email to send an email for you, then check your email to can get new password</small>
            </form>
            </div>
        </div>
    </div>
<!--<form method="POST" action='<?php echo URL ?>/users/forgotPassword'>
    <div class="input-form">
        <div class="">
            <h2 class="text-muted text-center">Forgot Password</h2>
            <small class="text-center">Enter your email to send an email for you, then check your email to can get new password</small>
        </div>
        <div>
            <input class="input-text" type="text" name="email" placeholder="Email">
        </div>
        <input type="submit" name='forgotPassword' value="Send" id="btn">
    </div>
</form>-->
<?php //require_once ROOT ."/views/inc/footer.php" ?>