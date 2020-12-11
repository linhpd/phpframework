<?php 

    class CategoriesController extends Controller {
        //private $categoryModel;
//        public function __construct(){
//            new Session;
//            $this->categoryModel = $this->model('Category');
//        }

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   index   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function all(){
            Auth::adminAuth();
            $this->set('title' , 'All Categories');
            $this->set('categories', $this->Category->getAllCat());
            //$this->view('categories.all', $data);
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   show    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function show($id){
            Auth::adminAuth();
            $this->set('category', $category);
            $category = $this->Category->show($id);
            $this->set('title', $category->cat_name);


            if($category && is_numeric($id)){
                //$this->view('categories.show', $data);
            }else {
                //Session::set('danger', 'This id not found');
                //Redirect::to('categories');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->    add     <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function add(){
        
            Auth::adminAuth();
            Csrf::CsrfToken();
            $this->set('title','Add Catrgory');
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['addCategory']){
                $cat_name = $_POST['category'];
                $cat_user = Session::name('admin_id');
                $description = $_POST['description'];

                if (strlen($cat_name) < 3) {
                    $error['errCat'] = 'Category name must not be less than 3 characters';
                    $this->set('errCat', 'Category name must not be less than 3 characters');
                }elseif($this->Category->findCatName($cat_name) > 0) {
                    $error['errCat'] = 'This name already exist choose anthor one';
                    $this->set('errCat', 'This name already exist choose anthor one');
                }
                if (strlen($description) < 5) {
                    $error['errDes'] = 'Category description must not be less than 5 characters';
                    $this->set('errDes', 'Category description must not be less than 5 characters');
                }

                if(empty($error['errCat']) && empty($error['errDes']))
                {
                    $this->Category->add($cat_name,$cat_user,$description);
                    Session::set('success', 'New category added successfully');
                    Redirect::to('categories/all');
                }else 
                {
                    //echo var_dump($error);
                    //$this->view('categories.add', $data);
                }
            }else {
                //$this->view('categories.add', $data);
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   edit    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function edit($id){
            Auth::adminAuth();
            $this->set('title' , 'Edit Category');
            $category = $this->Category->show($id);
            $this->set('category' ,$this->Category->show($id));
            if($category && is_numeric($id)){
                //$this->view('categories.edit', $data);
            }else {
                Session::set('danger', 'This id not found');
                Redirect::to('categories/all');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   update   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function update($id){
            Auth::adminAuth();
            Csrf::CsrfToken();
            $this->set('title', 'Edit Category');
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['editCategory']){
                $cat_name = $_POST['category'];
                $cat_id = $_POST['cat_id'];
                $description = $_POST['description'];
                $cat_user = Session::name('admin_id');

                
                if (strlen($cat_name) < 3) {
                    $error['errCat'] = 'Category name must not be less than 3 characters';
                    $this->set('errCat', 'Category name must not be less than 3 characters');
                }elseif($this->Category->findCatName($cat_name,$cat_id) > 0) {
                    $error['errCat'] = 'This name already exist choose anthor one';
                    $this->set('errCat', 'This name already exist choose anthor one');
                }

                if (strlen($description) < 5) {
                    $error['errDes'] = 'Category description must not be less than 5 characters';
                    $this->set('errDes', 'Category description must not be less than 5 characters');
                }

                if(empty($error['errCat']) && empty($error['errDes'])){
                    $this->Category->update($id, $cat_name,$description);
                    Session::set('success', 'Category has been edited successfully');
                    Redirect::to('categories/all');
                }else {
                    $this->set('category', $this->Category->show($id));
                    Redirect::to('categories/edit/'.$id);
                }

            }else {
                //Redirect::to('categories');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->  activate  <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function activate($id){
            Auth::adminAuth();
            $activate =  $this->Category->activate($id);
            Session::set('success', 'Item has been activated');
            if($activate){
                Redirect::to('categories/all');
            }
        }

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> inactivate <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function inActivate($id){
            Auth::adminAuth();
            $inActivate =  $this->Category->inActivate($id);
            if($inActivate){
                Session::set('success', 'Item has been inActivated');
                Redirect::to('categories/all');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> search <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function search(){
            Auth::adminAuth();
            $this->set('title', 'All Categories');
            $searched = $_POST['search'];
            $results = $this->Category->search($searched);
            $this->set('categories', $results);
            //$this->view('categories.search', $data);
            
        }

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   delete   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function delete($id){
            Auth::adminAuth();
            Csrf::CsrfToken();
            Session::set('success', 'Item has been deleted');
            $delete =  $this->Category->delete($id);
            if($delete){
                Redirect::to('categories/all');
            }
        }

    }