<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth; 
use App\Http\Middleware\BunuMiddleware;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('/registerbtnbunu',[UserController::class,'MtdRegisterBtn'])->name('NmRegisterBtn');


Route::get('/userfetch',[UserController::class,'MtdUserFetchBtn'])->name('NmUserFetchBtn');

Route::delete('/userdelete/{id}',[UserController::class,'MtdUserDeleteBtn'])->name('NmUserDeleteBtn');


Route::get('/userfetchsingle/{id}',[UserController::class,'MtdFetchSingle'])->name('NmFetchSingle');


Route::put('/update_user/{id}',[UserController::class,'MtdUpdateBtn'])->name('NmUpdateBtn');


Route::post('/loginbtnbunu',[UserController::class,'MtdLoginBtn'])->name('NmLoginBtn');

   


//=======================Product=========================


   //Product Add/Fetch For login user 
Route::middleware('auth:sanctum')->group(function () {
       Route::post('/addproduct',[UserController::class,'MtdProductBtn'])->name('NmProductBtn');
       Route::get('/productfetch',[UserController::class,'MtdProductFetch'])->name('NmProductFetch');

       Route::get('/productfetchsingle/{id}',[UserController::class,'MtdFetchSingleProduct'])->name('NmFetchSingleProduct');

       Route::post('/logoutuser',[UserController::class,'MtdLogoutUser'])->name('NmLogoutUser');

       Route::delete('/productdelete/{id}',[UserController::class,'MtdDeleteProduct'])->name('NmDeleteProduct');

       Route::post('/updateproduct/{id}',[UserController::class,'MtdProductUpdateBtn'])->name('NmProductUpdateBtn');
});





