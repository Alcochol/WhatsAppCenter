$(function () {
  let modo = "nuevo";
  //=========================
  // DATATABLE
  //=========================

  let tabla = $("#tablaContactos").DataTable({
    responsive: true,

    autoWidth: false,

    ajax: {
      url: "index.php?page=contacts/list",

      dataSrc: "data",
    },

    columns: [
      { data: "id" },

      { data: "nombre" },

      { data: "telefono" },

      { data: "origen" },

      {
        data: "activo",

        render: function (valor) {
          return valor == 1
            ? '<span class="badge badge-success">Activo</span>'
            : '<span class="badge badge-danger">Inactivo</span>';
        },
      },
      {
        data: null,

        orderable: false,

        searchable: false,

        render: function (data) {
          return `
            <button
                class="btn btn-warning btn-sm btnEditar"
                data-id="${data.id}">
                <i class="fas fa-edit"></i>
            </button>

            <button
                class="btn btn-danger btn-sm btnEliminar"
                data-id="${data.id}">
                <i class="fas fa-trash"></i>
            </button>

            <button
                class="btn btn-success btn-sm btnChat"
                data-id="${data.id}">
                <i class="fab fa-whatsapp"></i>
            </button>
        `;
        },
      },
    ],

    language: {
      search: "Buscar:",
      lengthMenu: "Mostrar _MENU_ registros",
      info: "Mostrando _START_ a _END_ de _TOTAL_ contactos",
      zeroRecords: "No existen registros",
      emptyTable: "No existen contactos",
      paginate: {
        first: "Primero",
        last: "Último",
        next: "Siguiente",
        previous: "Anterior",
      },
    },
  });

  //=========================
  // GUARDAR CONTACTO
  //=========================

  $("#frmContacto").submit(function (e) {
    e.preventDefault();
    let url =
      modo === "nuevo"
        ? "index.php?page=contacts/store"
        : "index.php?page=contacts/update";

    $("#btnGuardarContacto").prop("disabled", true);

    $.ajax({
      url: url,

      type: "POST",

      data: $(this).serialize(),

      dataType: "json",

      success: function (response) {
        if (response.success) {
          mensajeOk(response.message);

          $("#modalContacto").modal("hide");

          $("#frmContacto")[0].reset();

          modo = "nuevo";

          tabla.ajax.reload(null, false);
        } else {
          mensajeError(response.message);
        }
      },
      complete: function () {
        $("#btnGuardarContacto").prop("disabled", false);
      },
    });
  });

  //=========================
  // EDITAR CONTACTO
  //=========================

  $(document).on("click", ".btnEditar", function () {
    let id = $(this).data("id");

    modo = "editar";

    $.get(
      "index.php?page=contacts/edit&id=" + id,

      function (contacto) {
        $("#id").val(contacto.id);

        $("#nombre").val(contacto.nombre);

        $("#telefono").val(contacto.telefono);

        $("#tituloModal").text("Editar Contacto");

        $("#modalContacto").modal("show");
      },

      "json",
    );
  });

  $("#btnNuevo").click(function () {
    modo = "nuevo";

    $("#frmContacto")[0].reset();

    $("#id").val("");

    $("#tituloModal").text("Nuevo Contacto");
  });
});
