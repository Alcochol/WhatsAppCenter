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

</tr>

</thead>

<tbody>

<?php $contactos = (isset($contactos) && is_array($contactos)) ? $contactos : []; ?>
<?php foreach($contactos as $c): ?>

<tr>

<td><?= $c['id'] ?></td>

<td><?= $c['nombre'] ?></td>

<td><?= $c['telefono'] ?></td>

<td><?= $c['origen'] ?></td>

<td><?= $c['activo'] ?></td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

<div class="modal fade" id="modalContacto">

    <div class="modal-dialog">

        <div class="modal-content">

            <form id="frmContacto">

                <div class="modal-header bg-success">

                    <h4 class="modal-title">

                        Nuevo Contacto

                    </h4>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal">

                        &times;

                    </button>

                </div>

                <div class="modal-body">

                    <div class="form-group">

                        <label>Nombre</label>

                        <input
                            type="text"
                            class="form-control"
                            name="nombre">

                    </div>

                    <div class="form-group">

                        <label>Teléfono</label>

                        <input
                            type="text"
                            class="form-control"
                            name="telefono">

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="submit"
                        class="btn btn-success">

                        Guardar

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>