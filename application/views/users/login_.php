
<!--<link rel="stylesheet" href="<?php //echo URL         ?>/css/login.css">-->
<form action="<?php echo URL ?>/users/login" method="POST">
    <div class="input-form">



        <div class="">
            <h2 class="text-muted text-center">Login To Your Account</h2>
        </div>
        <div>



            <input class="input-text" type="text" name="email" placeholder="Email">
        </div>                            
        <div>         
            <input class="input-text" type="password" name="password" placeholder="Password">
        </div>                                 

        <a href="<?php echo URL ?>/users/forgotPassword">Forgot Password?</a>


        <input type="submit" name="login" value="Login" id="btn">




    </div>
</form>
</div>




