<?php

class UsersController extends Controller {
    /* >>>>>>>>>>>>>>>>>>>> */
    #<---> construct  <--->#
    /* <<<<<<<<<<<<<<<<<<<< */

    private $vkey;

//        public function __construct(){
//            new Session();
//            $this->userModel = $this->model('User');
//            $this->cartModel = $this->model('Cart');
//        }


    /* >>>>>>>>>>>>>>>>>>>> */
    #<--->  register  <--->#
    /* <<<<<<<<<<<<<<<<<<<< */
    public function register() {
        Auth::userGuest();
        $this->set('title', 'Register');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['register']) {
                $fullname = filter_var($_POST['full_name'], FILTER_SANITIZE_STRING);
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $password = $_POST['password'];
                $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $password2 = $_POST['password2'];

                $vkey = time();
                $vkey = md5($vkey);
                $vkey = str_shuffle($vkey);

                if (empty($fullname)) {
                    $error['errName'] = 'Name Must Has Value.';
                    $this->set('errName', 'Name Must Has Value.');
                }
                //    elseif (strlen($fullname) < 4) {
                //         $data['errName'] = 'Name Must Not Less Than 4 Characters';
                //    }

                if (empty($email)) {
                    $error['errEmail'] = 'Email Must Has Value.';
                    $this->set('errEmail', 'Email Must Has Value.');
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error['errEmail'] = 'Enter Valid Email';
                    $this->set('errEmail', 'Enter Valid Email');
                } elseif ($this->User->findUserByEmail($email)) {
                    $error['errEmail'] = 'This Email is Already Exists';
                    $this->set('errEmail', 'This Email is Already Exists');
                }


                if (strlen($password) < 1) {
                    $error['errPassword'] = "Your Password Must Contain At Least 8 Characters!";
                    $this->set('errPassword', 'Your Password Must Contain At Least 8 Characters!');
                }
                // elseif(!preg_match("#[0-9]+#",$password)) {
                //      $data['errPassword'] = "Your Password Must Contain At Least 1 Number!";
                // }
                // elseif(!preg_match("#[A-Z]+#",$password)) {
                //      $data['errPassword'] = "Your Password Must Contain At Least 1 Capital Letter!";
                // }
                // elseif(!preg_match("#[a-z]+#",$password)) {
                //      $data['errPassword'] = "Your Password Must Contain At Least 1 Lowercase Letter!";
                // } 



                if ($password != $password2) {
                    $error['errPassword2'] = 'Password not match';
                    $this->set('errPassword2', 'Password not match');
                }
                if (empty($error['errEmail']) && empty($error['errName']) && empty($error['errPassword']) && empty($error['errPassword2'])) {
                    $img = 'noimage.png';
                    $this->User->register($fullname, $email, $img, $hashedPassword, $vkey);
                    Session::set('success', 'You can confirm now');
                    Session::set('email', $email);
                    $user = $this->User->login($email, $password);
                    Session::set('user_id', $user->user_id);
                    Email::sendCode($vkey, $email);
                    Redirect::to('users/confirm');
                    exit();
                }
            }
        }
    }

    public function update($id) {
        Auth::userAuth();
        $this->set('title', 'Edit Profile');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['editProfile']) {
                $fullname = filter_var($_POST['full_name'], FILTER_SANITIZE_STRING);
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $password = $_POST['password'];
                $oldPass = $_POST['oldPass'];
                $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

                if (empty($fullname)) {
                    $error['errName'] = 'Name Must Has Value.';
                    $this->set(errName, 'Name Must Has Value.');
                }
                //    elseif (strlen($fullname) < 4) {
                //         $data['errName'] = 'Name Must Not Less Than 4 Characters';
                //    }

                if (empty($password)) {
                    $hashedPassword = $oldPass;
                }

                if (empty($email)) {
                    $error['errEmail'] = 'Email Must Has Value.';
                    $this->set('errEmail', 'Email Must Has Value.');
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error['errEmail'] = 'Enter Valid Email';
                    $this->set('errEmail', 'Enter Valid Email');
                } elseif ($this->User->findUserByEmail($email, $id)) {
                    $error['errEmail'] = 'This Email is Already Exists';
                    $this->set('errEmail', 'This Email is Already Exists');
                }


                if (empty($data['errEmail']) && empty($data['errName']) && empty($data['errPassword'])) {
                    $this->User->update($id, $fullname, $email, $hashedPassword);
                    Session::set('user_name', $fullname);
                    Session::set('success', 'Your Profile has been edited');
                    Redirect::to('users/profile');
                } else {
                    $this->set('user', $this->User->show($id));
                }
            }
        } else {
            $this->set('user', $this->User->show($id));
        }
    }



    public function login() {
        Auth::userGuest();
        $this->set('title', 'Login');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['login']) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                if (empty($email)) {
                    $error['errEmail'] = 'Email Must Has Value.';
                    $this->set('errEmail', 'Email Must Has Value.');
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $error['errEmail'] = 'Enter Valid Email';
                    $this->set('errEmail', 'Enter Valid Email');
                } elseif ($this->User->findUserByEmail($email) == false) {
                    $error['errEmail'] = 'This Email Is Not Exist';
                    $this->set('errEmail', 'This Email Is Not Exist');
                }

                if (empty($password)) {
                    $error['errPassword'] = "Password Must Has Value.";
                    $this->set('errPassword', "Password Must Has Value.");
                }

                if (empty($error['errEmail']) && empty($error['errPassword'])) {
                    $user = $this->User->login($email, $password);
                    if ($user) {
                        Session::set('user_id', $user->user_id);
                        Session::set('email', $email);
                        Session::set('user_name', $user->full_name);
                        
                        if ($this->User->notVerified($email)) {
                            Session::set('danger', "Verify Your account firstly <a href='" . URL . "/users/confirm'>Confirm Now</a>");
                            $this->set('varified', false);
                            Redirect::to('/users/confirm');
                        } else {
                            Session::clear('email');
                            $cartItems = 0;
                            $carts = $this->User->cartModel->getAllCart();
                            if ($carts) {
                                foreach ($carts as $cart) {
                                    $cartItems = $cartItems + $cart->qty;
                                }
                            } else {
                                $cartItems = 0;
                            }
                            Session::set('user_img', $user->image);
                            Session::set('user_cart', $cartItems);
                            Session::set('user_name', $user->full_name);

                            if ($user->admin == 1) {
                                Session::set('admin_name', $user->full_name);
                                Session::set('admin_id', $user->user_id);
                            }
                            Redirect::to('users/profile');
                        }
                    } else {
                        $error['errPassword'] = "Password Not Valid";
                        $this->set('errPassword', 'Password Not Valid');
                    }
                }
            }
        }
    }

    /* >>>>>>>>>>>>>>>>>>>> */
    #<--->   logout    <--->#
    /* <<<<<<<<<<<<<<<<<<<< */

    public function logout() {
        Auth::userAuth();
        Session::clear('user_name');
        Session::clear('user_id');
        Session::destroy();
        Redirect::to('users/login');
    }

    /* >>>>>>>>>>>>>>>>>>>> */
    #<---> add avatar <--->#
    /* <<<<<<<<<<<<<<<<<<<< */

    public function avatar($id) {

        Auth::userAuth();
        $this->set('title', 'Edit Avatar');
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['addAvatar']) {

            echo $pro_img = $_FILES['image']['name'];
            $pro_tmp = $_FILES['image']['tmp_name'];
            $pro_type = $_FILES['image']['type'];
            if (!empty($pro_img)) {
                $uploaddir = ROOTDIR . '\public\uploads\\';
                $pro_img = explode('.', $pro_img);
                $pro_img_ext = $pro_img[1];
                $pro_img = $pro_img[0] . time() . '.' . $pro_img[1];

                if ($pro_img_ext != "jpg" && $pro_img_ext != "png" && $pro_img_ext != "jpeg" && $pro_img_ext != "gif") {
                    $error['errImg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $this->set('errImg', "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                }
            } else {
                $error['errImg'] = 'You must choose an image';
                $this->set('errImg', 'You must choose an image');
            }


            if (empty($data['errImg'])) {
                move_uploaded_file($pro_tmp, $uploaddir . $pro_img);
                unlink($uploaddir . Session::name('user_img'));
                $this->User->avatar($id, $pro_img);
                Session::set('user_img', $pro_img);
                Session::set('success', 'Your avatar has been uploaded successfully');

                Redirect::to('users/profile');
            }
        }
    }

    /* >>>>>>>>>>>>>>>>>>>> */
    #<--->   confirm  <--->#
    /* <<<<<<<<<<<<<<<<<<<< */

    public function confirm($v = null) {

        //Auth::userAuth();


        $this->set('title', 'Confirm');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_POST['confirm']) {
                $vkey = $_POST['vkey'];
                $email = Session::name('email');

                //echo $email;
                if (empty($vkey)) {
                    $error['errVkey'] = 'This Input Must Has Value.';
                    $this->set('errVkey', 'This Input Must Has Value.');
                }

                if (empty($error['errVkey'])) {
                    $this->set('user', $this->User->selectVkey($email, $vkey));
                    $confirm = $this->User->selectVkey($email, $vkey);
                    if ($confirm = $vkey) {
                        Session::set('success', 'Your account has been confirmed');
                        Session::clear('email');
//                        Session::set('user_id', $confirm->user_id);
//                        Session::set('user_name', $confirm->full_name);
//                        Session::set('user_img', $confirm->image);
                        $this->User->confirm($email);
                        Redirect::to('users/profile');
                    } else {
//                        $data = [
//                            'err' => '<div class="alert alert-danger">This code not correct</div>'
//                        ];
                        $this->set('err', '<div class="alert alert-danger">This code not correct</div>');
                        //$this->view('users.confirm', $data);
                    }
                } else {
                    //$this->view('users.confirm', $data);
                }
            }
        } elseif ($v != null && !empty($v)) {
            $vkey = $v;
            $email = Session::name('email');
            $confirm = $this->User->selectVkey($email, $vkey);

            $this->set('user', $this->User->selectVkey($email, $vkey));
            if ($confirm) {
                $this->User->confirm($email);
                Session::set('success', 'Your account has been confirmed');
//                Session::set('user_id', $confirm->user_id);
//                Session::set('user_name', $confirm->full_name);
//                Session::set('user_img', $confirm->image);
                Session::clear('email');
                Redirect::to('users/profile');
            }
        } else {
            if (Session::name('email') != null && Session::name('email') != '') {
                //$this->view('users.confirm', $data);
            } else {
                Redirect::to('users/login');
            }
        }
    }

    /* >>>>>>>>>>>>>>>>>>>>>>>> */
    #<---> forgotPassword <--->#
    /* <<<<<<<<<<<<<<<<<<<<<<<< */

    public function forgotPassword($g = null) {
        Auth::userGuest();
        $this->set('title', 'Forgot Password');
        $this->vkey = time();
        $this->vkey = md5($this->vkey);
        $vkey = $this->vkey = str_shuffle($this->vkey);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['forgotPassword'])) {
                $email = $_POST['email'];
                $email = filter_var($email, FILTER_SANITIZE_EMAIL);

                if ($this->userModel->forgotP($email, $vkey)) {
                    // echo $vkey;
                    sendpass($email, $vkey);
                    Session::set('success', 'please Check Your Email Inbox');
                    Redirect::to('users/forgotPassword');
                } else {
                    $this->set('err', '<div class="alert alert-danger">please Check Your Inputs</div>');
                    //$this->view('users.forgotPassword', $data);
                };
            }
        } else {
            //$this->view('users/forgotPassword', $data);
        }
    }

    /* >>>>>>>>>>>>>>>>>>>>>>> */
    #<---> resetPassword <--->#
    /* <<<<<<<<<<<<<<<<<<<<<<< */

    public function resetPassword($vkey) {
        Auth::userGuest();
        $this->set('title', 'Reset Password');
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['newPassword'])) {
                $password = $_POST['password'];
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                if (strlen($password) == 0) {
                    $error['errPassword'] = "Your Password Must Contain At Least 8 Characters!";
                    $this->set('errPassword', 'Your Password Must Contain At Least 8 Characters!');
                }
                // elseif(!preg_match("#[0-9]+#",$password)) {
                //      $data['errPassword'] = "Your Password Must Contain At Least 1 Number!";
                // }
                // elseif(!preg_match("#[A-Z]+#",$password)) {
                //      $data['errPassword'] = "Your Password Must Contain At Least 1 Capital Letter!";
                // }
                // elseif(!preg_match("#[a-z]+#",$password)) {
                //      $data['errPassword'] = "Your Password Must Contain At Least 1 Lowercase Letter!";
                // } 

                if (empty($error['errPassword'])) {
                    if ($this->User->resetP($vkey, $hashedPassword)) {
                        sendpass($email, $vkey);
                        Session::set('danger', 'Please login with new password');
                        Redirect::to('users/login');
                    } else {
                        $this->set('err', '<div class="alert alert-danger">please Check Your Inputs</div>');
                        //$this->view('users.resetPassword', $data);
                    };
                } else {
                    //$this->view('users.resetPassword', $data);
                }
            }
        } else {
            $this->set('vkey', $vkey);
            //$this->view('users.resetPassword', $data);
        }
    }

    /* >>>>>>>>>>>>>>>>>>>> */
    #<--->  profile   <--->#
    /* <<<<<<<<<<<<<<<<<<<< */

    public function profile() {

        Auth::userAuth();
        $this->set('title', 'Profile');
        $name = Session::name('user_name');
        $user_id = Session::name('user_id');
        $user = $this->User->userData($name, $user_id);

        if (isset($_SESSION['email'])) {
            Session::set('danger', "Verify Your account firstly <a href='" . URL . "/users/confirm'>Confirm Now</a>");
            Redirect::to('users/confirm');
        } else {
            $this->set('user', $user);
            if (Session::existed('email')) {
                Session::clear('email');
            }
        }
        //$this->view('users.profile', $data);
    }

    /* >>>>>>>>>>>>>>>>>>>> */
    #<--->   edit     <--->#
    /* <<<<<<<<<<<<<<<<<<<< */

    public function edit($id) {
        Auth::userAuth();
        $this->set('title', 'Edit Profile');
        $this->set('user', $this->User->show($id));
        $user = $this->User->show($id);
        if ($user && is_numeric($id)) {
            //$this->view('users.edit', $data);
        } else {
            Session::set('danger', 'This id not found');
            Redirect::to('users');
        }
    }

}
