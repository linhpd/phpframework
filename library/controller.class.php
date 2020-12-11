<?php
require_once ROOTDIR.'\application\helpers\Session.php';
require_once ROOTDIR.'\application\helpers\Auth.php';
require_once ROOTDIR.'\application\helpers\redirect.php';
require_once ROOTDIR.'\application\helpers\email.php';
require_once ROOTDIR.'\application\helpers\csrf.php';
require_once ROOTDIR.'\application\helpers\random.php';

class Controller {

    protected $_model;
    protected $_controller;
    protected $_action;
    protected $_template;

    function __construct($model, $controller, $action) {
        //echo 'new controller';
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_model = $model;

        session_start();
        $this->$model = new $model;
        $this->_template = new Template($controller, $action);
    }

    function set($name, $value) {
        $this->_template->set($name, $value);
    }

    function __destruct() {
        $this->_template->render();
    }

    public function model($model) {
        require_once "../application/models/" . $model . ".php";
        return new $model();
    }

}
