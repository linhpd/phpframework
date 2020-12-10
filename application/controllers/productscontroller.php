<?php

class ProductsController extends Controller {

    
    public $error;

//        public function __construct(){
//           // new Session;
//            $this->productModel = $this->model('Product');
//            $this->categoryModel = $this->model('Category');
//            $this->manufactureModel = $this->model('Manufacture');
//        }

    /* >>>>>>>>>>>>>>>>>>>> */
    #<--->   index   <--->#
    /* <<<<<<<<<<<<<<<<<<<< */
    public function all() {
        //echo $this->_model;
        //$this->productModel = $this->model('Product');
        //Auth::adminAuth();
        $this->set('title', 'All Products');
        // $data['title'] = 'All Products';
        //$data['products'] = $this->productModel->getAllPro();
        $this->set('products', $this->Product->getAllPro());
        //$this->view('products.all', $data);
    }

    /* >>>>>>>>>>>>>>>>>>>> */
    #<--->   show    <--->#
    /* <<<<<<<<<<<<<<<<<<<< */

    public function show($id) {
        Auth::adminAuth();
        $product = $this->Product->show($id);
        $this->set('product', $this->Product->show($id));
        $this->set('title', $product->name);
        $this->set('gallary', $this->Product->getGallary($id));
        if ($product && is_numeric($id)) {
            //$this->view('products.show', $data);
        } else {
            Session::set('danger', 'This id not found');
            Redirect::to('products/all');
        }
    }

    /* >>>>>>>>>>>>>>>>>>>> */
    #<--->    add     <--->#
    /* <<<<<<<<<<<<<<<<<<<< */

    public function add() {

 //       Auth::adminAuth();
   //     Csrf::CsrfToken();
        //$this->categoryModel = $this->model('Category');
        //$this->manufactureModel = $this->model('Manufacture');

        $this->set('title', 'Add Product');
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['addProduct']) {
            $name = $_POST['name'];
            $man = $_POST['man'];
            $cat = $_POST['cat'];
            $price = $_POST['price'];
            $color = $_POST['color'];
            $size = $_POST['size'];
            //$user = Session::name('admin_id');
            $user = 1;
            $description = $_POST['description'];
            //var_dump($_FILES);
            $pro_img = $_FILES['image']['name'];
            $pro_tmp = $_FILES['image']['tmp_name'];
            $pro_type = $_FILES['image']['type'];
            $uploaddir = ROOTDIR . '\public\uploads\\';
            if (!empty($pro_img)) {
                //$uploaddir = ROOTDIR . '\public\uploads\\';
                //echo $uploaddir .'\n';
                $pro_img = explode('.', $pro_img);
                $pro_img_ext = $pro_img[1];
                $pro_img = $pro_img[0] . time() . '.' . $pro_img[1];

                if ($pro_img_ext != "jpg" && $pro_img_ext != "png" && $pro_img_ext != "jpeg" && $pro_img_ext != "gif") {
                    $error['errImg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $this->set('errImg', "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                }
            } else {
                $this->set('errImg', 'You must choose an image');
                $error['errImg'] = 'You must choose an image';
            }


            if (strlen($name) < 3) {
                $error['errName'] = 'product name must not be less than 3 characters';
                $this->set('errName', 'product name must not be less than 3 characters');
            } elseif ($this->Product->findProName($name) > 0) {
                $error['errName'] = 'This name already exist choose anthor one';
                $this->set('errName', 'This name already exist choose anthor one');
            }
            if ($price < 0) {
                $error['errPrice'] = 'product price must not br less than 0';
                $this->set('errPrice', 'product price must not br less than 0');
            }
            if (strlen($description) < 5) {
                $error['errDes'] = 'product description must not be less than 5 characters';
                $this->set('errDes', 'product description must not be less than 5 characters');
            }
            if ($man == "Choose...") {
                $error['errMan'] = 'You must choose brand for this product';
                $this->set('errMan', 'You must choose brand for this product');
            }
            if ($cat == "Choose...") {
                $error['$errCat'] = 'You must choose category for this product';
                $this->set('$errCat', 'You must choose category for this product');
            }


            if (empty($error['errCat']) && empty($error['errDes']) && empty($error['errMan']) && empty($error['errPrice']) && empty($error['errName']) && empty($error['errImg'])) {


                move_uploaded_file($pro_tmp, $uploaddir . $pro_img);

                $this->Product->add($name, $description, $user, $cat, $man, $pro_img, $price, $size, $color);
                Session::set('success', 'New product added successfully');
                Redirect::to('products/all');
            } else {
                $this->set('cat', $this->Product->categoryModel->getAllCat());
                $this->set('man', $this->Product->manufactureModel->getAllMan());
                //$this->view('products.add', $data);
            }
        } else {
            $this->set('cat', $this->Product->categoryModel->getAllCat());
            $this->set('man', $this->Product->manufactureModel->getAllMan());
            //$this->view('products.add',$data);
        }
    }

    /* >>>>>>>>>>>>>>>>>>>> */
    #<--->   edit    <--->#
    /* <<<<<<<<<<<<<<<<<<<< */

    public function edit($id) {
        Auth::adminAuth();
        $this->categoryModel = $this->model('Category');
        $this->manufactureModel = $this->model('Manufacture');
        $data['product'] = 'Edit Product';
        $this->set('product', $this->Product->show($id));
        $this->set('man', $this->Product->manufactureModel->getAllMan());
        $this->set('cat', $this->Product->categoryModel->getAllCat());
//            $data['product'] = $this->productModel->show($id);
//            $data['man'] = $this->manufactureModel->getAllMan();
//            $data['cat'] = $this->categoryModel->getAllCat();

        if ($data['product'] && is_numeric($id)) {
            //$this->view('products.edit', $data);
            $this->set('title', 'Edit Product');
        } else {
            //Session::set('danger', 'This id not found');
            //Redirect::to('products');
        }
    }

    /* >>>>>>>>>>>>>>>>>>>> */
    #<--->   update   <--->#
    /* <<<<<<<<<<<<<<<<<<<< */

    public function update($id) {


        //$this->categoryModel = $this->model('Category');
        //$this->manufactureModel = $this->model('Manufacture');
        $this->set('title', 'Edit Product');
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['editProduct']) {
            $name = $_POST['name'];
            $man = $_POST['man'];
            $cat = $_POST['cat'];
            $price = $_POST['price'];
            $color = $_POST['color'];
            $size = $_POST['size'];
            $id = $_POST['product_id'];
            $user = 4;
            $description = $_POST['description'];
            $oldImg = $_POST['oldImg'];

            $pro_img = $_FILES['image']['name'];
            $pro_tmp = $_FILES['image']['tmp_name'];
            $pro_type = $_FILES['image']['type'];
            $uploaddir = ROOTDIR . '\public\uploads\\';
            if (!empty($pro_img)) {

                //$uploaddir = ROOTDIR . '\public\uploads\\';
                unlink($uploaddir . $oldImg);
                $pro_img = explode('.', $pro_img);
                $pro_img_ext = $pro_img[1];
                $pro_img = $pro_img[0] . time() . '.' . $pro_img[1];

                if ($pro_img_ext != "jpg" && $pro_img_ext != "png" && $pro_img_ext != "jpeg" && $pro_img_ext != "gif") {
                    $data['errImg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                }
            } else {
                $pro_img = $oldImg;
            }

            if (strlen($name) < 3) {
                $this->set('errName', 'product name must not be less than 3 characters');
            } elseif ($this->Product->findProName($name, $id) > 0) {
                $this->set('errName', 'This name already exist choose anthor one');
            }
            if (strlen($description) < 5) {
                $this->set('errDes', 'product description must not be less than 5 characters');
            }
            if ($man == "Choose...") {
                $this->set('errMan', 'You must choose brand for this product');
            }
            if ($cat == "Choose...") {
                $this->set('errCat', 'You must choose category for this product');
            }

            if (empty($price)) {
                $this->set('errPrice', 'Price must has number');
            }



            if (empty($errCat) && empty($errDes) && empty($errMan) && empty($errPrice) && empty($errName)) {

                move_uploaded_file($pro_tmp, $uploaddir . $pro_img);

                $this->Product->update($id, $name, $description, $user, $pro_img, $cat, $man, $price, $size, $color);
                Session::set('success', 'Product edited successfully');
                Redirect::to('products');
            } else {
                $this->set('product', $this->Product->show($id));
                $this->set('cat', $this->Product->categoryModel->getAllCat());
                $this->set('man', $this->Product->manufactureModel->getAllMan());
                //$this->view('products.edit', $data);
                //$redict = new Redirect();
                //$redict->to('edit');
            }
        } else {
            $this->set('product', $this->Product->show($id));
            $this->set('cat', $this->Product->categoryModel->getAllCat());
            $this->set('man', $this->Product->manufactureModel->getAllMan());
            //$this->view('products.edit',$data);
        }
    }

    /* >>>>>>>>>>>>>>>>>>>> */
    #<--->  activate  <--->#
    /* <<<<<<<<<<<<<<<<<<<< */

    public function activate($id) {
        Auth::adminAuth();
        $activate = $this->Product->activate($id);
        Session::set('success', 'Item has been activated');
        if ($activate) {
            //Redirect::to('products');
        }
    }

    /* >>>>>>>>>>>>>>>>>>>> */
    #<---> inactivate <--->#
    /* <<<<<<<<<<<<<<<<<<<< */

    public function inActivate($id) {
        Auth::adminAuth();
        $inActivate = $this->Product->inActivate($id);
        if ($inActivate) {
            Session::set('success', 'Item has been inActivated');
            Redirect::to('products');
        }
    }

    /* >>>>>>>>>>>>>>>>>>>> */
    #<--->   delete   <--->#
    /* <<<<<<<<<<<<<<<<<<<< */

    public function delete($id) {
        Auth::adminAuth();
        Csrf::CsrfToken();
        Session::set('success', 'Item has been deleted');
        $delete = $this->Prooduct->delete($id);
        if ($delete) {
            //Redirect::to('products');
        }
    }

    /* >>>>>>>>>>>>>>>>>>>> */
    #<--->upload images<--->#
    /* <<<<<<<<<<<<<<<<<<<< */

    public function upload_images($id) {
        Auth::adminAuth();
        $pro_img = $_FILES['file']['name'];
        $pro_tmp = $_FILES['file']['tmp_name'];
        if (!empty($pro_img)) {
            $this->set('product', $this->Product->show($id));
            $uploaddir = ROOTDIR . '\public\uploads\\' . $product->product_id . '\\';
            if (!file_exists($uploaddir)) {
                mkdir($uploaddir);
            }
            $pro_img = explode('.', $pro_img);
            $pro_img_ext = $pro_img[1];
            $pro_img = $pro_img[0] . time() . '.' . $pro_img[1];

            if ($pro_img_ext != "jpg" && $pro_img_ext != "png" && $pro_img_ext != "jpeg" && $pro_img_ext != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            } else {
                move_uploaded_file($pro_tmp, $uploaddir . $pro_img);
                // echo $pro_img;
                $this->Product->addGallary($id, $pro_img);
            }
        } else {
            echo 'You must choose an image';
        }
    }

    /* >>>>>>>>>>>>>>>>>>>> */
    #<--->delete image<--->#
    /* <<<<<<<<<<<<<<<<<<<< */

    public function deleteGallaryImage($image_id, $pro_id, $name) {
        Auth::adminAuth();
        $image = dirname(ROOT) . '\public\uploads\\' . $pro_id . '\\' . $name;
        Session::set('success', 'Image has been deleted');
        $delete = $this->productModel->deleteGallaryImage($image_id);
        unlink($image);
        if ($delete) {
            //Redirect::back();
        }
    }

    /* >>>>>>>>>>>>>>>>>>>>>> */
    #<--->delete gallary<--->#
    /* <<<<<<<<<<<<<<<<<<<<<< */

    public function deleteGallary($id) {
        Auth::adminAuth();
        Session::set('success', 'Gallary has been deleted');
        $delete = $this->productModel->deleteGallary($id);
        $img_dir = dirname(ROOT) . '\public\uploads\\' . $id;
        $images = scandir($img_dir);
        foreach ($images as $image) {
            if (is_file($img_dir . '\\' . $image)) {
                unlink($img_dir . '\\' . $image);
                rmdir($img_dir);
            }
        }

        if ($delete) {
            //Redirect::back();
        }
    }

    /* >>>>>>>>>>>>>>>>>>>> */
    #<---> search <--->#
    /* <<<<<<<<<<<<<<<<<<<< */

    public function search() {
        Auth::adminAuth();
        $this->set('title', 'All Products');
        $searched = $_POST['search'];
        $results = $this->productModel->search($searched);
        $this->set('products', $results);
        //$this->view('products.search', $data);
    }

}
