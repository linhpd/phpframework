
<!-- Nội dung trang home index -->
<div class="content">
    <div class="container-flex">
        <!-- bên trái -->
        <div class="catagories">
            <div class="catagories-header">
                <img src="<?php echo URL ?>list.png">
                <span>Tất cả danh mục</span>
            </div>
            <ul class="catagories-list">
                <?php
                if ($categories) {
                    foreach ($categories as $cat) {
                        ?>
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
                        <?php
                    }
                }
                ?>
            </ul>
            <div class="catagories-header">
                <img src="<?php echo URL ?>list.png">
                <span>Hãng</span>
            </div>
            <ul class="catagories-list">
                <?php
                if ($manufactures) {
                    foreach ($manufactures as $man) {
                        ?>
                        <li><a href="<?php echo URL ?>/home/proManufacture/<?php echo $man->man_id ?>"><span><?php echo $man->man_name ?></span></a></li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <!-- bên phải -->
        <div class="products">
            <div class="products-list">
                <?php
                if ($products) {
                    foreach ($products as $pro) {
                        ?>
                        <div class="product">
                            <div class="product-view">
                                <div class="product-img">
                                    <a href="<?php echo URL ?>/home/details/<?php echo $pro->product_id ?>"><img id="img-product" src="<?php echo URL ?>/uploads/<?php echo $pro->image ?>" alt=""></a>
                                </div>
                                <div class="product-info">
                                    <div id="name-product"><?php echo $pro->name ?></div>
                                    <div id="price-product"><?php echo $pro->price ?> Đồng</div>
                                    <div id="btn-add-to-cart" ><button onclick="addProduct('<?php echo URL ?>', '<?php echo $pro->product_id ?>', '<?php echo $pro->price ?>')">Add to cart</button></div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
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
</div>
<script>
    function addProduct(url, id, price) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("card-element").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", url + "/carts/add/" + id + "/" + price, true);
        xhttp.send();
    }
</script>