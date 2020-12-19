<div class="content">
    <div class="container-form">
        <div class="signup">
            <h1 class="signup-heading">Đăng ký</h1>
            <form action="#" class="signup-form" autocomplete="off">
                <label for="username" class="signup-label">User name</label>
                <input type="text" id="username" name="username" class="signup-input" required placeholder="enter your username">
                <label for="password" class="signup-label">Password</label>
                <input type="password" id="password" name="password" class="signup-input" required placeholder="enter your password">
                <label for="name" class="signup-label">Name</label>
                <input type="text" id="name" name="name" class="signup-input" required placeholder="enter your name">
                <label for="date" class="signup-label">Date</label>
                <input type="date" id="date" name="date" class="signup-input" placeholder="dd/mm/yyyy">
                <label for="phone" class="signup-label">Phone</label>
                <input type="tel" id="phone" name="phone" class="signup-input" placeholder="ex: 0123456789" pattern="[0-9]{10}">
                <label for="address" class="signup-label">Address</label>
                <input type="text" id="address" name="address" class="signup-input" placeholder="enter your address">
                <button class="signup-submit">Đăng ký</button>
            </form>
            <p class="signup-already">
                <span>Bạn đã có tài khoản ?</span>
                <a href="#" class="signup-login-link">Đăng nhập</a>
            </p>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?php echo URL ?>/css/register.css">
<div class="register">
                        <h2 class='text-muted text-center'>Register</h2>
                        <div class="">
                            <form action="<?php echo URL ?>/users/register" method="POST">
                                <div class="">
                                    <input type="text" name="full_name" placeholder="Full Name" class="form-control <?php echo  isset($errName) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($errName) ?  '<div class="invalid-feedback">'.$errName.'</div>' : '' ?>
                                </div>
                                <div class="">
                                    <input type="text" name="email" placeholder="Email" class="form-control <?php echo  isset($errEmail) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($errEmail) ?  '<div class="invalid-feedback">'.$errEmail.'</div>' : '' ?>
                                </div>
                                <div class="">
                                    <input type="password" name="password" placeholder="Password" class="form-control <?php echo  isset($errPassword) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($errPassword) ?  '<div class="invalid-feedback">'.$errPassword.'</div>' : '' ?>
                                </div>
                                <div class="">
                                    <input type="password" name="password2" placeholder="Confirm Password" class="form-control <?php echo  isset($errPassword2) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($errPassword2) ?  '<div class="invalid-feedback">'.$errPassword2.'</div>' : '' ?>                                </div>
                                <div class="btn">
                                    <input type="submit" name='register' value='Create Account' id="btn">
                                </div>
                            </form>
                        </div>
                    
 <style>
     .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
     }
 </style>
</div>
