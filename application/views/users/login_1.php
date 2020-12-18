
<?php //require_once ROOT ."/views/inc/header.php" ?>
<div class=" ">
            <div class="row">
                <div class="col-8  m-auto">
                <?php 
                

                //new Session();
                
                Session::danger("danger");
                Session::success("success");
            
            
                echo isset($errNotVerified) ?  '<div class="text-danger">'.$errNotVerified.'</div>' : ''
                 ?>
                
                <?php if(!Session::existed('user_id')) {?>    
                     <div class="card my-4">
                
                        <div class="card-header">
                            <h5 class='text-muted text-center'>Login To Your Account</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo URL?>/users/login" method="POST">
    
                            <div class="form-group">
                                    <input type="text" name="email" placeholder="Email" class="form-control <?php echo  isset($errEmail) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($errEmail) ?  '<div class="invalid-feedback">'.$errEmail.'</div>' : '' ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" placeholder="Password" class="form-control <?php echo  isset($errPassword) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($errPassword) ?  '<div class="invalid-feedback">'.$errPassword.'</div>' : '' ?>
                                </div>

                                <div><a href="<?php echo URL ?>/users/forgotPassword">Forgot Password?</a></div>
                                
                                <div class="form-group">
                                    <input type="submit" name='login' value='Login' class="btn btn-success btn-block">
                                </div>
                            </form>
                        </div>
                    </div>
                <?php }
                else if (!isset ($_SESSION['email'])){
                    Redirect::to('users/profile');
                }?>
                </div>
            </div>
        </div>

<?php //require_once ROOT ."/views/inc/footer.php" ?>