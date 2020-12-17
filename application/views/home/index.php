
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
                    <li>
                        <a href="#"><span>Samsung</span></a>
                    </li>
                    <li>
                        <a href="#"><span>Iphone</span></a>
                    </li>
                    <li>
                        <a href="#"><span>Oppo</span></a>
                    </li>
                    <li>
                        <a href="#"><span>Nokia</span></a>
                    </li>
                </ul>
            </div>
            <!-- bên phải -->
            <div class="products">
                <div class="products-list">
                    <?php
                    if($products){
                        foreach ($products as $pro){
                        ?>
                    <div class="product">
                        <div class="product-view">
                            <div class="product-img">
                                <a href="<?php echo URL ?>/home/details/<?php echo $pro->product_id ?>"><img id="img-product" src="<?php echo URL ?>/uploads/<?php echo $pro->image ?>" alt=""></a>
                            </div>
                            <div class="product-info">
                                <div id="name-product">Samsung Note 9</div>
                                <div id="price-product">600.000</div>
                                <div id="btn-add-to-cart"><button>Add to cart</button></div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        }
                    }?>
                </div>
            </div>
        </div>
    </div>
