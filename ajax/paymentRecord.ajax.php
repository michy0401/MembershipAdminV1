<?php
    require_once "../controllers/paymentRecord.controller.php";
    require_once "../models/paymentRecord.model.php";

    class AjaxTransaction {

        public $statusTransaction;
        public $activateIdTransaction;
    
        // Método para actualizar el estado de la transacción
        public function ajaxActivateTransaction() {
            $table = "registro_pago"; // Nombre de la tabla de transacciones, ajusta si es necesario
            $item1 = "id_estado"; // El campo que quieres actualizar
            $value1 = $this->statusTransaction; // El nuevo valor del estado de la transacción
            $item2 = "id"; // El campo de identificación
            $value2 = $this->activateIdTransaction;
    
            // Llamamos al modelo para realizar la actualización
            $response = PaymentRecordModel::mdlUpdateTransactionStatus($table, $item1, $value1, $item2, $value2);
    
            // Devolvemos la respuesta
            echo json_encode($response);
        }
    }
    

    // Mostrar registros de pagos de un cliente
    if (isset($_POST["clienteId"])) {
        $id_cliente = $_POST["clienteId"];
        // Obtener los pagos del cliente
        $response = PaymentRecordController::ctrShowPaymentRecordsByClient($id_cliente);

        // Devolver la respuesta en formato JSON
        echo json_encode($response);
    }

    // Cambiar el estado de la transacción
    if (isset($_POST["statusTransaction"]) && isset($_POST["activateIdTransaction"])) {
        $activateTransaction = new AjaxTransaction();  // Usamos una nueva clase llamada AjaxTransaction
        $activateTransaction->activateIdTransaction = $_POST["activateIdTransaction"];
        $activateTransaction->statusTransaction = $_POST["statusTransaction"];
    
        $activateTransaction->ajaxActivateTransaction();
    }
    
?>
