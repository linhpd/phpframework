<?php 

    class PagesController extends Controller {
       
        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   index    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function index(){
            
            $this->set('title', 'Home Page');
        }

        /*>>>>>>>>>>>>>>>>>>>>*/
        #<--->   about    <--->#
        /*<<<<<<<<<<<<<<<<<<<<*/
        public function about(){
            $this->set('title', 'About Page');
        }

    }