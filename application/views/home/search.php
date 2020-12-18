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
                        <li><a href="<?php echo URL ?>/home/proCategory/<?php echo $cat->cat_id ?>"><span><?php echo $cat->cat_name ?></span></a></li>
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