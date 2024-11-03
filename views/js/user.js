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

            $("#editName").val(answer["name"]);
            $("#editUserName").val(answer["username"]);
            $("#editProfile").html(answer["profile"]);
            $("#editProfile").val(answer["profile"]);
            $("#currentPhoto").val(answer["photo"]);

            $("#currentPassword").val(answer["password"]);
            

            if(answer["photo"] != ""){
                $(".preview").attr("src", answer["photo"]);
            }

        }
    })
});

/*activar usuario */
$(".btnActivate").click(function(){
    var idUser = $(this).attr("idUser");
    var statusUser = $(this).attr("statusUser");

    var datas = new FormData();
    datas.append("activateId", idUser);
    datas.append("activateUser", statusUser);

    $.ajax({
        url: "ajax/user.ajax.php",
        method: "POST",
        data: datas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(answer){

        }

    });

    if (statusUser == 0){
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Inactivate');
        $(this).attr('statusUser', 1);
    } else{
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-success');
        $(this).html('Activate');
        $(this).attr('statusUser', 0);
    }
});

/*revisar usuario repetido*/
$("#newUserName").change(function(){

    $(".alert").remove();

    var user = $(this).val();

    var datas = new FormData();
    datas.append("validateUser", user);
    
    $.ajax({
        url: "ajax/user.ajax.php",
        method: "POST",
        data: datas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(answer){
            if (answer){
                $("#newUserName").parent().after('<div class = "alert alert-warning">Este usuario ya existe</div>');
                $("#newUserName").val("");

            }

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
