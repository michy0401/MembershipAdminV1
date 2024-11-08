<?php
require_once "../controllers/user.controller.php";
require_once "../models/user.model.php";

class AjaxUser{

    /*editar usuario*/
    public $idUser;

    public function ajaxEditUser (){
        $item = "id";
        $value = $this-> idUser;
        $answer = UserController::ctrShowUser($item, $value);

        echo json_encode($answer);
    }

    public $statusEmployee;
    public $activateIdEmployee;

    public function ajaxActivateEmployeeStatus() {
        $table = "empleado"; // Nombre de la tabla de empleados
        $item1 = "id_estado"; // El campo que deseas actualizar
        $value1 = $this->statusEmployee; // El nuevo valor del estado
        $item2 = "id"; // El campo de identificación
        $value2 = $this->activateIdEmployee; // El ID del empleado
        
        // Llamamos al modelo para realizar la actualización
        $response = UserModel::mdlUpdateEmployeeStatus($table, $item1, $value1, $item2, $value2);
        
        echo json_encode($response); // Devolvemos la respuesta
    }
    
    /*validar no rep usuario */

    public $validateUser;

    public function ajaxValidateUser(){
        $item = "usuario";
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
if (isset($_POST["statusEmployee"])) {
    $activateEmployee = new AjaxUser(); // Cambié "AjaxUser" a "AjaxEmployee"
    $activateEmployee->activateIdEmployee = $_POST["activateIdEmployee"];
    $activateEmployee->statusEmployee = $_POST["statusEmployee"];
    
    $activateEmployee->ajaxActivateEmployeeStatus();
}

/*validar no rep user */
if (isset($_POST["validateUser"])){

    $validateUser = new AjaxUser();
    $validateUser -> validateUser = $_POST["validateUser"];
   
    $validateUser -> ajaxValidateUser();
}