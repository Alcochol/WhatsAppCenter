$(function () {
  console.log("CONVERSATIONS.JS CARGADO");

  let conversacionActual = null;

  // ==========================================
  // INICIO
  // ==========================================

  cargarConversaciones();

  // ==========================================
  // CARGAR CONVERSACIONES
  // ==========================================

  function cargarConversaciones() {
    console.log("Cargando conversaciones...");

    $.ajax({
      url: "index.php?page=conversations/list",

      type: "GET",

      dataType: "json",

      success: function (response) {
        console.log("RESPUESTA CONVERSACIONES:", response);

        if (!response.data) {
          mostrarSinConversaciones();

          return;
        }

        mostrarConversaciones(response.data);
      },

      error: function (xhr, status, error) {
        console.error("ERROR AJAX:", status, error);

        console.error("RESPUESTA:", xhr.responseText);

        $("#listaConversaciones").html(`

                    <div class="alert alert-danger m-3">

                        <i class="fas fa-exclamation-triangle"></i>

                        Error al cargar las conversaciones.

                    </div>

                `);
      },
    });
  }

  // ==========================================
  // MOSTRAR CONVERSACIONES
  // ==========================================

  function mostrarConversaciones(conversaciones) {
    let html = "";

    if (conversaciones.length === 0) {
      mostrarSinConversaciones();

      return;
    }

    conversaciones.forEach(function (conversacion) {
      let nombre = conversacion.nombre || conversacion.telefono || "Sin nombre";

      let telefono = conversacion.telefono || "";

      let ultimoMensaje = conversacion.ultimo_mensaje || "Sin mensajes";

      let fecha =
        conversacion.ultima_interaccion || conversacion.fecha_inicio || "";

      html += `

                <div
                    class="conversation-item p-3 border-bottom"
                    data-id="${conversacion.id}"
                    style="cursor:pointer;"
                >

                    <div class="d-flex align-items-center">

                        <!-- FOTO -->

                        <div class="mr-3">

                            <div
                                class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center"
                                style="
                                    width:45px;
                                    height:45px;
                                "
                            >

                                <i class="fas fa-user"></i>

                            </div>

                        </div>


                        <!-- INFORMACIÓN -->

                        <div class="flex-grow-1">

                            <div class="d-flex justify-content-between">

                                <strong>
                                    ${escapeHtml(nombre)}
                                </strong>

                            </div>


                            <small class="text-muted">

                                ${escapeHtml(telefono)}

                            </small>


                            <div
                                class="text-muted text-truncate"
                                style="max-width:280px;"
                            >

                                ${escapeHtml(ultimoMensaje)}

                            </div>

                        </div>

                    </div>

                </div>

            `;
    });

    $("#listaConversaciones").html(html);
  }

  // ==========================================
  // SIN CONVERSACIONES
  // ==========================================

  function mostrarSinConversaciones() {
    $("#listaConversaciones").html(`

            <div class="text-center text-muted p-4">

                <i class="fas fa-comments fa-2x mb-2"></i>

                <br>

                No existen conversaciones.

            </div>

        `);
  }

  // ==========================================
  // SELECCIONAR CONVERSACIÓN
  // ==========================================

  $(document).on("click", ".conversation-item", function () {
    let id = $(this).data("id");

    console.log("Conversación seleccionada:", id);

    conversacionActual = id;

    // Quitar selección anterior

    $(".conversation-item").removeClass("bg-light");

    // Marcar conversación actual

    $(this).addClass("bg-light");

    // Buscar datos

    let nombre = $(this).find("strong").text();

    let telefono = $(this).find("small").text();

    // Mostrar cabecera

    $("#chatNombre").text(nombre);

    $("#chatTelefono").text(telefono);

    $("#cabeceraChat").show();

    // Mostrar barra de mensaje

    $("#barraMensaje").show();

    // Ocultar mensaje inicial

    $("#mensajeInicial").hide();

    // Por ahora mostramos mensaje temporal

    $("#contenedorMensajes").html(`

                <div
                    class="text-center text-muted"
                    style="margin-top:200px;"
                >

                    <i class="fas fa-spinner fa-spin fa-2x"></i>

                    <br><br>

                    Cargando mensajes...

                </div>

            `);

    // =====================================
    // AQUÍ DESPUÉS CARGAREMOS LOS MENSAJES
    // =====================================

    cargarMensajes(id);
  });

  // ==========================================
  // CARGAR MENSAJES
  // ==========================================

  function cargarMensajes(conversacionId) {
    console.log("Cargando mensajes de conversación:", conversacionId);

    $.ajax({
      url: "index.php?page=conversations/messages&id=" + conversacionId,

      type: "GET",

      dataType: "json",

      success: function (response) {
        console.log("RESPUESTA MENSAJES:", response);

        // ===============================
        // VALIDAR RESPUESTA
        // ===============================

        if (!response.messages) {
          mostrarErrorMensajes();

          return;
        }

        // ===============================
        // ACTUALIZAR CABECERA
        // ===============================

        if (response.conversation) {
          $("#chatNombre").text(
            response.conversation.nombre ||
              response.conversation.telefono ||
              "Sin nombre",
          );

          $("#chatTelefono").text(response.conversation.telefono || "");
        }

        // ===============================
        // MOSTRAR MENSAJES
        // ===============================

        mostrarMensajes(response.messages);
      },

      error: function (xhr) {
        console.error("ERROR MENSAJES:", xhr.responseText);

        mostrarErrorMensajes();
      },
    });
  }

  function mostrarMensajes(mensajes) {
    if (!mensajes || mensajes.length === 0) {
      $("#contenedorMensajes").html(`

            <div
                class="text-center text-muted"
                style="margin-top:200px;"
            >

                <i class="fas fa-comments fa-3x mb-3"></i>

                <h5>
                    No existen mensajes
                </h5>

                <p>
                    Esta conversación todavía no tiene mensajes.
                </p>

            </div>

        `);

      return;
    }

    let html = "";

    mensajes.forEach(function (mensaje) {
      // =====================================
      // DETERMINAR SI ES ENTRADA O SALIDA
      // =====================================

      const esEntrada = mensaje.tipo === "Entrada";

      // =====================================
      // POSICIÓN DE LA BURBUJA
      // =====================================

      const alineacion = esEntrada
        ? "justify-content-start"
        : "justify-content-end";

      // =====================================
      // COLOR
      // =====================================

      const claseBurbuja = esEntrada ? "mensaje-entrada" : "mensaje-salida";

      // =====================================
      // HORA
      // =====================================

      const hora = formatearFecha(mensaje.fecha);

      // =====================================
      // ESTADO
      // =====================================

      let estado = "";

      if (!esEntrada) {
        estado = obtenerEstadoMensaje(mensaje.estado);
      }

      // =====================================
      // CONSTRUIR BURBUJA
      // =====================================

      html += `

            <div
                class="d-flex ${alineacion} mb-2"
            >

                <div
                    class="mensaje-burbuja ${claseBurbuja}"
                >

                    <div class="mensaje-texto">

                        ${escapeHtml(mensaje.mensaje || "")}

                    </div>


                    <div
                        class="mensaje-info"
                    >

                        <span>
                            ${hora}
                        </span>

                        ${estado}

                    </div>

                </div>

            </div>

        `;
    });

    function obtenerEstadoMensaje(estado) {
      if (!estado) {
        return "";
      }

      estado = estado.toLowerCase();

      switch (estado) {
        case "enviado":
          return `
                <span class="mensaje-estado">
                    ✓
                </span>
            `;

        case "entregado":
          return `
                <span class="mensaje-estado">
                    ✓✓
                </span>
            `;

        case "leido":
        case "leído":
          return `
                <span class="mensaje-estado estado-leido">
                    ✓✓
                </span>
            `;

        case "fallido":
        case "error":
          return `
                <span class="mensaje-estado estado-error">
                    !
                </span>
            `;

        default:
          return `
                <span class="mensaje-estado">
                    ✓
                </span>
            `;
      }
    }

    $("#contenedorMensajes").html(html);

    // =====================================
    // IR AL ÚLTIMO MENSAJE
    // =====================================

    const contenedor = $("#contenedorMensajes")[0];

    if (contenedor) {
      contenedor.scrollTop = contenedor.scrollHeight;
    }
  }

  function mostrarErrorMensajes() {
    $("#contenedorMensajes").html(`

        <div
            class="alert alert-danger m-3"
        >

            <i class="fas fa-exclamation-triangle"></i>

            No fue posible cargar los mensajes.

        </div>

    `);
  }

  function formatearFecha(fecha) {
    if (!fecha) {
      return "";
    }

    let partes = fecha.split(" ");

    if (partes.length === 2) {
      return partes[1].substring(0, 5);
    }

    return fecha;
  }

  // ==========================================
  // BUSCAR CONVERSACIÓN
  // ==========================================

  $("#buscarConversacion").on("keyup", function () {
    let texto = $(this).val().toLowerCase();

    $(".conversation-item").each(function () {
      let contenido = $(this).text().toLowerCase();

      if (contenido.indexOf(texto) !== -1) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });

  // ==========================================
  // ESCAPAR HTML
  // ==========================================

  function escapeHtml(text) {
    return $("<div>")
      .text(text ?? "")
      .html();
  }
});
