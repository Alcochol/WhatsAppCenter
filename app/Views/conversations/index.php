<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <h1>
                <i class="fab fa-whatsapp text-success"></i>
                Conversaciones
            </h1>

        </div>

    </section>


    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-body p-0">

                    <div class="row no-gutters" style="height: 650px;">

                        <!-- =========================
                             LISTA DE CONVERSACIONES
                        ========================== -->

                        <div
                            class="col-md-4 border-right"
                            style="overflow-y:auto;"
                        >

                            <div class="p-3 border-bottom">

                                <div class="input-group">

                                    <input
                                        type="text"
                                        id="buscarConversacion"
                                        class="form-control"
                                        placeholder="Buscar conversación..."
                                    >

                                    <div class="input-group-append">

                                        <span class="input-group-text">
                                            <i class="fas fa-search"></i>
                                        </span>

                                    </div>

                                </div>

                            </div>


                            <div id="listaConversaciones">

                                <div class="text-center p-4">

                                    <i class="fas fa-spinner fa-spin"></i>

                                    Cargando conversaciones...

                                </div>

                            </div>

                        </div>


                        <!-- =========================
                             PANEL DE CHAT
                        ========================== -->

                        <div
                            class="col-md-8 d-flex flex-column"
                        >

                            <!-- CABECERA -->

                            <div
                                id="cabeceraChat"
                                class="p-3 border-bottom"
                                style="display:none;"
                            >

                                <div class="d-flex align-items-center">

                                    <div class="mr-3">

                                        <div
                                            id="chatFoto"
                                            class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center"
                                            style="
                                                width:45px;
                                                height:45px;
                                            "
                                        >

                                            <i class="fas fa-user"></i>

                                        </div>

                                    </div>


                                    <div>

                                        <h5
                                            id="chatNombre"
                                            class="mb-0"
                                        >
                                        </h5>

                                        <small
                                            id="chatTelefono"
                                            class="text-muted"
                                        >
                                        </small>

                                    </div>

                                </div>

                            </div>


                            <!-- MENSAJES -->

                            <div
                                id="contenedorMensajes"
                                class="flex-grow-1 p-3"
                                style="
                                    overflow-y:auto;
                                    background:#f4f6f9;
                                "
                            >

                                <div
                                    id="mensajeInicial"
                                    class="text-center text-muted"
                                    style="margin-top:200px;"
                                >

                                    <i
                                        class="fab fa-whatsapp fa-3x mb-3"
                                    ></i>

                                    <h4>
                                        Selecciona una conversación
                                    </h4>

                                    <p>
                                        Selecciona un contacto de la lista
                                        para ver sus mensajes.
                                    </p>

                                </div>

                            </div>


                            <!-- CAJA DE MENSAJE -->

                            <div
                                id="barraMensaje"
                                class="p-3 border-top"
                                style="display:none;"
                            >

                                <div class="input-group">

                                    <input
                                        type="text"
                                        id="txtMensaje"
                                        class="form-control"
                                        placeholder="Escribe un mensaje..."
                                    >

                                    <div class="input-group-append">

                                        <button
                                            id="btnEnviarMensaje"
                                            class="btn btn-success"
                                        >

                                            <i class="fas fa-paper-plane"></i>

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>