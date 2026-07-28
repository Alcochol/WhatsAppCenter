<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h1>Contactos</h1>

</div>

</section>

<section class="content">
    
<div class="container-fluid">

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-users"></i>

            Contactos

        </h3>

        <div class="card-tools">

            <button
                class="btn btn-success"
                data-toggle="modal"
                data-target="#modalContacto">

                <i class="fas fa-plus"></i>

                Nuevo Contacto

            </button>

        </div>

    </div>

    <div class="card-body">



<table id="tablaContactos" class="table table-bordered table-striped">

<thead>

<tr>

<th>ID</th>

<th>Nombre</th>

<th>Teléfono</th>

<th>Origen</th>

<th>Activo</th>

<th>Acciones</th>

</tr>

</thead>

<tbody>


</tbody>

</table>

<div class="modal fade" id="modalContacto">

    <div class="modal-dialog">

        <div class="modal-content">

            <form id="frmContacto"  method="POST">

                <div class="modal-header bg-success">

                    <h4 class="modal-title" id="tituloModal">

                        Nuevo Contacto

                    </h4>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>

                <input type="hidden" id="id" name="id" value="">

                <div class="modal-body">

                    <div class="form-group">

                        <label>Nombre</label>

                        <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        class="form-control">

                    </div>

                    <div class="form-group">

                        <label>Teléfono</label>

                        <input
                        type="text"
                        id="telefono"
                        name="telefono"
                        class="form-control">

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        id="btnGuardarContacto"
                        type="submit"
                        class="btn btn-success">

                        Guardar

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</div> <!-- card-body -->

</div> <!-- card -->

</div> <!-- container-fluid -->

</section>

</div> <!-- content-wrapper -->