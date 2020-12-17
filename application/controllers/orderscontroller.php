<?php 

    class OrdersController extends Controller {
       


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   index    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function all(){
            Auth::adminAuth();
            $this->set('title', 'All Orders');
            $this->set('orders', $this->Order->getAllOrder());
            //$this->view('orders.all', $data);
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   show    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function show($id){
            Auth::adminAuth();
            $this->set('order', $this->Order->show($id));
            $order = $this->Order->show($id);
            $this->set('shipping', $this->Order->showShipping($order->shipping_id));
            $this->set('orderDetails', $this->Order->getAllOrderDetalails($order->order_id));
            $this->set('title', 'Order '.$order->order_id);
            //$this->view('orders.show', $data);
        }



        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->  activate  <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function activate($id){
            Auth::adminAuth();
            $activate =  $this->Order->activate($id);
            Session::set('success', 'Item has been activated');
            if($activate){
                Redirect::to('orders');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<---> inactivate <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function inActivate($id){
            Auth::adminAuth();
            $inActivate =  $this->Order->inActivate($id);
            if($inActivate){
                Session::set('success', 'Item has been inActivated');
                Redirect::to('orders');
            }
        }


        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   delete   <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function delete($id){
            Auth::adminAuth();
            $delete =  $this->Order->delete($id);
            Session::set('success', 'Item has been deleted');
            Redirect::to('orders');
            
        }

    }