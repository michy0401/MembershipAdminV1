<?php
require_once "../controllers/user.controller.php";
require_once "../models/user.model.php";

class AjaxUser{

    /*editar usuario*/
    public $idUser;

    public function ajaxEditUser (){
        $item = "id_user";
        $value = $this-> idUser;
        $answer = UserController::ctrShowUser($item, $value);

        echo json_encode($answer);
    }

    /*activar usuario*/
    
    public $activateUser;
    public $activateId;

    public function ajaxActivateUser(){
        $table = "user";
        $item1="status";
        $value1=$this->activateUser;
        $item2="id_user";
        $value2=$this->activateId;

        $answer = UserModel::mdlUpdateUser($table, $item1, $value1, $item2, $value2);


    }
    
    /*validar no rep usuario */

    public $validateUser;

    public function ajaxValidateUser(){
        $item = "username";
        $value = $this-> validateUser;
        $answer = UserController::ctrShowUser($item, $value);

        echo json_encode($answer);

    }

    


}

/*editar usuario*/
if (isset($_POST["idUser"])){

    $edit = new AjaxUser();
    $edit -> idUser = $_POST["idUser"];
    $edit -> ajaxEditUser();
}

/*activar usuario*/
if (isset($_POST["activateUser"])){

    $activateUser = new AjaxUser();
    $activateUser -> activateUser = $_POST["activateUser"];
    $activateUser -> activateId = $_POST["activateId"];

    $activateUser -> ajaxActivateUser();
}

/*validar no rep user */
if (isset($_POST["validateUser"])){

    $validateUser = new AjaxUser();
    $validateUser -> validateUser = $_POST["validateUser"];
   
    $validateUser -> ajaxValidateUser();
}