<?php
class CustomerController{
    /* Mostrar cliente*/
   // CustomerController.php

    public static function ctrShowCustomer($item, $value) {
        $table = "cliente";
        // Llamamos al modelo para obtener el cliente
        $answer = CustomerModel::mdlShowCustomer($table, $item, $value);
        
        // Verificamos que se haya encontrado el cliente
        return $answer;
    }

    /*borrar usuario */
    static public function crtDeleteCustomer(){
        if(isset($_GET["idCustomer"])){
            $table = "cliente";
            $data = $_GET["idCustomer"];

            $answer = CustomerModel::mdlDeleteCustomer($table, $data);

            if ($answer == "ok") {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Cliente eliminado exitosamente",
                        text: "",
                        footer: ""
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "customer";
                        }
                    });
                </script>';
            }

        }
    }


    
}