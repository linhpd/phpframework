<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author Inspiron 7559
 */
class Home extends Model {

    //put your code here
    public $categoryModel;
    public $manufactureModel;
    public $productModel;

    public function __construct() {
        parent::__construct();
        $this->categoryModel=$this->model('Category');
        $this->manufactureModel = $this->model('Manufacture');
        $this->productModel = $this->model('Product');
    }

}
