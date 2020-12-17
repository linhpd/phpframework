
<?php //require_once ROOT ."/views/inc/header.php"       ?>
<div class="product">
    <h5 class="text-center"><?php echo $product->name ?></h5>
    <div class="card">
        <div class="card-header">
            <div class="title">
                <h6><?php echo $product->name ?></h6>
            </div>
            <div class="button">
                <a href="<?php echo URL ?>/carts/add/<?php echo $product->product_id ?>/<?php echo $product->price ?>"  style="font-size:13px">Add To Cart</a>
            </div>
        </div>
        <div class="card-body">
            <div class="detail-row">
                <div class="img-col">
                    <img src="<?php echo URL ?>/uploads/<?php echo $product->image ?>" alt="" class="img-fluid">
                </div>
                <div class="detail-col">
                    <ul class="list-unstyled">
                        <li class='my-2'>
                            <strong>Product: </strong> <?php echo $product->name ?>
                        </li>
                        <li class='my-2'>
                            <strong>Price: </strong><span class="badge badge-info"> <?php echo $product->price ?>$</span>
                        </li>

                        <li class='my-2'>
                            <strong>Size: </strong> <?php echo $product->size ?>
                        </li>
                        <strong>Brand: </strong> <?php echo $product->man_name ?>
                        </li>
                        <li class='my-2'>
                            <strong>Category: </strong> <?php echo $product->cat_name ?>
                        </li>
                        <li>
                            <strong>Description:</strong> <?php echo $product->description ?>
                        </li>
                    </ul>
                    <strong> Gallary</strong>
                    <?php if (count($gallary) > 0) { ?>

                        <?php foreach ($gallary as $image) { ?>
                            <span>
                                <a href="<?php echo URL ?>/uploads/<?php echo $image->product_id ?>/<?php echo $image->image_name ?>" data-fancybox="gallery" data-caption="<?php echo $image->image_name ?>">
                                    <img class='img-fluid' style='width:80px;height:80px' src="<?php echo URL ?>/uploads/<?php echo $image->product_id ?>/<?php echo $image->image_name ?>" alt="" />
                                </a>
                            </span>
                            <?php
                        }
                    } else {
                        ?>
                        <span class="text-danger">No gallary for this product</span>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>
</div>

<div class="comment">
    <div class="card">

        <form action="#" method="POST">
            <div class="input-form">
                <div class="">
                    <h2 class="text-muted text-center">Comment</h2>
                </div>
                <div>
                    <input class="input-text" type="text" name="name" placeholder="name">
                </div>                            
                <div>         
                    <input class="input-text" type="text" name="Comment" placeholder="comment">
                </div>                                 

                <!--<a href="<?php echo URL ?>/users/forgotPassword">Forgot Password?</a>-->


                <input type="submit" name="addComment" value="Add" id="btn">




            </div>
        </form>
    </div>
</div>
<?php
//require_once ROOT ."/views/inc/footer.php" ?>