
<?php //require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php //require_once ROOT ."/views/inc/sidebar.php" ?>
        <div class=" ">
            <div class="row">
                <div>
                
                <div >
                
                        <div >
                            <h5 >Edit Product</h5>
                        </div>
                        <div class="card-body">
                            <form enctype='multipart/form-data' action="<?php echo URL?>/products/update/<?php echo $product->product_id ?>" method="POST">
                                <input type="hidden" name="oldImg" value='<?php echo $product->image?>'>
                                <div class="form-group">
                                    <input value='<?php echo $product->name?>' type="text" name="name" placeholder="Enter product name" class="form-control <?php echo  isset($errName) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($errName) ?  '<>'.$errName.'</div>' : '' ?>
                                </div>
                                <div class="form-group">
                                    <input value='<?php echo $product->color?>' type="text" name="color" placeholder="Enter color name" class="form-control <?php echo  isset($errColor) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($errColor) ?  '<>'.$errColor.'</div>' : '' ?>
                                </div>
                                <div class="form-group">
                                    <input value='<?php echo $product->size?>' type="text" name="size" placeholder="Enter size name" class="form-control <?php echo  isset($errSize) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($errSize) ?  '<>'.$errSize.'</div>' : '' ?>
                                </div>
                                <div class="form-group">
                                    <input value='<?php echo $product->price?>' type="text" name="price" placeholder="Enter product price" class="form-control <?php echo  isset($errPrice) ?  'is-invalid' : '' ?>">
                                    <?php echo  isset($errPrice) ?  '<>'.$errPrice.'</div>' : '' ?>
                                </div>

                                <div >
                                    <div class="custom-file">
                                        <input name='image' type="file" class="custom-file-input <?php echo  isset($errImg) ?  'is-invalid' : '' ?>" >
                                        <label>Choose image</label>
                                    </div>
                                </div>
                                <small><?php echo  isset($errImg) ?  '<div class="text-danger">'.$errImg.'</div>' : '' ?></small>
                                <div class="input-group mb-3">
                                    
                                    <select class="custom-select <?php echo  isset($errCat) ?  'is-invalid' : '' ?>"  name='cat'>
                                        <option value ='Choose...'>Choose...</option>
                                    <?php
                                            foreach ($cat as $cat) { ?>
                                               <option  value="<?php echo $cat->cat_id?>"
                                               <?php echo $cat->cat_id==$product->cat ? 'selected':''?>>
                                                    <?php echo $cat->cat_name?>
                                                </option>
                                           <?php }
                                        ?>
                                    </select>
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Category</label>
                                    </div>
                                    <?php echo  isset($errCat) ?  '<div class="invalid-feedback">'.$errCat.'</div>' : '' ?>
                                </div>

                                <div class="input-group mb-3">
                                    
                                    <select class="custom-select <?php echo  isset($errMan) ?  'is-invalid' : '' ?>" id="inputGroupSelect01" name='man'>
                                        <option value ='Choose...' >Choose...</option>
                                    <?php 
                                            foreach ($man as $man) { ?>
                                               <option  value="<?php echo $man->man_id?>" 
                                               <?php echo $man->man_id==$product->man ? 'selected':''?>
                                                >
                                                    <?php echo $man->man_name?>
                                                </option>
                                           <?php }
                                        ?>
                                    </select>
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Brand</label>
                                    </div>
                                    <?php echo  isset($errMan) ?  '<div class="invalid-feedback">'.$errMan.'</div>' : '' ?>
                                </div>

                                <div class="from-group mb-2">
                                    <textarea 
                                        name="description" 
                                        placeholder="Enter product description" 
                                        class="form-control <?php echo  isset($errDes) ?  'is-invalid' : '' ?>"
                                    ><?php echo $product->description?></textarea>
                                    <?php echo  isset($errDes) ?  '<div class="invalid-feedback">'.$errDes.'</div>' : '' ?>
                                </div>
                                <input value='<?php echo $product->product_id?>'  name="product_id">
                                <div class="form-group">
                                <input  name="csrf" value="<?php ///new Csrf(); //echo Csrf::get()?>">
                                    <a href='<?php echo URL ?>/products'>
                                        <i ></i>
                                        Go Back
                                    </a>
                                    <input type="submit" name='editProduct' value='Edit'>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php //require_once ROOT ."/views/inc/adminFooter.php" ?>