/*Subir foto de usuario*/
$(".newPhoto").change(function(){
    var image = this.files[0];
    
    /*validar formato de la imagen sea png/jpg */
    if(image["type"] != "image/jpeg" && image["type"] != "image/png"){
        $(".newPhoto").val("");
        Swal.fire({
            icon: "error",
            title: "La imagen debe estar en formato JPG o PNG",
            text: "",
            footer: ""
        });
    } else if (image["size"] > 2000000){
        $(".newPhoto").val("");
        Swal.fire({
            icon: "error",
            title: "La imagen no debe pesar mas de 2MB",
            text: "",
            footer: ""
        });
    }else{

        var dataImage = new FileReader;
        dataImage.readAsDataURL(image);

        $(dataImage).on("load", function(event){
            var routeImage = event.target.result;
            $(".preview").attr("src", routeImage);
        })
    }
})

/*Editar usuario */
$(".btnEditUser").click(function(){
    var idUser = $(this).attr("idUser");

    var datas = new FormData();
    datas.append("idUser", idUser);

    $.ajax({
        url: "ajax/user.ajax.php",
        method: "POST",
        data: datas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(answer){
            //answer = JSON.parse(answer);

            $("#editName").val(answer["nombre"]);
            $("#editUserName").val(answer["usuario"]);
            $("#editProfile").html(answer["cargo"]);
            $("#editProfile").val(answer["cargo"]);
            $("#currentPhoto").val(answer["foto"]);

            $("#currentPassword").val(answer["password"]);
            

            if(answer["foto"] != ""){
                $(".preview").attr("src", answer["foto"]);
            }

        }
    })
});

/*activar usuario */
$(".selectEmployeeStatus").change(function() {
    var idEmployee = $(this).attr("idEmployee");  // ID del empleado
    var statusEmployee = $(this).val();  // Estado seleccionado (1 = Active, 2 = Inactive)

    var datas = new FormData();
    datas.append("activateIdEmployee", idEmployee);  // Agregar ID del empleado
    datas.append("statusEmployee", statusEmployee);  // Agregar el nuevo estado

    $.ajax({
        url: "ajax/user.ajax.php",  // URL del archivo PHP que manejará la actualización
        method: "POST",
        data: datas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(answer) {
            if(answer === "ok") {
                Swal.fire({
                    icon: "success",
                    title: "Estado actualizado",
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error al actualizar el estado",
                    text: "Intente nuevamente."
                });
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: " + error);  // Esto te ayudará a depurar posibles errores
            Swal.fire({
                icon: "error",
                title: "Error en la comunicación con el servidor",
                text: "Intente nuevamente."
            });
        }
    });
});


/*borrar usuario */
$(".btnDeleteUser").click(function(){
    var idUser = $(this).attr("idUser");
    var photoUser = $(this).attr("photoUser");
    var username = $(this).attr("username");


    Swal.fire({
        icon: "warning",
        title: "¿Estas seguro de eliminar el usuario?",
        text: "",
        footer: "",
        showCloseButton: true,
        showCancelButton: true,
        showConfirmButton: true,
        focusConfirm: false,
        confirmButtonText: `<i class="fa fa-solid fa-trash"></i> Acept`,
        cancelButtonText: `<i class="fa fa-solid"></i> Cancel`,
        
    }).then((result) => {
        if (result.value) {
            window.location = "index.php?ruta=user&idUser="+idUser+"&username="+username+"&photoUser="+photoUser;
        }
    });
})
