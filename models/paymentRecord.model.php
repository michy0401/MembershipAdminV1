<?php

require_once "connection.php";

class PaymentRecordModel{
    static public function mdlShowPaymentRecord($table, $item, $value){
        if ($item != null) {
            $stmt = Connection::connect()->prepare(
                "SELECT pago.*, cliente.nombre AS nombre_cliente 
                 FROM $table AS pago
                 LEFT JOIN cliente ON pago.id_cliente = cliente.id
                 WHERE $item = :$item"
            );
            $stmt->bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt->execute();
    
            return $stmt->fetch();
        } else {
            $stmt = Connection::connect()->prepare(
                "SELECT pago.*, cliente.nombre AS nombre_cliente 
                 FROM $table AS pago
                 LEFT JOIN cliente ON pago.id_cliente = cliente.id"
            );
            $stmt->execute();
    
            return $stmt->fetchAll();
        }
    
        $stmt->close();
        $stmt = null;
    }
    

    static public function mdlShowPaymentRecordsByClient($table, $id_cliente) {
        $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE id_cliente = :id_cliente");
        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll();  // Devuelve todas las transacciones
    }
    
}