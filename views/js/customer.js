$(".btnDeleteCustomer").click(function() {
    var idCustomer = $(this).attr("idCustomer");

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
            window.location = "index.php?ruta=customer&idCustomer="+idCustomer;
        }
    });
});


/*activar cliente*/
// Cambiar el estado del cliente con la lista desplegable
$(".selectCustomerStatus").change(function() {
    var idCustomer = $(this).attr("idCustomer");
    var statusCustomer = $(this).val();
    
    var datas = new FormData();
    datas.append("activateId", idCustomer);
    datas.append("activateCustomer", statusCustomer);

    $.ajax({
        url: "ajax/customer.ajax.php",
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
        }
    });
});


/* Activar membresía */
// Detectar cambios en la lista desplegable de estado de membresía
$(".selectMembershipStatus").change(function(){
    var idCustomer = $(this).attr("idCustomer");
    var statusMembership = $(this).val();

    var datas = new FormData();
    datas.append("activateIdMembership", idCustomer);
    datas.append("activateMembership", statusMembership);

    $.ajax({
        url: "ajax/customer.ajax.php",
        method: "POST",
        data: datas,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(answer){
            if (answer === "ok") {
                Swal.fire({
                    icon: "success",
                    title: "Estado de membresía actualizado correctamente",
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error al actualizar estado",
                    text: "Intente de nuevo.",
                    showConfirmButton: true
                });
            }
        }
    });
});
