<?php

use App\Services\Mailers\Mailer;
use App\Services\MailService;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (){
    $obj = new MailService(new Mailer());
    $obj->sendMail('996708068599','Text message','test');
});
