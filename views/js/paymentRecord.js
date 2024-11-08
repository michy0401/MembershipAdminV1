
$(".selectTransactionStatus").change(function() {
    var idTransaction = $(this).attr("idCustomer");  // Cambié a idCustomer, ya que es lo que tienes en el HTML
    var statusTransaction = $(this).val();  // Estado seleccionado

    var datas = new FormData();
    datas.append("activateIdTransaction", idTransaction);  // Agregar ID de la transacción
    datas.append("statusTransaction", statusTransaction);  // Agregar el nuevo estado

    $.ajax({
        url: "ajax/paymentRecord.ajax.php",  // Asegúrate de que la URL esté correcta
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



