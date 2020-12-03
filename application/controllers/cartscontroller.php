<?php 

    class CartsController extends Controller {

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   index    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function cart(){
            Auth::userAuth();
            $this->set('title', 'Cart');
            $cartItems = 0;
            $cart=$this->Cart->getAllCart();
            $this->set('cart', $this->Cart->getAllCart());
            if($cart){
                foreach ($cart as $cart) {
                    $cartItems = $cartItems +  $cart->qty;
                }
            }else {
                $cartItems = 0;
            }
            Session::set('user_cart', $cartItems );
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   Thank    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function thank(){
            Auth::userAuth();
            $this->set('title', 'Thank You');
            $this->set('title2', 'Transaction Done');
            $this->view('front.thank',$data);
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   orders    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function orders(){
            Auth::userAuth();
            $data['title'] = 'Orders';
            $data['orderDetails'] = $this->orderModel->getUserOrderDetalails(Session::name('user_id'));
            $this->view('front.orders',$data);
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> add to cart<--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function add($pro_id,$price){
            Auth::userAuth();
            $user_id = Session::name('user_id');
            if($this->Cart->findCartPro($pro_id,$user_id) > 0){
                $this->Cart->addOne($pro_id,$user_id);
                Redirect::to('carts/cart');
            }else{
                $this->Cart->addnew($pro_id,$user_id,$price);
                Redirect::to('carts/cart');
            }
        }

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> update Qty <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function updateQty($id){
            Auth::userAuth();
            Csrf::CsrfToken();
            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['upQty']){
                $qty = $_POST['qty'];

                if ($qty < 1 && empty($qty)) {
                    Redirect::to('carts');
                }else {
                    $this->Cart->updateQty($id,$qty);
                    Session::set('success', 'Qty has been updated');
                    Redirect::to('carts');
                }
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   delete   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function delete($id){
            Auth::userAuth();
            Csrf::CsrfToken();
            Session::set('success', 'Item has been deleted');
            $delete =  $this->Cart->delete($id);
            if($delete){
                Redirect::to('carts');
            }
        }

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   delete   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function clear(){
            Auth::userAuth();
            Csrf::CsrfToken();
            Session::set('success', 'All Item has been deleted');
            $delete =  $this->Cart->clear();
            if($delete){
                Redirect::to('carts');
            }
        }



        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->  checkout  <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function checkout(){
            Auth::userAuth();
            Csrf::CsrfToken();
            if($_SERVER['REQUEST_METHOD']=='POST'){

                require_once('../vendor/autoload.php');
                \Stripe\Stripe::setApiKey('sk_test_dRGPlCrOt3QXSuOxSwhvT5cZ00xTVDsc19');

                $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
                $name = $_POST['name'];
                $email = $_POST['email'];
                $mobile = $_POST['mobile'];
                $address = $_POST['address'];
                $city = $_POST['city'];
                $total = $_POST['total'];
                $qty = $_POST['qty'];

                
                if(empty($_POST['payment_method'])){
                    $data['errMethod'] = 'You must choose payment method';
                }
                if (strlen($name) < 4) {
                $data['errName'] = 'Name must not be less than 4 characters';
                }
                if (empty($email)) {
                    $data['errEmail'] = 'Email Must Has Value.';
                }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                    $data['errEmail'] = 'Enter Valid Email';
                }

                if (strlen($mobile) < 11) {
                    $data['errMobile'] = 'Name must not be less than 11 characters';
                }

                if (empty($address)) {
                    $data['errAddress'] = 'Address Must Has Value.';
                }
                if (empty($city)) {
                    $data['errCity'] = 'City Must Has Value.';
                }

                if(empty($data['errName']) && empty($data['errEmail'])
                    && empty($data['errMobile']) && empty($data['errAddress']) 
                    && empty($data['errCity']) && empty($data['errMethod'])){

                    if($_POST['payment_method'] == 'stripe' ){
                        $token = $_POST['stripeToken'];
                        $customer = \Stripe\Customer::create(array(
                            'email' => $email,
                            'source'=>$token
                        ));
                        
                        $charge = \Stripe\Charge::create([
                        'amount' => $qty * 100,
                        'currency' => 'usd', 
                        'description' => 'Transaction from market website',
                        'customer' => $customer->id
                        ]);

                    }

                    $shipping_id= $this->orderModel->addToShipping($name,$email,$mobile,$address,$city);
                    Session::set('shipping_id', $shipping_id);
                    
                    //complete order
                    $payment_id= $this->orderModel->addToPayment($_POST['payment_method'],$shipping_id);
                    
                    $order_id = $this->orderModel->addToOrder(
                        Session::name('user_id'),$shipping_id,$payment_id
                        ,$total
                    );

                    $data['cart'] = $this->cartModel->getAllCart();
                    foreach ($data['cart'] as $cart) {
                        $this->orderModel->addToOrderDetails(
                            $order_id,$cart->product,$cart->pro_name,
                            $cart->price ,$cart->qty,Session::name('user_id')
                        );
                    }

                    $this->cartModel->clear();
                    Session::set('user_cart', '0');
                    Redirect::to("carts/thank");
                
                }else {
                    $data['cart'] = $this->cartModel->getAllCart();
                    $this->view('front.cart', $data);
                }
            }else {
                Redirect::to('carts');
            }
        }
    }