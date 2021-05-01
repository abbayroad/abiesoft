<?php

session_start();
require_once "../Vendor/autoload.php";
date_default_timezone_set('asia/jakarta');

use AbieSoft\Sistem\StartApp;
use AbieSoft\Sistem\Utility\Define;

new Define();

use AbieSoft\Sistem\Http\Route;

$app = new StartApp(dirname(__DIR__));

/////--Controller
use AbieSoft\Controllers\ProfileController;
use AbieSoft\Controllers\GrupController;
use AbieSoft\Controllers\AuthController;
use AbieSoft\Controllers\UsersController;


Route::get('/', 'index');

//Users
Route::grup('users', UsersController::class);

//Grup
Route::grup('grup', GrupController::class);

//Profile
Route::grup('profile', ProfileController::class);
Route::get('/setprofilenama', [ProfileController::class, 'setnama']);
Route::get('/setprofileemail', [ProfileController::class, 'setemail']);
Route::get('/setprofilephone', [ProfileController::class, 'setphone']);
Route::get('/setprofilephoto', [ProfileController::class, 'setphoto']);

//Authentication
Route::get('/login', [AuthController::class, 'index']);
Route::get('/konfirmasi', [AuthController::class, 'konfirmasi']);
Route::get('/reset', [AuthController::class, 'reset']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/konfirmasi', [AuthController::class, 'kirimjawaban']);
Route::post('/reset', [AuthController::class, 'ubahpassword']);
Route::get('/logout', [AuthController::class, 'logout']);

$app->start();
