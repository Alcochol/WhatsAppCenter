// ===============================
// MENSAJE CORRECTO
// ===============================

function mensajeOk(texto) {
  Swal.fire({
    icon: "success",

    title: "Correcto",

    text: texto,

    confirmButtonColor: "#28a745",
  });
}

// ===============================
// MENSAJE ERROR
// ===============================

function mensajeError(texto) {
  Swal.fire({
    icon: "error",

    title: "Error",

    text: texto,

    confirmButtonColor: "#dc3545",
  });
}

// ===============================
// MENSAJE INFO
// ===============================

function mensajeInfo(texto) {
  Swal.fire({
    icon: "info",

    title: "Información",

    text: texto,
  });
}

// ===============================
// CONFIRMAR ELIMINAR
// ===============================

function confirmarEliminar(callback) {
  Swal.fire({
    title: "¿Eliminar registro?",

    text: "Esta acción no podrá deshacerse.",

    icon: "warning",

    showCancelButton: true,

    confirmButtonText: "Eliminar",

    cancelButtonText: "Cancelar",

    confirmButtonColor: "#dc3545",
  }).then((result) => {
    if (result.isConfirmed) {
      callback();
    }
  });
}
