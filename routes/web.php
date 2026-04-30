<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Models\User;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[UserController::class,'MtdHome'])->name('NmHome');
Route::post('/registerbtn',[UserController::class,'MtdRegisterBtn'])->name('NmRegisterBtn'); // Register form Btn clicked By User


