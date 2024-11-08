<?php
class PaymentRecordController{
    static public function ctrShowPaymentRecord($item, $value){
        $table = "registro_pago";
        // Llamamos al modelo para obtener el usuario
        $answer = PaymentRecordModel::mdlShowPaymentRecord($table, $item, $value);

        return $answer;
    }

    static public function ctrShowPaymentRecordsByClient($id_cliente) {
        $table = "registro_pago";
        $answer = PaymentRecordModel::mdlShowPaymentRecordsByClient($table, $id_cliente);
    
       
        
        if ($answer) {
            return $answer;
        } else {
            return []; // Si no hay registros, devolvemos un arreglo vacío
        }
    }
    

    
}