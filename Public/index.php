<?php

session_start();
require_once "../Vendor/autoload.php";
date_default_timezone_set('asia/jakarta');

use AbieSoft\Sistem\StartApp;
use AbieSoft\Sistem\Utility\Define;

new Define();

use AbieSoft\Sistem\Http\Route;

$app = new StartApp(dirname(__DIR__));

use AbieSoft\Sistem\Auth\Controller\AuthController;
use AbieSoft\Sistem\Auth\Controller\WebserviceController;









Route::get('/', 'index');
Route::sistem(AuthController::class);
Route::get('/webservice', [WebserviceController::class, 'index']);

$app->start();
