<!--<link rel="stylesheet" href="<?php echo URL ?>/css/index.css">-->
<div class="index">

    <?php
//if($products)
    {
        for ($i = 0; $i < count($categories); $i++) {
            ?><div class="index-category">
                <h3 class="catagories_header"><a href="<?php echo URL ?>/home/proCategory/<?php echo $categories[$i]->cat_id ?>"> <?php echo $categories[$i]->cat_name ?></a></h3>
                <div class="row">

                    <?php
                    if ($products[$i]) {
                        foreach ($products[$i] as $pro) {
                            ?>
                            <div class="col">
                                <a href="<?php echo URL ?>/home/details/<?php echo $pro->product_id ?>"><img style='height:200px' class="img-fluid" src="<?php echo URL ?>/uploads/<?php echo $pro->image ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <span class="price"><?php echo $pro->price ?>$</span>
                                        <h6 class="card-title"><?php echo $pro->name ?></h6>
                                    </div>

                                </a>
                                <div class="button">
                                    <a href="<?php echo URL ?>/carts/add/<?php echo $pro->product_id ?>/<?php echo $pro->price ?>"  style="font-size:13px">add to cart</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>        
                </div>
            <?php } else {
                ?>
                <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no Products</p>
                        <?php
                    }
                }
            }
            ?>
</div>
</div>
</div>