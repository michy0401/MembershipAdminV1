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
        $stmt = Connection::connect()->prepare("INSERT INTO $table(name, username, password, profile, photo) VALUES (:name, :username, :password, :profile, :photo)");

        $stmt -> bindParam(":name", $data["name"], PDO:: PARAM_STR);
        $stmt -> bindParam(":username", $data["username"], PDO:: PARAM_STR);
        $stmt -> bindParam(":password", $data["password"], PDO:: PARAM_STR);
        $stmt -> bindParam(":profile", $data["profile"], PDO:: PARAM_STR);
        $stmt -> bindParam(":photo", $data["photo"], PDO:: PARAM_STR);
        

        if ($stmt -> execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt -> close();
        $stmt = null;
    }

    /*editar usuario */
    static public function mdlEditUser($table, $data){
        $stmt = Connection::connect()->prepare("UPDATE $table SET name = :name, password = :password, profile = :profile, photo = :photo WHERE username = :username");
        
        $stmt -> bindParam(":name", $data["name"], PDO:: PARAM_STR);
        $stmt -> bindParam(":password", $data["password"], PDO:: PARAM_STR);
        $stmt -> bindParam(":profile", $data["profile"], PDO:: PARAM_STR);
        $stmt -> bindParam(":photo", $data["photo"], PDO:: PARAM_STR);
        $stmt -> bindParam(":username", $data["username"], PDO:: PARAM_STR);

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
        $stmt = Connection::connect()->prepare("DELETE FROM $table WHERE id_user = :idUser" );

        $stmt -> bindParam(":idUser", $data, PDO::PARAM_INT);

        if ($stmt -> execute()){
            return "ok";
        }else{
            return "error";
        }

        $stmt -> close();
        $stmt = null;


    }
}