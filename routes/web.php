<?php

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\ConversationController;
use App\Controllers\ContactController;
use App\Controllers\LabelController;
use App\Controllers\TemplateController;
use App\Controllers\BotController;
use App\Controllers\ReportController;
use App\Controllers\SettingController;

$router->get('dashboard', [DashboardController::class, 'index']);

$router->get('conversations', [ConversationController::class, 'index']);

$router->get('contacts', [ContactController::class, 'index']);

$router->get('labels', [LabelController::class, 'index']);

$router->get('templates', [TemplateController::class, 'index']);

$router->get('bot', [BotController::class, 'index']);

$router->get('reports', [ReportController::class, 'index']);

$router->get('settings', [SettingController::class, 'index']);

$router->get('login', [AuthController::class, 'login']);

$router->post('login', [AuthController::class, 'login']);

$router->post('contacts/store', [ContactController::class, 'store']);

$router->get('contacts/list', [ContactController::class, 'list']);

$router->get('contacts/edit',[ContactController::class,'edit']);

$router->post('contacts/update',[ContactController::class,'update']);