<?php 

    class AdminsController extends Controller {
        
        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> construct  <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        private $adminModel;
        private $vkey ;

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   login    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function login(){
            $this->set('title', 'Admin Login');
            Auth::adminGuest();
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['login']){
                Csrf::CsrfToken();
                   $email = $_POST['email'];
                   $password = $_POST['password'];
                  
                   if (empty($email)) {
                        $error['errEmail'] = 'Email Must Has Value.';
                        $this->set('errEmail', 'Email Must Has Value.');
                    }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                        $error['errEmail'] = 'Enter Valid Email';
                        $this->set('errEmail', 'Enter Valid Email');
                    }elseif($this->Admin->findUserByEmail($email) == false){
                        $error['errEmail'] = 'This Email Is Not Exist';
                        $this->set('errEmail', 'This Email Is Not Exist');
                    }

                    if (empty($password)) {
                        $error['errPassword'] = "Password Must Has Value.";
                        $this->set('errEmail', 'Password Must Has Value.');
                    }

                    if(empty($error['errEmail']) && empty($error['errPassword'])){
                        $admin = $this->Admin->login($email,$password);
                        if($admin){
                    
                            Session::set('admin_name',$admin->full_name);
                            Session::set('admin_id',$admin->user_id);
                            Redirect::to('admins/dashboard');                           
                        }else {
                            $error['errPassword'] = "Password Not Valid OR not admin";
                            $this->set('errEmail', 'Password Not Valid OR not admin');
                            //$this->view('admins.login', $data);
                        }
                    }else{
                        //$this->view('admins.login', $data);

                    }

            }else {
                //$this->view('admins.login',$data);
            }
        }


        
        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   logout   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function logout(){
            Auth::adminAuth();
            Session::clear('admin_name');
            Session::destroy();
            Redirect::to('admins/login');
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> dashboard  <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function dashboard(){
            Auth::adminAuth();
            $this->set('title', 'Dashboard');
            $arrayName = explode(' ', Session::name('admin_name'));
            //echo var_dump($arrayName);
            $this->set('admin_name', $arrayName[0]);
            //$this->view('admins.dashboard', $data);
        }


    }
    