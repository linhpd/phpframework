<?php

class ItemsController extends Controller {

	function view($id = null,$name = null) {
	
		$this->set('title',$name.' - My Todo List App');
		$this->set('titletodo',$this->Item->select($id));

	}
	
	function viewall() {

		$this->set('title','All Items - My Todo List App');
		$this->set('todo',$this->Item->selectAll());
	}
	
	function add() {
		$todo = $_POST['todo'];
               //$_db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$this->set('title','Success - My Todo List App');
		$this->set('todo',$this->Item->query('insert into items (item_name) values (?)', array($todo)));
                
                //mysqli_close($_db);
	}
	
	function delete($id = null) {
                //$_db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$this->set('title','Success - My Todo List App');
		$this->set('todo',$this->Item->query('delete from items where id = (?)', array($id)));	
                //mysqli_close($_db);
	}

}
