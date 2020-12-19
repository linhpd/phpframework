<?php //require_once ROOT ."/views/inc/header.php"   ?>
<div class="content">
    <div class="container-form">
        <div class="signup">
                <h2 class='signup-heading'>Edit Profile</h2>
                <div class="card-body">
                    <form action="<?php echo URL ?>/users/update/<?php echo $user->user_id ?>" method="POST">
                        <div class="form-group">
                            <input class="signup-input" value="<?php echo $user->full_name ?>" type="text" name="full_name" placeholder="Full Name" class="form-control <?php echo isset($errName) ? 'is-invalid' : '' ?>">
                            <?php echo isset($errName) ? '<div class="invalid-feedback">' . $errName . '</div>' : '' ?>
                        </div>
                        <div class="form-group">
                            <input class="signup-input" value="<?php echo $user->email ?>" type="text" name="email" placeholder="Email" class="form-control <?php echo isset($errEmail) ? 'is-invalid' : '' ?>">
                            <?php echo isset($errEmail) ? '<div class="invalid-feedback">' . $errEmail . '</div>' : '' ?>
                        </div>
                        <div class="form-group">
                            <input class="signup-input" type="hidden" name="oldPass" value="<?php echo $user->password ?>">
                            <input class="signup-input" type="password" name="password" placeholder="Password" class="form-control <?php echo isset($errPassword) ? 'is-invalid' : '' ?>">
                            <?php echo isset($errPassword) ? '<div class="invalid-feedback">' . $errPassword . '</div>' : '' ?>
                        </div>
                            <input class="signup-submit" type="submit" name='editProfile' value='Edit' class="btn btn-success btn-block">
                    </form>
                </div>
        </div>
    </div>
</div>
<!--<form action="<?php echo URL ?>/users/update/<?php echo $user->user_id ?>" method="POST">
    <div class="input-form">
        <h2 class='text-muted text-center'>Update</h2>
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
            
                <div >
                    <input class="input-text" type="hidden" name="oldPass" value="<?php echo $user->password ?>">
                    <input class="input-text" type="password" name="password" placeholder="Password" class="form-control <?php echo isset($errPassword) ? 'is-invalid' : '' ?>">
                    <?php echo isset($errPassword) ? '<div class="invalid-feedback">' . $errPassword . '</div>' : '' ?>
                </div>
            </div>
            <div class="btn">
                <input type="submit"name='editProfile' value='Edit' id="btn">
            </div>


        </div>
</form>     -->
<?php
//require_once ROOT ."/views/inc/footer.php" ?>