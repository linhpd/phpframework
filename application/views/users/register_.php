<!--<link rel="stylesheet" href="<?php echo URL ?>/css/register.css">-->
<form action="<?php echo URL ?>/users/register" method="POST">
    <div class="input-form">
        <h2 class='text-muted text-center'>Register</h2>
        <div class="">

            <div class="">
                <input class="input-text" type="text" name="full_name" placeholder="Full Name" class="form-control <?php echo isset($errName) ? 'is-invalid' : '' ?>">
                <?php echo isset($errName) ? '<div class="invalid-feedback">' . $errName . '</div>' : '' ?>
            </div>
            <div class="">
                <input class="input-text" type="text" name="email" placeholder="Email" class="form-control <?php echo isset($errEmail) ? 'is-invalid' : '' ?>">
                <?php echo isset($errEmail) ? '<div class="invalid-feedback">' . $errEmail . '</div>' : '' ?>
            </div>
            <div class="">
                <input class="input-text" type="password" name="password" placeholder="Password" class="form-control <?php echo isset($errPassword) ? 'is-invalid' : '' ?>">
                <?php echo isset($errPassword) ? '<div class="invalid-feedback">' . $errPassword . '</div>' : '' ?>
            </div>
            <div class="">
                <input class="input-text" type="password" name="password2" placeholder="Confirm Password" class="form-control <?php echo isset($errPassword2) ? 'is-invalid' : '' ?>">
                <?php echo isset($errPassword2) ? '<div class="invalid-feedback">' . $errPassword2 . '</div>' : '' ?>                                </div>
            <div class="btn">
                <input type="submit" name='register' value='Create Account' id="btn">
            </div>

        </div>
</form>        

</div>
