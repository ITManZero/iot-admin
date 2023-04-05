<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Ite\IotCore\Builders\UserActivityBuilder;
use Ite\IotCore\Context\UserActivityContext;
use Ite\IotCore\Services\MessagingService;
use PhpAmqpLib\Message\AMQPMessage;

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


    Route::get('publish', function (MessagingService $messagingService) {

        $data = (new UserActivityBuilder())
            ->setId(1)
            ->setAction("blocked")
            ->setIsAdmin(true)
            ->setMessage("Please block this user")
            ->setName("Bakr Mslmani")
            ->build();

        $messagingService->publish("user-activity", "blocked", $data);

        return new Response("Success");
    });


    Route::post('login', [LoginController::class, 'login']);

    Route::get('logout', [LoginController::class, 'logout']);
});
