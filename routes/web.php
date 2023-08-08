<?php

use App\Http\Controllers\accountController;
use App\Models\account;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('form');
});

Route::POST('/lang/submit',[accountController::class,'checkUserName']);
Route::POST('/submit',[accountController::class,'checkUserName']);
Route::POST('/add',[accountController::class, 'submit']);
Route::GET('/samedate/{month}/{day}',[accountController::class,'sameDate']);

Route::GET('/arabic',[accountController::class , 'setArabic']);
Route::GET('/english',[accountController::class , 'setEnglish']);
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => accountController::class.'@switchLanguage']);
