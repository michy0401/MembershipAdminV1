
/*data table*/
/*$(function () {
  $("#example1").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  $('.tablas').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
  });
});*/

/*data table*
$(function () {
  // Configuración para la tabla .tablas
  $('.tablas').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
  }).buttons().container().appendTo('.tablas_wrapper .col-md-6:eq(0)'); // Ubica los botones en la parte superior
});*/

$(function () {
  $("#example1").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "buttons": [
      {
        extend: 'csv',
        text: 'Export CSV',
        exportOptions: {
          modifier: {
            page: 'all'
          },
          format: {
            body: function (data, row, column, node) {
              // Verifica si la celda contiene un select
              if ($(node).find('select').length > 0) {
                // Devuelve el valor seleccionado, no las opciones del select
                return $(node).find('select').val();
              }
              // Verifica si la celda contiene un botón (para evitar exportarlo)
              if ($(node).find('button').length > 0) {
                return ''; // Evita exportar la celda con un botón
              }
              return data; // Para otras celdas, exporta el valor tal cual
            }
          }
        }
      },
      {
        extend: 'excel',
        text: 'Export Excel',
        exportOptions: {
          modifier: {
            page: 'all'
          },
          format: {
            body: function (data, row, column, node) {
              // Verifica si la celda contiene un select
              if ($(node).find('select').length > 0) {
                // Devuelve el valor seleccionado, no las opciones del select
                return $(node).find('select').val();
              }
              // Verifica si la celda contiene un botón (para evitar exportarlo)
              if ($(node).find('button').length > 0) {
                return ''; // Evita exportar la celda con un botón
              }
              return data; // Para otras celdas, exporta el valor tal cual
            }
          }
        }
      },
      {
        extend: 'pdf',
        text: 'Export PDF',
        exportOptions: {
          modifier: {
            page: 'all'
          },
          format: {
            body: function (data, row, column, node) {
              // Verifica si la celda contiene un select
              if ($(node).find('select').length > 0) {
                // Devuelve el valor seleccionado, no las opciones del select
                return $(node).find('select').val();
              }
              // Verifica si la celda contiene un botón (para evitar exportarlo)
              if ($(node).find('button').length > 0) {
                return ''; // Evita exportar la celda con un botón
              }
              return data; // Para otras celdas, exporta el valor tal cual
            }
          }
        }
      },
      {
        extend: 'print',
        text: 'Print',
        exportOptions: {
          modifier: {
            page: 'all'
          },
          format: {
            body: function (data, row, column, node) {
              // Verifica si la celda contiene un select
              if ($(node).find('select').length > 0) {
                // Devuelve el valor seleccionado, no las opciones del select
                return $(node).find('select').val();
              }
              // Verifica si la celda contiene un botón (para evitar exportarlo)
              if ($(node).find('button').length > 0) {
                return ''; // Evita exportar la celda con un botón
              }
              return data; // Para otras celdas, exporta el valor tal cual
            }
          }
        }
      },
      "colvis" // Para la visibilidad de columnas
    ]
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});
