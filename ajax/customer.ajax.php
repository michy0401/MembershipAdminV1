<?php
require_once "../controllers/customer.controller.php";
require_once "../models/customer.model.php";

class AjaxCustomer {
    public $activateCustomer;
    public $activateId;

    public function ajaxActivateCustomer() {
        $table = "cliente";
        $item1 = "id_estado";
        $value1 = $this->activateCustomer;
        $item2 = "id";
        $value2 = $this->activateId;

        $answer = CustomerModel::mdlUpdateCustomer($table, $item1, $value1, $item2, $value2);
        echo json_encode($answer);
    }

    public $activateMembership;
    public $activateIdMembership;

    public function ajaxActivateMembership() {
        $table = "cliente";
        $item1 = "id_estado_membresia";
        $value1 = $this->activateMembership;
        $item2 = "id";
        $value2 = $this->activateIdMembership;

        $answer = CustomerModel::mdlUpdateCustomer($table, $item1, $value1, $item2, $value2);
        echo json_encode($answer);
    }

}

if (isset($_POST["activateCustomer"])) {
    $activateCustomer = new AjaxCustomer();
    $activateCustomer->activateCustomer = $_POST["activateCustomer"];
    $activateCustomer->activateId = $_POST["activateId"];

    $activateCustomer->ajaxActivateCustomer();
}

if (isset($_POST["activateMembership"])) {
    $activateMembership = new AjaxCustomer();
    $activateMembership->activateMembership = $_POST["activateMembership"];
    $activateMembership->activateIdMembership = $_POST["activateIdMembership"];

    $activateMembership->ajaxActivateMembership();
}

