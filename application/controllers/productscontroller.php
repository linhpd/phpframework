<?php

class ProductsController extends Controller {

    function view($id = null, $field = ProductID, $name = null) {

        $this->set('title', $name . 'Product');
        $this->set('product', $this->Product->select($id, $field));
    }

    function viewsearch($value = null, $field ='Product_desc',$name = 'Search' ) {
        $value = $_POST['value'];
        $this->set('title', $name . '');
       
        $this->set('product', $this->Product->search($value, $field));
    }

    function viewall() {

        $this->set('title', 'All Products');
        $this->set('product', $this->Product->selectAll());
    }

    function add() {
        $name = $_POST['Product_desc'];
        $cost = $_POST['Cost'];
        $weight = $_POST['Weight'];
        $number = $_POST['Numb'];
        //$_db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $this->set('title', 'Created');
        $this->set('product', $this->Product->query('insert into products (Product_desc, Cost, Weight, Numb) values (?, ?, ?, ?)', array($name, $cost, $weight, $number)));
    }
    
    function update($id = null){
        $name = $_POST['Product_desc'];
        $cost = $_POST['Cost'];
        $weight = $_POST['Weight'];
        $number = $_POST['Numb'];
        //$_db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $this->set('title', 'Update');
        $this->set('product', $this->Product->query('update products set `Product_desc` = ?, `Cost` = ?, `Weight` = ?, `Numb` =? where `ProductID` = ? ', array($name, $cost, $weight, $number, $id)));
        
    }
    function delete($id = null) {
        //$_db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $this->set('title', 'date');
        $this->set('product', $this->Product->query('delete from products where `ProductID` = ?', array($id)));
        
    }

}
