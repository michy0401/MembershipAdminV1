<?php

require_once "connection.php";

class UserModel{
    static public function mdlShowUser($table, $item, $value){
        if ($item != null){
            $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item =:$item" );
            $stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
            $stmt -> execute();

            return $stmt -> fetch();
        } else{
            $stmt = Connection::connect()->prepare("SELECT * FROM $table");
            $stmt -> execute();

            return $stmt -> fetchAll();
        }
   
        $stmt -> close();
        $stmt = null;
    }


    static public function mdlRegisterUser($table, $data){
        $stmt = Connection::connect()->prepare("INSERT INTO $table(nombre, usuario, password, cargo, foto) VALUES (:nombre, :usuario, :password, :cargo, :foto)");
    
        $stmt -> bindParam(":nombre", $data["nombre"], PDO:: PARAM_STR);
        $stmt -> bindParam(":usuario", $data["usuario"], PDO:: PARAM_STR);
        $stmt -> bindParam(":password", $data["password"], PDO:: PARAM_STR);
        $stmt -> bindParam(":cargo", $data["cargo"], PDO:: PARAM_STR);  
        $stmt -> bindParam(":foto", $data["foto"], PDO:: PARAM_STR);
    
        if ($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt -> close();
        $stmt = null;
    }
    

    /*editar usuario */
    static public function mdlEditUser($table, $data){
        $stmt = Connection::connect()->prepare("UPDATE $table SET nombre = :nombre, password = :password, cargo = :cargo, foto = :foto WHERE usuario = :usuario");
        
        $stmt -> bindParam(":nombre", $data["nombre"], PDO:: PARAM_STR);
        $stmt -> bindParam(":password", $data["password"], PDO:: PARAM_STR);
        $stmt -> bindParam(":cargo", $data["cargo"], PDO:: PARAM_STR);
        $stmt -> bindParam(":foto", $data["foto"], PDO:: PARAM_STR);
        $stmt -> bindParam(":usuario", $data["usuario"], PDO:: PARAM_STR);

        if ($stmt -> execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt -> close();
        $stmt = null;
    }

    /*actualizar usuario */
    static public function mdlUpdateUser($table, $item1, $value1, $item2, $value2){
        $stmt = Connection::connect()->prepare("UPDATE $table SET $item1 = :$item1 WHERE $item2 = :$item2");
        
        $stmt -> bindParam(":".$item1, $value1, PDO:: PARAM_STR);
        $stmt -> bindParam(":".$item2, $value2, PDO:: PARAM_INT);
       

        if ($stmt -> execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt -> close();
        $stmt = null;
    }

    /*borrar usuario */

    static public function mdlDeleteUser($table, $data){
        $stmt = Connection::connect()->prepare("DELETE FROM $table WHERE id = :id" );

        $stmt -> bindParam(":id", $data, PDO::PARAM_INT);

        if ($stmt -> execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt -> close();
        $stmt = null;


    }


    static public function mdlUpdateEmployeeStatus($table, $item1, $value1, $item2, $value2) {
        $stmt = Connection::connect()->prepare("UPDATE $table SET $item1 = :$item1 WHERE $item2 = :$item2");
    
        $stmt->bindParam(":".$item1, $value1, PDO::PARAM_INT);
        $stmt->bindParam(":".$item2, $value2, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return "ok"; // Si la actualización es exitosa
        } else {
            return "error"; // Si ocurre algún problema
        }
    
        $stmt->close();
        $stmt = null;
    }
    
}