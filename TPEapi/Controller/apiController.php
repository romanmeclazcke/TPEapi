<?php
    require_once "./View/apiView.php";

 abstract class apiController{
    protected $model;
    protected $view;

    private $data;

    public function __construct() {
        $this->view = new APIView();
        $this->data = file_get_contents("php://input"); 
    }

    function getData(){ 
        return json_decode($this->data); 
    }  



}