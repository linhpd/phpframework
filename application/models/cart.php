<?php

class Cart extends Model {

    //private $db;
//        public function __construct(){
//            $this = new Database();
//        }

    public $orderModel;
    public function __construct() {
        parent::__construct();
        $this->orderModel= $this->model('Order');
    }

    public function getAllCart() {

        $this->query("SELECT cart.*,products.name as pro_name,products.image as pro_image ,
            products.price as price FROM cart 
            INNER JOIN users ON cart.user = users.user_id
            INNER JOIN products ON cart.product= products.product_id
            WHERE cart.user = :user");
        $this->bind(':user', Session::name('user_id'));
        $carts = $this->resultSet();
        if ($carts) {
            return $carts;
        } else {
            return false;
        }
    }

    public function addOne($pro_id) {
        $this->query("UPDATE cart SET qty=qty + 1
            WHERE product = :pro_id AND user = :user");
        $this->bind(':pro_id', $pro_id);
        $this->bind(':user', Session::name('user_id'));
        $this->execute();
    }

    public function addnew($pro_id, $user_id, $price) {
        $this->query("INSERT INTO 
            cart (product,user,qty,price)
            VALUES (:product,:user_id,1,:price)");
        $this->bind(':product', $pro_id);
        $this->bind(':user_id', $user_id);
        $this->bind(':price', $price);
        $this->execute();
    }

    public function updateQty($id, $qty) {
        $this->query("UPDATE cart SET qty=:qty
            WHERE product=:product AND user=:user");
        $this->bind(':product', $id);
        $this->bind(':qty', $qty);
        $this->bind(':user', Session::name('user_id'));
        $this->execute();
    }

    public function findCartPro($pro_id, $user_id) {
        $this->query("SELECT * FROM cart 
            WHERE product =:product_id AND user=:user");
        $this->bind(':user', $user_id);
        $this->bind(':product_id', $pro_id);
        $this->execute();
        return $this->rowCount();
    }

    public function delete($id) {
        $this->query("DELETE FROM cart WHERE cart_id=:id");
        $this->bind(':id', $id);
        return $this->execute();
    }

    public function clear() {
        $this->query("DELETE FROM cart WHERE user=:user");
        $this->bind(':user', Session::name('user_id'));
        return $this->execute();
    }

}
