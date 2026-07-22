<?php

session_start();

require_once __DIR__.'/vendor/autoload.php';

include 'app/Views/layouts/header.php';

include 'app/Views/layouts/navbar.php';

include 'app/Views/layouts/sidebar.php';

$router = require 'routes/web.php';

$router->dispatch();

include 'app/Views/layouts/footer.php';

include 'app/Views/layouts/scripts.php';