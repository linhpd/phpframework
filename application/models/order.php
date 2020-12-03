<?php

class Order extends Model {

    public function getAllOrder($status = '') {
        if ($status == '') {
            $sql = "";
        } else {
            $sql = "WHERE c_order.status=$status";
        }

        $this->query("SELECT c_order.*, users.full_name as
            creator, payment.payment_method as method FROM c_order 
            INNER JOIN users ON c_order.customer_id = users.user_id
            INNER JOIN payment ON c_order.payment_id = 
            payment.payment_id
             $sql");
        $orders = $this->resultSet();
        if ($orders) {
            return $orders;
        } else {
            return false;
        }
    }

    public function addToShipping($name, $email, $mobile, $address, $city) {
        $this->query("INSERT INTO shipping 
            (full_name,email,mobile,address,city)
            VALUES(:full_name,:email,:mobile,:address,:city)");
        $this->bind(':full_name', $name);
        $this->bind(':email', $email);
        $this->bind(':mobile', $mobile);
        $this->bind(':address', $address);
        $this->bind(':city', $city);
        return $this->insertById();
    }

    public function addToPayment($method, $shipping) {
        $this->query("INSERT INTO payment 
            (payment_method,payment_status,payment_shipping)
            VALUES(:method,0,:payment_shipping)");
        $this->bind(':method', $method);
        $this->bind(':payment_shipping', $shipping);
        return $this->insertById();
    }

    public function addToOrder($customer, $shipping, $payment, $total) {
        $this->query("INSERT INTO c_order (customer_id,shipping_id,
            payment_id,order_status,order_total)
            VALUES(:customer_id,:shipping_id,
            :payment_id,0,:order_total)");
        $this->bind(':customer_id', $customer);
        $this->bind(':shipping_id', $shipping);
        $this->bind(':payment_id', $payment);
        $this->bind(':order_total', $total);
        return $this->insertById();
    }

    public function addToOrderDetails($order, $product, $product_name,
            $price, $qty, $user) {
        $this->query("INSERT INTO c_order_details
            (order_id,product_id,
            product_name,product_price,product_qty,user)
            VALUES(:order_id,:product_id,
            :product_name,:product_price,:product_qty,:user)");
        $this->bind(':order_id', $order);
        $this->bind(':product_id', $product);
        $this->bind(':product_name', $product_name);
        $this->bind(':product_price', $price);
        $this->bind(':product_qty', $qty);
        $this->bind(':user', $user);
        $this->execute();
    }

    public function show($id) {
        $this->query("SELECT * FROM c_order 
            WHERE order_id=:order_id");
        $this->bind(':order_id', $id);
        return $this->single();
    }

    public function showShipping($id) {
        $this->query("SELECT * FROM shipping 
            WHERE shipping_id=:shipping_id");
        $this->bind(':shipping_id', $id);
        return $this->single();
    }

    public function getAllOrderDetalails($id) {
        $this->query("SELECT * FROM c_order_details 
            WHERE order_id=:order_id");
        $this->bind(':order_id', $id);
        return $this->resultSet();
    }

    public function getUserOrderDetalails($user) {
        $this->query("SELECT * FROM c_order_details 
            WHERE user=:user");
        $this->bind(':user', $user);
        return $this->resultSet();
    }

    public function delete($id) {
        $this->query("DELETE FROM shipping 
            WHERE shipping_id=:shipping_id");
        $this->bind(':shipping_id', $id);
        $this->execute();
    }

    public function activate($id) {
        $this->query("UPDATE c_order SET order_status  = 1 WHERE order_id=:id");
        $this->bind(':id', $id);
        return $this->execute();
    }

    public function inActivate($id) {
        $this->query("UPDATE c_order SET order_status  = 0 WHERE order_id=:id");
        $this->bind(':id', $id);
        return $this->execute();
    }

}
