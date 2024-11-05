<?php

class Connection{
    static public function connect(){
        $link = new PDO("mysql:host=localhost;dbname=membershipDataBase",
                        "root", 
                        "d040104a");

        $link -> exec("set names utf8");

        return $link;
    }
}