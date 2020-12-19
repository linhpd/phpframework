<!-- nội dung trang xem chi tiết sản phẩm -->
    <div class="content">
        <div class="container-product">
            <div class="left">
                <div class="product-img">
                    <img id="img-product" src="<?php echo URL ?>/public/uploads/<?php echo $image ?>">

                </div>
            </div>
            <div class="right">
                <div class="product-detail">
                    <h3>Tên sản phẩm:</h3><span><?php echo $title ?></span>
                </div>
                <div class="product-detail">
                    <h3>Giá sản phẩm:</h3><span><?php echo $price ?></span>
                </div>
                <div class="product-detail">
                    <h3>Chi tiết sản phẩm:</h3>
                    <p>
                       <?php echo $description ?>
                    </p>
                </div>
                <div class="product-detail">
                    <label>Số lượng: </label><input style="width: 44px;" type="number" name="quantity" value="1" min="1">
                </div>
                <div class="product-detail">
                    
                    <div id="btn-add-to-cart" style="justify-content: flex-start;"><button onclick="addProduct('<?php echo URL ?>', '<?php echo $id ?>', '<?php echo $price ?>')">Add to cart</button></div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
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