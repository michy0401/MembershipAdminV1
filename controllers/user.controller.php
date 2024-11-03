<?php
class UserController {

    public function ctrlogInUser() {
        if (isset($_POST["loginUser"])) {
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["loginUser"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["loginPassword"])) {

                $encrypt = crypt($_POST["loginPassword"], '$6$rounds=1000000$NJy4rIPjpOaU$0ACEYGg/aKCY3v8O8AfyiO7CTfZQ8/W231Qfh2tRLmfdvFD6XfHk12u6hMr9cYIA4hnpjLNSTRtUwYr9km9Ij/');

                $table = "user";
                $item = "username";
                $value = $_POST["loginUser"];
                
                // Llamamos al modelo para obtener el usuario
                $answer = UserModel::mdlShowUser($table, $item, $value);

                // Verificamos si se obtuvo un resultado de la base de datos
                if ($answer) {
                    // Verificamos si el usuario y la contraseña coinciden
                    if ($answer["username"] == $_POST["loginUser"] && $answer["password"] == $encrypt) {

                        if($answer["status"] == 1){

                            $_SESSION["iniciarSesion"] = "ok";
                            $_SESSION["id_user"] = $answer["id_user"];
                            $_SESSION["name"] = $answer["name"];
                            $_SESSION["username"] = $answer["username"];
                            $_SESSION["photo"] = $answer["photo"];
                            $_SESSION["profile"] = $answer["profile"];

                            /*fecha y hora del ultimo login */
                            date_default_timezone_set('America/El_Salvador');
                            $currentDate = date('Y-m-d H:i:s');

                            $item1 = "lastLogIng";
                            $value1 = $currentDate;

                            $item2 = "id_user";
                            $value2 = $answer["id_user"];

                            $lastLogIn = UserModel::mdlUpdateUser($table, $item1, $value1, $item2, $value2);

                            if ($lastLogIn == "ok"){
                                echo '<script> 
                                    window.location = "dashboard";
                                </script>';

                            }

                            
                        } else{
                            echo '<br><div class="alert alert-danger">Usuario no esta activado.</div>';    
                        }
                    } else {
                        echo '<br><div class="alert alert-danger">Usuario o contraseña incorrecta. Vuelve a intentarlo.</div>';
                    }
                } else {
                    // Si no se encontró el usuario
                    echo '<br><div class="alert alert-danger">Usuario no existe. Vuelve a intentarlo.</div>';
                }
            } else {
                echo '<br><div class="alert alert-danger">Usuario o contraseña incorrecta. Vuelve a intentarlo.</div>';
            }
        }
    }

   
    /*REGISTRO DE USUARIOS*/
    static public function ctrCreateUser() {
        if (isset($_POST["newUserName"])) {
            // Validación de los campos de entrada con expresiones regulares
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newName"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["newUserName"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["newPassword"])) {

                $route = "";

                /*Validar imagen */
                if(isset($_FILES["newPhoto"]["tmp_name"]) && !empty($_FILES["newPhoto"]["tmp_name"])){

                    list($width, $height) = getimagesize($_FILES["newPhoto"]["tmp_name"]);
                    $newWidth = 500;
                    $newHeight = 500;

                    //directorio para guardar foto
                    $directory = "views/img/users/".$_POST["newUserName"];

                    mkdir($directory, 0755, true);

                    //metodos para el tipo de imagen 

                    if ($_FILES["newPhoto"]["type"] == "image/jpeg"){
                        //guardamos imagen jpg
                        $random = mt_rand(100,999);

                        $route = "views/img/users/".$_POST["newUserName"]."/".$random.".jpg";

                        $origin = imagecreatefromjpeg($_FILES["newPhoto"]["tmp_name"]);

                        $destiny = imagecreatetruecolor($newWidth, $newHeight);

                        imagecopyresized($destiny, $origin, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                        imagejpeg($destiny, $route);

                    }

                    if ($_FILES["newPhoto"]["type"] == "image/png"){
                        //guardamos imagen jpg
                        $random = mt_rand(100,999);

                        $route = "views/img/users/".$_POST["newUserName"]."/".$random.".png";

                        $origin = imagecreatefrompng($_FILES["newPhoto"]["tmp_name"]);

                        $destiny = imagecreatetruecolor($newWidth, $newHeight);

                        imagecopyresized($destiny, $origin, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                        imagepng($destiny, $route);

                    }
                }else{
                    $route = NULL;
                }


                /* Datos para enviar a la base de datos */
                $table = "user";

                $encrypt = crypt($_POST["newPassword"], '$6$rounds=1000000$NJy4rIPjpOaU$0ACEYGg/aKCY3v8O8AfyiO7CTfZQ8/W231Qfh2tRLmfdvFD6XfHk12u6hMr9cYIA4hnpjLNSTRtUwYr9km9Ij/');

                $data = array(
                    "name" => $_POST["newName"],
                    "username" => $_POST["newUserName"],
                    "password" => $encrypt,  
                    "profile" => $_POST["newProfile"],
                    "photo" => $route
                );

                //Llamada al modelo para registrar el usuario 
                $answer = UserModel::mdlRegisterUser($table, $data);

                if ($answer == "ok") {
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "Usuario agregado exitosamente",
                            text: "",
                            footer: ""
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "user";
                            }
                        });
                    </script>';
                }

            } else {
                // Si la validación falla, mostramos un error
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "El usuario no puede ir vacío o llevar caracteres especiales",
                        text: "",
                        footer: ""
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "user";
                        }
                    });
                </script>';
            }
        }
    }

    /* Mostrar Usuario*/
    static public function ctrShowUser($item, $value){
        $table = "user";
        // Llamamos al modelo para obtener el usuario
        $answer = UserModel::mdlShowUser($table, $item, $value);

        return $answer;
    }


    /*Editar usuario */
    static public function crtEditUser(){
        if(isset($_POST["editUserName"])){

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editName"]) ) {
                /*validar imagen */

                $route = $_POST["currentPhoto"];

                /*Validar imagen */
                if(isset($_FILES["editPhoto"]["tmp_name"]) && !empty($_FILES["editPhoto"]["tmp_name"])){

                    list($width, $height) = getimagesize($_FILES["editPhoto"]["tmp_name"]);
                    $newWidth = 500;
                    $newHeight = 500;

                    //directorio para guardar foto
                    $directory = "views/img/users/".$_POST["editUserName"];

                    /*primero preguntamos si existe otra imagen en la base de datos */
                    if (!empty($_POST["currentPhoto"])){
                        unlink($_POST["currentPhoto"]);

                    }else{
                        mkdir($directory, 0755, true);
                    }

                    

                    //metodos para el tipo de imagen 

                    if ($_FILES["editPhoto"]["type"] == "image/jpeg"){
                        //guardamos imagen jpg
                        $random = mt_rand(100,999);

                        $route = "views/img/users/".$_POST["editUserName"]."/".$random.".jpg";

                        $origin = imagecreatefromjpeg($_FILES["editPhoto"]["tmp_name"]);

                        $destiny = imagecreatetruecolor($newWidth, $newHeight);

                        imagecopyresized($destiny, $origin, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                        imagejpeg($destiny, $route);

                    }

                    if ($_FILES["editPhoto"]["type"] == "image/png"){
                        //guardamos imagen jpg
                        $random = mt_rand(100,999);

                        $route = "views/img/users/".$_POST["editUserName"]."/".$random.".png";

                        $origin = imagecreatefrompng($_FILES["editPhoto"]["tmp_name"]);

                        $destiny = imagecreatetruecolor($newWidth, $newHeight);

                        imagecopyresized($destiny, $origin, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                        imagepng($destiny, $route);

                    }
                }

                /* Datos para enviar a la base de datos */
                $table = "user";

                if ($_POST["editPassword"] != ""){
                

                    if( preg_match('/^[a-zA-Z0-9]+$/', $_POST["editPassword"])) {
                        $encrypt = crypt($_POST["editPassword"], '$6$rounds=1000000$NJy4rIPjpOaU$0ACEYGg/aKCY3v8O8AfyiO7CTfZQ8/W231Qfh2tRLmfdvFD6XfHk12u6hMr9cYIA4hnpjLNSTRtUwYr9km9Ij/');


                    } else{
                        echo '
                        // Si la validación falla, mostramos un error
                        <script>
                            Swal.fire({
                                icon: "error",
                                title: "La contraseña no puede ir vacío o llevar caracteres especiales",
                                text: "",
                                footer: ""
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = "user";
                                }
                            });
                        </script>';
                    }
                
                } else{
                    $encrypt = $_POST["currentPassword"];
                }

                $data = array(
                    "name" => $_POST["editName"],
                    "username" => $_POST["editUserName"],
                    "password" => $encrypt,  
                    "profile" => $_POST["editProfile"],
                    "photo" => $route
                );

                $answer = UserModel::mdlEditUser($table, $data);

                if ($answer == "ok") {
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "Usuario editado exitosamente",
                            text: "",
                            footer: ""
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "user";
                            }
                        });
                    </script>';
                }
            }else{
                // Si la validación falla, mostramos un error
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "El usuario no puede ir vacío o llevar caracteres especiales",
                        text: "",
                        footer: ""
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "user";
                        }
                    });
                </script>';
            }

        }
    }
    

    /*borrar usuario */
    static public function crtDeleteUser(){
        if(isset($_GET["idUser"])){
            $table = "user";
            $data = $_GET["idUser"];

            

            if($_GET["photoUser"] != ""){
                unlink($_GET["photoUser"]);
                rmdir('views/img/users/'.$_GET["username"]);

            }

            $answer = UserModel::mdlDeleteUser($table, $data);

            if ($answer == "ok") {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Usuario eliminado exitosamente",
                        text: "",
                        footer: ""
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "user";
                        }
                    });
                </script>';
            }

        }
    }
    
}

