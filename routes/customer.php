<?php
/* create a new route file in RouteServiceProvider.php */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\NotificationManageController; // new pr 14-8-25

Route::prefix('customer')->name('customer.')->group(function () {
    /* the login from is in resources\views\auth\login.blade.php */
    /* if resources is already login then not access login page again AuthenticatedSessionController.php - pranav new 5-8-25 */
    Route::post('/login', [CustomerController::class, 'login'])->name('login');

    Route::middleware('auth:customer')->group(function (){
        
        Route::get('/dashboard',function(){
            return view('customer.dashboard');
        })->name('dashboard');

        Route::get('/profile',[CustomerController::class,'show'])->name('profiles'); // new pr 7-8-25
        /* use Auth::id(); to update the details. */
        Route::patch('/profile/update',[CustomerController::class,'update'])->name('update'); // new pr 7-8-25
        Route::post('/logout', [CustomerController::class, 'logout'])->name('logout'); // new pr 7-8-25

        /* project index use full admin controller. */
        Route::get('projects/index', [ProjectController::class, 'resIndex'])->name('projects.index'); // new pr 8-8-25
        Route::get('/projects/filter', [ProjectController::class, 'pmFilter'])->name('projects.filter'); // new pr 11-8-25

        /* invoice list make different function use admin controller */
        Route::get('/invoice/index',[InvoiceController::class,'cusIndex'])->name('invoice.index'); // new pr 8-8-25
        Route::get('/invoice/filter', [InvoiceController::class, 'cusFetchInvoices'])->name('invoice.filter'); // new pr 8-8-25
        Route::get('/invoiceview/{id}',[InvoiceController::class, 'invoiceview']); // new pr 8-8-25
    
        /* make notification when invoice generated in customer -pr */
        Route::post('/mark-as-read',[NotificationManageController::class,'markNotification'])->name('markNotification'); // new pr 14-8-25
        Route::get('/view-all-notification',[NotificationManageController::class,'viewNotification'])->name('viewNotification'); // new pr 14-8-25
    });

});
