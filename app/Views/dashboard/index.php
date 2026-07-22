<?php

use App\Controllers\DashboardController;

$controller = new DashboardController();

$data = $controller->index();



include __DIR__.'/../layouts/header.php';
include __DIR__.'/../layouts/navbar.php';
include __DIR__.'/../layouts/sidebar.php';
?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <h1>Dashboard</h1>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            Bienvenido a WhatsApp Contact Center

        </div>


        <div>

            <h3>Conversaciones</h3>
            <?= $data['conversaciones'] ?>

            <h3>Contactos</h3>
            <?= $data['contactos'] ?>

            <h3>Mensajes</h3>
            <?= $data['mensajes'] ?>


        </div>

    </section>

</div>

<?php

include __DIR__.'/../layouts/footer.php';
include __DIR__.'/../layouts/scripts.php';

?>