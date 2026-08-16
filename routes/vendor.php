<?php
/* create a new route file in RouteServiceProvider.php */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\VendorController;

Route::prefix('vendor')->name('vendor.')->group(function () {
    /* the login from is in resources\views\auth\login.blade.php */
    /* if resources is already login then not access login page again AuthenticatedSessionController.php - pranav */
    Route::post('/login', [VendorController::class, 'login'])->name('login');

    Route::middleware('auth:vendor')->group(function (){
        
        Route::get('/dashboard',function(){
            return view('vendor.dashboard');
        })->name('dashboard');

        Route::get('/profile',[VendorController::class,'show'])->name('profiles'); // new pr 7-8-25
        /* use Auth::id(); to update the details. */
        Route::patch('/profile/update',[VendorController::class,'update'])->name('update'); // new pr 7-8-25
        Route::post('/logout', [VendorController::class, 'logout'])->name('logout'); // new pr 7-8-25
        
    });

});