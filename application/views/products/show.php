
<?php //require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php require_once ROOTDIR ."/application/views/inc/sidebar.php" ?>
    <div class="   mt-4">
        <h5 class="text-center"><?php echo $product->name ?></h5>
        <div class="card">
            <div class="card-header">
                <h6><?php echo $product->name ?></h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <img src="<?php echo URL ?>/uploads/<?php echo $product->image ?>" alt="" class="img-fluid">
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <ul class="list-unstyled">
                            <li class='my-2'>
                                <strong><i class="fa fa-product-hunt"></i> Product: </strong> <?php echo $product->name ?>
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-money"></i> Price: </strong><span class="badge badge-info"> <?php echo $product->price ?>$</span>
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-id-card"></i> ID: </strong> <?php echo $product->product_id ?>
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-heart"></i> Color: </strong> <?php echo $product->color ?>
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-black-tie"></i> Size: </strong> <?php echo $product->size ?>
                            </li>
                            <li class='my-2'>
                            <li class='my-2'>
                                <strong><i class="fa fa-suitcase"></i> Brand: </strong> <?php echo $product->man_name?>
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-tag"></i> Category: </strong> <?php echo $product->cat_name?>
                            </li>
                                <strong><i class="fa fa-list-alt"></i> Description: </strong> <?php echo $product->description ?>
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-lock"></i> Status: </strong> <?php echo $product->active == 0? '<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">InActive</span>'?>
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-user"></i> Creator: </strong> <?php echo $product->creator ?>
                            </li>
                            <li class='my-2'>
                                <strong><i class="fa fa-calendar"></i> Date: </strong> <?php echo $product->created_at ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <h5 class='text-center mt-4'>Product Gallary</h5>
        <?php 
         if(count($gallary) > 0){?>
            <div>
                <a href="<?php echo URL ?>/products/deleteGallary/<?php echo $product->product_id?>" class=" delete btn btn-sm btn-danger">Delete Gallary</a>
            </div>
         <?php }
        ?>
        <div class='row text-center'>
        <?php 
            if(count($gallary) > 0){?>
            <?php 
                foreach ($gallary as $image) {?>
                <div class='col-sm-6 col-md-3 my-4'>
                    <a href="<?php echo URL ?>/uploads/<?php echo $image->product_id ?>/<?php echo $image->image_name ?>" data-fancybox="gallery" data-caption="<?php echo $image->image_name ?>">
                        <img class='img-fluid' style='height:200px' src="<?php echo URL ?>/uploads/<?php echo $image->product_id ?>/<?php echo $image->image_name ?>" alt="" />
                    </a>
                    <div>
                    <a href="<?php echo URL ?>/products/deleteGallaryImage/<?php echo $image->gallary_id?>/<?php echo $image->product_id?>/<?php echo $image->image_name?>" class="delete btn btn-sm btn-danger">Delete</a>
                    </div>
                </div>
            <?php }
            }
         ?>
        </div>
        <form method="POST"
            action="<?php echo URL ?>/products/upload_images/<?php echo $product->product_id ?>" 
            enctype="multipart/form-data"
        >
        <div class="fallback">
            <input type="file" name="file" >
            <input type="submit" value="add" name="addGallary">
        </div>
        </form>
        <a href='<?php echo URL ?>/products/all' class="btn btn-sm btn-secondary mt-2">
            <i class="fa fa-arrow-left"></i>
            Go Back
        </a>
    </div>


<?php //require_once ROOT ."/views/inc/adminFooter.php" ?>