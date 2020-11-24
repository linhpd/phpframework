<?php// "../views/inc/adminHeader.php" ?>
<?php// "../views/inc/sidebar.php" ?>
        <div class=" ">
            <div class="row">
                <div >
                
                <div >
                
                        <div >
                            <h5 >Add New Product</h5>
                        </div>
                        <div >
                            <form  action="<?php echo URL?>/products/add" method="POST" enctype="multipart/form-data">
    
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Enter product name" class="form-control <?php echo  isset( $errName) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($errName) ?  '<div >'.$errName.'</div>' : '' ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="color" placeholder="Enter color name" class="form-control <?php echo  isset( $errColor) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($errColor) ?  '<div >'.$errColor.'</div>' : '' ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="size" placeholder="Enter size name" class="form-control <?php echo  isset( $errSize) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($errSize) ?  '<div >'.$errSize.'</div>' : '' ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="price" placeholder="Enter product price" class="form-control <?php echo  isset( $errPrice) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($errPrice) ?  '<div class="invalid-feedback">'. $errPrice.'</div>' : '' ?>
                                </div>
                                <div">
                                    <div class="custom-file">
                                        <input name='image' type="file">
                                        <label  for="inputGroupFile01">Choose image</label>
                                    </div>
                                </div>
                                <small><?php echo  isset($errImg) ?  '<div class="text-danger">'. $errImg.'</div>' : '' ?></small>
                                <div >
                                    
                                    <select class="custom-select <?php echo  isset( $errCat) ?  'is-invalid' : '' ?>"  name='cat'>
                                        <option selected>Choose...</option>
                                    <?php 
                                            foreach ( $cat as $cat) { ?>
                                               <option  value="<?php echo $cat->cat_id?>">
                                                    <?php echo $cat->cat_name?>
                                                </option>
                                           <?php }
                                        ?>
                                    </select>
                                    <div >
                                        <label  for="inputGroupSelect01">Category</label>
                                    </div>
                                    <?php echo  isset( $errCat) ?  '<div >'. $errCat.'</div>' : '' ?>
                                </div>

                                <div>
                                    
                                    <select class="custom-select <?php echo  isset( $errMan) ?  'is-invalid' : '' ?>"name='man'>
                                        <option selected>Choose...</option>
                                    <?php 
                                            foreach ( $man as $man) { ?>
                                               <option  value="<?php echo $man->man_id?>">
                                                    <?php echo $man->man_name?>
                                                </option>
                                           <?php }
                                        ?>
                                    </select>
                                    <div >
                                        <label  for="inputGroupSelect01">Brand</label>
                                    </div>
                                    <?php echo  isset( $errMan) ?  '<div >'. $errMan.'</div>' : '' ?>
                                </div>

                                <div >
                                    <textarea 
                                        name="description" 
                                        placeholder="Enter product description" 
                                        class="form-control <?php echo  isset( $errDes) ?  'is-invalid' : '' ?>"
                                    ></textarea>
                                    <?php echo  isset( $errDes) ?  '<di>'. $errDes.'</div>' : '' ?>
                                </div>
                                <div class="form-group">
                                <input  name="csrf" value="<?php //new Csrf();// echo Csrf::get()?>">
                                <a href='<?php echo URL ?>/products' >
                                    <i ></i>
                                    Go Back
                                </a>
                                    <input type="submit" name='addProduct' value='Add'>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php //require_once ROOT ."/application/views/inc/adminFooter.php" ?>