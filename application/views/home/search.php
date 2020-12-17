
<div class=" my-4 mx-auto">
    <h3 class='text-center my-4'>Our Prouducts</h3>
    <form action="<?php echo URL ?>/home/search" method='POST' class='d-md-none w-50 mx-auto'>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <button class="input-group-text"><i class="fa fa-search"></i></button>
            </div>
            <input type="text" name='search' class="form-control" placeholder='Search'>
        </div>
    </form>
    <?php require_once ROOTDIR . "/application/views/inc/slider.php" ?>

    <div class="row">
        <div class="span3">

            <h5>Categories</h5>
            <ul class="list-unstyled">
                <?php
                if ($categories) {

                    foreach ($categories as $cat) {
                        ?>
                        <li><a href="<?php echo URL ?>/home/proCategory/<?php echo $cat->cat_id ?>"><?php echo $cat->cat_name ?></a></li>
                        <?php
                    }
                } else {
                    ?>
                    <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no categories</p>
                <?php }
                ?>
            </ul>

            <h5>Brands</h5>
            <ul class="list-unstyled">
                <?php
                if ($manufactures) {

                    foreach ($manufactures as $man) {
                        ?>
                        <li><a href="<?php echo URL ?>/home/proManufacture/<?php echo $man->man_id ?>"><?php echo $man->man_name ?></a></li>
                        <?php
                    }
                } else {
                    ?>
                    <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no Brands</p>
                <?php }
                ?>
            </ul>
            <hr class='bg-dark'>
        </div>
        <div class="span9">
            <div class="well well-small">
                <?php
                if ($products) {

                    for ($i = 0; $i < count($products); $i++) {
                        if ($i % 3 == 0) {
                            ?>

                            <div class="row-fluid">
                                <ul class="thumbnails">
                                <?php }
                                ?>
                                <li class="span4">
                                    <div class="thumbnail">
                                        <a class="overlay" href="<?php echo URL ?>/home/details/<?php echo $products[$i]->product_id ?>"></a>
                                        <a href="<?php echo URL ?>/home/details/<?php echo $products[$i]->product_id ?>">
                                            <img src="<?php echo URL ?>/uploads/<?php echo $products[$i]->image ?>" alt="">
                                        </a>
                                        <div class="caption cntr">
                                            <p>Manicure &amp; Pedicure</p>
                                            <p><strong> <?php echo $products[$i]->price ?></strong></p>
                                            <h4><a class="shopBtn" href="<?php echo URL ?>/carts/add/<?php echo $products[$i]->product_id ?>/<?php echo $products[$i]->price ?>" title="add to cart"> Add to cart </a></h4>
                                            
                                            <br class="clr">
                                        </div>
                                    </div>
                                </li>
                                <?php
                                if ($i % 3 == 2) {
                                    ?>
                                </ul>
                            </div>
                            <?php
                        }
                    }
                    foreach ($products as $pro) {
                        ?>
                        <!--                    <div class="col-lg-3 col-md-4 col-sm-4 my-2">
                                                <div class="card position-relative" >
                                                    <span class="badge badge-success position-absolute p-1 "><?php echo $pro->price ?>$</span>
                                                    <img style='height:200px' class="img-fluid" src="<?php echo URL ?>/uploads/<?php echo $pro->image ?>" alt="Card image cap">
                                                    <div class="card-body">
                                                        <h6 class="card-title"><?php echo $pro->name ?></h6>
                                                        <a href="<?php echo URL ?>/home/details/<?php echo $pro->product_id ?>" class="btn btn-info btn-sm py-1 float-left" style="font-size:13px">Details</a>
                                                        <a href="<?php echo URL ?>/carts/add/<?php echo $pro->product_id ?>/<?php echo $pro->price ?>" class="btn btn-danger btn-sm py-1 float-right" style="font-size:13px"><i class="fa fa-shopping-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>-->
                        <?php
                    }
                } else {
                    ?>
                    <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no Products</p>
                            <?php
                        }
                        ?>
            </div>
        </div>
    </div>
</div>
</div>