<?php

namespace App\Controllers;

use App\Controllers\ConversationController;

$controller = new ConversationController();

$conversations = $controller->index();

?>

<div class="content-wrapper">

<section class="content">

<div class="container-fluid">

<div class="row">

<div class="col-md-4">

<div class="card">

<div class="card-header">

<h3 class="card-title">

Conversaciones

</h3>

</div>

<div class="card-body p-0">

<ul class="list-group">

<?php foreach($conversations as $c): ?>

<li class="list-group-item">

<strong>

<?= htmlspecialchars($c['nombre']) ?>

</strong>

<br>

<?= htmlspecialchars($c['telefono']) ?>

</li>

<?php endforeach; ?>

</ul>

</div>

</div>

</div>

<div class="col-md-8">

<div class="card">

<div class="card-body">

<h3>

Selecciona una conversación

</h3>

</div>

</div>

</div>

</div>

</div>

</section>

</div>