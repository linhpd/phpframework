<?php 

    class ManufacturesController extends Controller {
        private $manufactureModel;
//        public function __construct(){
//            new Session;
//            $this->manufactureModel = $this->model('Manufacture');
//        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   index    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function all(){
            Auth::adminAuth();
            $this->set('title', 'All Brands');
            $this->set('manufactures', $this->Manufacture->getAllMan());
            //$this->view('manufactures.all', $data);
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> search <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function search(){
            Auth::adminAuth();
            $this('title', 'All Brands');
            $searched = $_POST['search'];
            $results = $this->Manufacture->search($searched);
            $this->set('manufactures', $results);
            //$this->view('manufactures.search', $data);
            
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   show    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function show($id){
            Auth::adminAuth();
            $this->set('manufacture', $this->Manufacture->show($id));
            $manufacture = $this->Manufacture->show($id);
            $this->set('title', $manufacture->man_name);
            if($manufacture && is_numeric($id)){
                //$this->view('manufactures.show', $data);
            }else {
                Session::set('danger', 'This id not found');
                Redirect::to('manufactures/all');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->    add    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function add(){
            Auth::adminAuth();
            Csrf::CsrfToken();
            $this('title', 'Add Brand');
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['addManufacture']){
                $man_name = $_POST['manufacture'];
                $man_user = Session::name('admin_id');
                $description = $_POST['description'];

                if (strlen($man_name) < 3) {
                    $error['errMan'] = 'manufacture name must not be less than 3 characters';
                    $this->set('errMan', 'manufacture name must not be less than 3 characters');
                }elseif($this->manufactureModel->findManName($man_name) > 0) {
                    $data['errMan'] = 'This name already exist choose anthor one';
                    $this->set('errMan', 'This name already exist choose anthor one');
                }
                if (strlen($description) < 5) {
                    $error['errDes'] = 'manufacture description must not be less than 5 characters';
                    $this->set('errDes', 'manufacture description must not be less than 5 characters');
                }

                if(empty($error['errMan']) && empty($error['errDes'])){
                    $this->Manufaction->add($man_name,$man_user,$description);
                    Session::set('success', 'New manufacture added successfully');
                    Redirect::to('manufactures/all');
                }else {
                    //$this->view('manufactures.add', $data);
                }
            }else {
                //$this->view('manufactures.add',$data);
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   edit     <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function edit($id){
            Auth::adminAuth();
            $this->set('title', 'Edit Brand');
            $manufacture = $this->Manufacture->show($id);
            $this->set('manufacture', $manufacture);
            if($manufacture && is_numeric($id)){
                //$this->view('manufactures.edit', $data);
            }else {
                Session::set('danger', 'This id not found');
                Redirect::to('manufactures/all');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   update   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function update($id){
            Auth::adminAuth();
            Csrf::CsrfToken();
            $this->set('title', 'Edit Brand');
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['editManufacture']){
                $man_name = $_POST['manufacture'];
                $man_id = $_POST['man_id'];
                $description = $_POST['description'];
                $man_user = Session::name('admin_id');

                if (strlen($man_name) < 3) {
                    $error['errMan'] = 'manufacture name must not be less than 3 characters';
                    $this->set('errMan', $error['errMan']);
                }elseif($this->Manufacture->findManName($man_name,$man_id) > 0) {
                    $error['errMan'] = 'This name already exist choose anthor one';
                    $this->set('errMan', $error['errMan']);
                }

                if (strlen($description) < 5) {
                    $error['errDes'] = 'manufacture description must not be less than 5 characters';
                    $this->set('errDes', $error['errDes']);
                }

                if(empty($error['errMan']) && empty($error['errDes'])){
                    $this->Manufacture->update($id, $man_name,$description);
                    Session::set('success', 'manufacture has been edited successfully');
                    Redirect::to('manufactures/all');
                }else {
                    $this->set('manufacture', $this->Manufacture->show($id));
                    //$this->view('manufactures.edit', $data);
                }

            }else {
                Redirect::to('manufactures/all');
            }
        }



        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->  activate  <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function activate($id){
            Auth::adminAuth();
            $activate =  $this->Manufacture->activate($id);
            Session::set('success', 'Item has been activated');
            if($activate){
                Redirect::to('manufactures/all');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> inactivate <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function inActivate($id){
            Auth::adminAuth();
            $inActivate =  $this->Manufaceture->inActivate($id);
            if($inActivate){
                Session::set('success', 'Item has been inActivated');
                Redirect::to('manufactures/all');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   delete   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function delete($id){
            Auth::adminAuth();
            Csrf::CsrfToken();
            Session::set('success', 'Item has been deleted');
            $delete =  $this->Manufacture->delete($id);
            if($delete){
                Redirect::to('manufactures/all');
            }
        }

    }