<?php 

    class HomeController extends Controller {


//        private $categoryModel;
//        private $manufactureModel;
//        private $productModel;

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->  construct <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
//        public function __construct(){
//            //new Session;
//            $this->categoryModel = $this->model('Category');
//            $this->manufactureModel = $this->model('Manufacture');
//            $this->productModel = $this->model('Product');
//        }
       
        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   index    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function index(){
            $this->set('title', 'Home');
            $category = $this->Home->categoryModel->getAllCat(1);
            
            $this->set('categories', $category);
            $this->set('manufactures', $this->Home->manufactureModel->getAllMan(1));
            
            
            for($i = 0; $i < count($category); $i++){
                $product[$i] = $this->Home->productModel->getProByCat($category[$i]->cat_id);
            }
            //$product = $this->Home->productModel->getAllPro();
            $this->set('products', $product);
            //var_dump($product);
            
        }



        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> search <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function search(){
            $this->set('title', 'Products');
            $searched = $_POST['search'];
            $this->set('categories', $this->Home->categoryModel->getAllCat(1));
            $this->set('manufactures', $this->Home->manufactureModel->getAllMan(1));
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $results = $this->Home->productModel->search($searched);
                $this->set('products', $results);
                //$this->view('front.index', $data);
            }else {
                Redirect::to('home/index');
            }
            
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->  By Categ  <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function proCategory($cat_id){
            $this->set('categories', $this->Home->categoryModel->getAllCat(1));
            $this->set('manufactures', $this->Home->manufactureModel->getAllMan(1));
            $category = $this->Home->categoryModel->show($cat_id);
            $this->set('products', $this->Home->productModel->getProByCat($cat_id));
            
            $this->set('title', $category->cat_name);

            if($category && is_numeric($cat_id)){
                //$this->view('front.ProCategory', $data);
            }else {
                Session::set('danger', 'this item not exist');
                Redirect::to('home/index');
            }
        }

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->  By Categ  <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function proManufacture($man_id){
            $this->set('categories', $this->Home->categoryModel->getAllCat(1));
            $this->set('manufactures', $this->Home->manufactureModel->getAllMan(1));
            $manufacture = $this->Home->manufactureModel->show($man_id);
            $this->set('products', $this->Home->productModel->getProByMan($man_id));
            
            $this->set('title', $manufacture->man_name);

            if($manufacture && is_numeric($man_id)){
               // $this->view('front.ProManufacture', $data);
            }else {
                Session::set('danger', 'this item not exist');
                Redirect::to('home/index');
            }
            //$this->view('front.ProManufacture', $data);
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   show    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function details($id){
            $this->set('product', $this->Home->productModel->show($id));
            $product= $this->Home->productModel->show($id);
            $this->set('title', $product->name);
            $this->set('gallary', $this->Home->productModel->getGallary($id));
            if($product && is_numeric($id)){
               // $this->view('front.details', $data);
            }else {
                Session::set('danger', 'this item not exist');
                Redirect::to('home/index');
            }
            
        }

    }