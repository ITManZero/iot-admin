<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Ite\IotCore\Context\UserActivityContext;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'Auth'], function () {

    Route::post('register', [RegisterController::class, 'register']);


    Route::get('index', function (UserActivityContext $context) {
        $context->hasUser(1);
        return $context->getUsersActivities();
    });


    Route::post('login', [LoginController::class, 'login']);

    Route::get('logout', [LoginController::class, 'logout']);
});
