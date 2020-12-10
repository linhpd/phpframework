<link rel="stylesheet" href="<?php echo URL ?>/css/index.css">
<div class="index">
        <!-- <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3">
                <h5>Categories</h5>
                <ul class="list-unstyled">
                <?php 
                if($categories){

                    foreach ($categories as $cat) {?>
                        <li><a href="<?php echo URL ?>/home/proCategory/<?php echo $cat->cat_id ?>"><?php echo $cat->cat_name ?></a></li>
                    <?php }
                }else {?>
                        <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no categories</p>
                        <?php  }
                    ?>
                </ul>

                <h5>Brands</h5>
                <ul class="list-unstyled">
                <?php 
                if($manufactures){

                    foreach ($manufactures as $man) {?>
                        <li><a href="<?php echo URL ?>/home/proManufacture/<?php echo $man->man_id ?>"><?php echo $man->man_name ?></a></li>
                    <?php }
                }else{?>
                    <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no Brands</p>
                    <?php  }
                ?>
                </ul>
                <hr class='bg-dark'>
            </div> -->
            <div class="row">
            <?php 
            if($products){    
                foreach ($products as $pro) {?>
                            <div class="col">
                                <a href="<?php echo URL ?>/home/details/<?php echo $pro->product_id ?>"><img style='height:200px' class="img-fluid" src="<?php echo URL ?>/uploads/<?php echo $pro->image ?>" alt="Card image cap"></a>
                                <div class="card-body">
                                    <span class=""><?php echo $pro->price?>$</span>
                                    <h6 class="card-title"><?php echo $pro->name ?></h6>
                                    <a href="<?php echo URL ?>/home/details/<?php echo $pro->product_id ?>" class="btn btn-info btn-sm py-1 float-left" style="font-size:13px">Details</a>
                                    <!-- <a href="<?php echo URL ?>/carts/add/<?php echo $pro->product_id ?>/<?php echo $pro->price ?>" class="btn btn-danger btn-sm py-1 float-right" style="font-size:13px"><i class="fa fa-shopping-cart"></i></a> -->
                                </div>
                            </div>
                        <?php } ?>
            </div>        
                    <!-- <div class="row">
                        <h2>Máy tính bộ</h2>
                        <div class="col"><a href="#"><img src="../img/pc-apple.jpg" alt=""></a></div>
                        <div class="col"><a href="#"><img src="../img/pc-apple.jpg" alt=""></a></div>
                        <div class="col"><a href="#"><img src="../img/pc-apple.jpg" alt=""></a></div>
                        <div class="col"><a href="#"><img src="../img/pc-apple.jpg" alt=""></a></div>
                    </div> -->

            <?php }else {?>
                <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no Products</p>
                <?php  }
            ?>
        </div>
    </div>