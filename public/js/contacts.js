$(function () {
  //=========================
  // DATATABLE
  //=========================

  $("#tablaContactos").DataTable({
    responsive: true,
    autoWidth: false,

    language: {
      search: "Buscar:",

      lengthMenu: "Mostrar _MENU_ registros",

      info: "Mostrando _START_ a _END_ de _TOTAL_ contactos",

      paginate: {
        first: "Primero",
        last: "Último",
        next: "Siguiente",
        previous: "Anterior",
      },

      zeroRecords: "No existen registros",

      emptyTable: "No existen contactos",
    },
  });

  //=========================
  // GUARDAR CONTACTO
  //=========================

  $("#frmContacto").submit(function (e) {
    e.preventDefault();

    $.ajax({
      url: "index.php?page=contacts/store",

      type: "POST",

      data: $(this).serialize(),

      dataType: "json",

      success: function (response) {
        if (response.success) {
          mensajeOk(response.message);
        } else {
          mensajeError(response.message);
        }
      },

      error: function (xhr) {
        console.log(xhr.responseText);

        mensajeError("Error del servidor");
      },
    });
  });
});
