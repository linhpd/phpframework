
<div class="content">
    <div class="container-cart" id="content">
        <?php
        Auth::userGuest();
        if ($cart) {
            ?>
            <table class="cart-detail">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    $qty = 0;
                    foreach ($cart as $cart) {
                        ?>
                        <tr>
                            <td>
                                <div class="product-img">
                                    <img id="img-product" src="<?php echo URL ?>/uploads/<?php echo $cart->pro_image ?>">
                                </div>
                            </td>
                            <td><?php echo $cart->pro_name ?></td>
                            <td><?php echo $cart->price ?></td>
                            <td>
                                <input style="width: 44px;" type="number" name="quantity" value="<?php echo $cart->qty?>" min="1" onchange="updateQuantity('<?php echo URL?>','<?php echo $cart->id?>' ,this.value)"></td>
                            <td>
                                <!--<form class='d-inline' >-->
                                    <!--<input type="hidden" name="csrf" value="<?php new Csrf(); echo Csrf::get() ?>">-->
                                    <button class='btn-delete' onclick="deletePro('<?php echo URL ?>', '<?php echo $cart->cart_id ?>')"><img src="../../public/img/delete.png"></button>
                                <!--</form>-->
                            </td>
                        </tr>
                        <?php
                            $total = $total + ($cart->qty * $cart->price);
                            $qty = $qty + ($cart->qty);
                        }?>
                </tbody>
            </table>
            <div class="checkout">
                <label>Tổng tiền hàng: </label>
                <span id="cost">
                <?php echo number_format($total, 2 , '.', '');
                ?>
                </span>
                <button id="btn-checkout">Thanh toán</button>
            </div>
<?php } ?>

    </div>
</div>
<script>
    function deletePro(url, id) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("content").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", url + "/carts/delete/" + id, true);
        xhttp.send();
    }
</script>
