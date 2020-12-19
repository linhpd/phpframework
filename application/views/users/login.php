<div class="content">
      <div class="container-form">
          <div class="signup">
              <h1 class="signup-heading">Đăng nhập</h1>
              <form action="<?php echo URL?>/users/login" class="signup-form" method="POST" >
                  <label for="username" class="signup-label">User name</label>
                  <input type="text" name="email" class="signup-input" required placeholder="enter your username">
                  <label for="password" class="signup-label">Password</label>
                  <input type="password" name="password" class="signup-input" required placeholder="enter your password">
                  <input type="submit" name="login" class="signup-submit"></input>
              </form>
              <p class="signup-already">
                  <span>Bạn chưa có tài khoản ?</span>
                  <a href="<?php echo URL?>/users/register" class="signup-login-link">Đăng ký</a>
              </p>
          </div>
      </div>
  </div>

<link rel="stylesheet" href="<?php echo URL ?>/css/login.css">
<div class="login_form">


                <?php 
                

                //new Session();
                
                Session::danger("danger");
                Session::success("success");
            
            
                echo isset($errNotVerified) ?  '<div class="text-danger">'.$errNotVerified.'</div>' : ''
                 ?>
                
                <?php if(!Session::existed('user_id')) {?>    
                
                        <div class="">
                            <h2 class='text-muted text-center'>Login To Your Account</h2>
                        </div>
                        <div class="">
                            <form action="<?php echo URL?>/users/login" method="POST">
    
                            <div class="">
                                    <input type="text" name="email" placeholder="Email" class="form-control <?php echo  isset($errEmail) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($errEmail) ?  '<div class="invalid-feedback">'.$errEmail.'</div>' : '' ?>
                                </div>
                                <div class="">
                                    <input type="password" name="password" placeholder="Password" class="form-control <?php echo  isset($errPassword) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($errPassword) ?  '<div class="invalid-feedback">'.$errPassword.'</div>' : '' ?>
                                </div>

                                <div><a href="<?php echo URL ?>/users/forgotPassword">Forgot Password?</a></div>
                                
                                <div class="">
                                    <input type="submit" name='login' value='Login' id="btn">
                                </div>
                            </form>
                        </div>
                <?php }
                else if (!isset ($_SESSION['email'])){
                    Redirect::to('users/profile');
                }?>
                </div>

            <style>
     .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
     }
 </style>
</div>

