<?php

require_once __DIR__ . '/vendor/autoload.php';

$page = $_GET['page'] ?? 'dashboard';

switch ($page) {

    case 'dashboard':
        require __DIR__ . '/app/Views/dashboard/index.php';
        break;

    case 'conversations':
        require __DIR__ . '/app/Views/conversations/index.php';
        break;

    case 'contacts':
        require __DIR__ . '/app/Views/contacts/index.php';
        break;

    default:
        echo "Página no encontrada";
}