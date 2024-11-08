<?php

require_once "connection.php";

class CustomerModel{
    // CustomerModel.php

    public static function mdlShowCustomer($table, $item, $value) {
        if ($item != null) {
            // Si hay un filtro por un campo específico (por ejemplo, por id)
            $stmt = Connection::connect()->prepare(
                "SELECT cliente.*, membresia.membresia AS nombre_membresia
                FROM $table
                LEFT JOIN membresia ON cliente.id_membresia = membresia.id
                WHERE $item = :$item 
                AND cliente.id_estado IN (5, 6, 7)"  // Filtra por estado Active, Canceled, Pending
            );
            $stmt->bindParam(":".$item, $value, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch();  // Usamos fetch() para obtener un solo resultado
        } else {
            // Si no hay filtro, obtenemos todos los clientes
            $stmt = Connection::connect()->prepare(
                "SELECT cliente.*, membresia.membresia AS nombre_membresia
                FROM $table
                LEFT JOIN membresia ON cliente.id_membresia = membresia.id
                WHERE cliente.id_estado IN (5, 6, 7)"  // Filtra por estado Active, Canceled, Pending
            );
            $stmt->execute();

            return $stmt->fetchAll();  // Usamos fetchAll() si no hay filtro
        }

        $stmt->close();
        $stmt = null;
    }

    /*borrar usuario */

    static public function mdlDeleteCustomer($table, $data) {
        // Iniciar transacción
        $conn = Connection::connect();
        $conn->beginTransaction();
    
        try {
            // Eliminar los pagos asociados al cliente
            $stmt1 = $conn->prepare("DELETE FROM registro_pago WHERE id_cliente = :id_cliente");
            $stmt1->bindParam(":id_cliente", $data, PDO::PARAM_INT);
            $stmt1->execute();
    
            // Eliminar el cliente
            $stmt2 = $conn->prepare("DELETE FROM $table WHERE id = :id");
            $stmt2->bindParam(":id", $data, PDO::PARAM_INT);
            $stmt2->execute();
    
            // Confirmar la transacción
            $conn->commit();
            return "ok";  // Ambas eliminaciones fueron exitosas
        } catch (Exception $e) {
            // Si ocurre un error, revertir la transacción
            $conn->rollBack();
            return "error: " . $e->getMessage();  // Devolver el mensaje de error
        }
    }
    
    

    /*actualizar usuario */
    static public function mdlUpdateCustomer($table, $item1, $value1, $item2, $value2){
        $stmt = Connection::connect()->prepare("UPDATE $table SET $item1 = :$item1 WHERE $item2 = :$item2");
        
        $stmt -> bindParam(":".$item1, $value1, PDO::PARAM_STR);
        $stmt -> bindParam(":".$item2, $value2, PDO::PARAM_INT);
       
        if ($stmt -> execute()){
            return "ok";
        }else{
            return "error";
        }
    
        $stmt -> close();
        $stmt = null;
    }
    
    
}