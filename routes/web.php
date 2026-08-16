<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminVendorController;
use App\Http\Controllers\Admin\AdminProjectManagerController;
use App\Http\Controllers\Admin\AdminResourceController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\AssignTeamController;
use App\Http\Controllers\Admin\AdminMilestoneController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\AssignTaskController;
use App\Http\Controllers\Admin\AdminCompanyController;
use App\Http\Controllers\Admin\InvoiceController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Dashboard\DashboardController; // pr
use App\Http\Controllers\Resource\TimesheetController; // pr
use App\Http\Controllers\NotificationManageController; // new pr 26-8-25


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

Route::get('/test-email', function () {
    $email = 'rajputdigvijay.qt@gmail.com'; // Replace with your testing email
    Mail::raw('This is a test email from Laravel', function ($message) use ($email) {
        $message->to($email)
                ->subject('Test Email');
    });
    return 'Test email sent!';
});

// Grouped routes for admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Show login form
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('showlogin');

    // Handle login submission
    Route::post('/login', [AdminController::class, 'login'])->name('login');

    // Protected routes
    Route::middleware('auth:admin')->group(function () {
        // admin profile
        Route::get('/profile',[AdminController::class,'show'])->name('profiles'); // new pr 11-8-25
        Route::patch('/profile/update',[AdminController::class,'update'])->name('update'); // new pr 11-8-25

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard'); // rd
        Route::get('/dashboard/filter/piechart', [DashboardController::class, 'filterPieChart'])->name('dashboard.filter.piechart'); // pr
        Route::get('/dashboard/filter/piechart/invoice', [DashboardController::class, 'filterPieChartInvoice']); // new -pr 25-7-25
        Route::get('/dashboard/filter/piechart/resource', [DashboardController::class, 'filterPieChartResource']); // new -pr 28-7-25
        Route::get('/dashboard/filter/horizontalbarchart', [DashboardController::class, 'filterHorizontalBarChart'])->name('dashboard.filter.horizontalbarchart'); // pr
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
        //customer crud by admin
        Route::get('/users/customers/create', [AdminCustomerController::class, 'create'])->name('users.customers.create');
        Route::post('/users/customers/store', [AdminCustomerController::class, 'store'])->name('users.customers.store');
        Route::get('/users/customers/index',[AdminCustomerController::class, 'index'])->name('users.customers.index');
        Route::get('/customers/filter', [AdminCustomerController::class, 'filter'])->name('customers.filter');

        Route::delete('/users/customers/{id}/trash', [AdminCustomerController::class, 'destroy'])->name('users.customers.destroy');
        Route::get('/users/customers/trash', [AdminCustomerController::class, 'trashed'])->name('users.customers.trash');
        Route::post('/users/customers/{id}/restore', [AdminCustomerController::class, 'restore'])->name('users.customers.restore');
        Route::delete('/users/customers/{id}/force-delete', [AdminCustomerController::class, 'forceDelete'])->name('users.customers.force-delete');
        Route::get('/users/customers/index/{id}', [AdminCustomerController::class, 'show'])->name('users.customers.index.show');
        Route::patch('/users/customers/index/{id}', [AdminCustomerController::class, 'update'])->name('users.customers.index.update');
        Route::get('/users/customers/index/{id}/edit', [AdminCustomerController::class, 'edit'])->name('users.customers.index.edit');
        //vendor crud by admin
        route::get('/users/vendors/create',[AdminVendorController::class,'create'])->name('users.vendors.create');
        Route::post('/users/vendors/store', [AdminVendorController::class, 'store'])->name('users.vendors.store');
        Route::get('/users/vendors/index',[AdminVendorController::class, 'index'])->name('users.vendors.index');
        Route::get('/users/vendors/index/{id}', [AdminVendorController::class, 'show'])->name('users.vendors.index.show');
        Route::delete('/users/vendors/{id}/trash', [AdminVendorController::class, 'destroy'])->name('users.vendors.destroy');
        Route::get('/users/vendors/trash', [AdminVendorController::class, 'trashed'])->name('users.vendors.trash');
        Route::delete('/users/vendors/{id}/force-delete', [AdminVendorController::class, 'forceDelete'])->name('users.vendors.force-delete');
        Route::post('/users/vendors/{id}/restore', [AdminVendorController::class, 'restore'])->name('users.vendors.restore');
        Route::get('/users/vendors/index/{id}/edit', [AdminVendorController::class, 'edit'])->name('users.vendors.index.edit');
        Route::patch('/users/vendors/index/{id}', [AdminVendorController::class, 'update'])->name('users.vendors.index.update');
        Route::get('/vendors/filter', [AdminVendorController::class, 'filter'])->name('vendors.filter');//pr
        //ProjectManager crud by admin
        route::get('/users/ProjectManager/create',[AdminProjectManagerController::class, 'create'])->name('users.ProjectManager.create');
        route::post('/users/ProjectManager/store',[AdminProjectManagerController::class, 'store'])->name('users.ProjectManager.store');
        Route::get('/users/ProjectManager/index',[AdminProjectManagerController::class, 'index'])->name('users.ProjectManager.index');
        Route::delete('/users/ProjectManager/{id}/trash', [AdminProjectManagerController::class, 'destroy'])->name('users.ProjectManager.destroy');
        Route::get('/users/ProjectManager/trash', [AdminProjectManagerController::class, 'trashed'])->name('users.ProjectManager.trash');
        Route::delete('/users/ProjectManager/{id}/force-delete', [AdminProjectManagerController::class, 'forceDelete'])->name('users.ProjectManager.force-delete');
        Route::post('/users/ProjectManager/{id}/restore', [AdminProjectManagerController::class, 'restore'])->name('users.ProjectManager.restore');
        Route::get('/users/ProjectManager/index/{id}', [AdminProjectManagerController::class, 'show'])->name('users.ProjectManager.index.show');
        Route::get('/users/ProjectManager/index/{id}/edit', [AdminProjectManagerController::class, 'edit'])->name('users.ProjectManager.index.edit');
        Route::patch('/users/ProjectManager/index/{id}', [AdminProjectManagerController::class, 'update'])->name('users.ProjectManager.index.update');
        //Resources crud by admin
        Route::get('/users/Resources/index',[AdminResourceController::class, 'index'])->name('users.Resources.index');
        route::get('/users/Resources/create',[AdminResourceController::class, 'create'])->name('users.Resources.create');
        route::post('/users/Resources/store',[AdminResourceController::class, 'store'])->name('users.Resources.store');
        Route::delete('/users/Resources/{id}/trash', [AdminResourceController::class, 'destroy'])->name('users.Resources.destroy');
        Route::get('/users/Resources/trash', [AdminResourceController::class, 'trashed'])->name('users.Resources.trash');
        Route::delete('/users/Resources/{id}/force-delete', [AdminResourceController::class, 'forceDelete'])->name('users.Resources.force-delete');
        Route::post('/users/Resources/{id}/restore', [AdminResourceController::class, 'restore'])->name('users.Resources.restore');
        Route::get('/users/Resources/index/{id}', [AdminResourceController::class, 'show'])->name('users.Resources.index.show');
        Route::get('/users/Resources/index/{id}/edit', [AdminResourceController::class, 'edit'])->name('users.Resources.index.edit');
        Route::patch('/users/Resources/index/{id}', [AdminResourceController::class, 'update'])->name('users.Resources.index.update');
        Route::get('/Resources/filter', [AdminResourceController::class, 'filter'])->name('Resources.filter');//pr
        
        //projects manage
        Route::get('projects/index', [ProjectController::class, 'index'])->name('projects.index');
        Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('projects/store', [ProjectController::class, 'store'])->name('projects.store');
        Route::get('/projects/{id}/documents', [ProjectController::class, 'getDocuments']);
        Route::patch('/projects/index/{id}', [ProjectController::class, 'update'])->name('projects.index.update');
        Route::delete('/projects/index/{id}/trash',[ProjectController::class,'destroy'])->name('projects.index.destroy');
        Route::get('/projects/trash',[ProjectController::class,'trashed'])->name('projects.trash');
        Route::post('/projects/{id}/restore',[ProjectController::class,'restore'])->name('projects.restore');
        Route::get('/getcustomersandvendors', [ProjectController::class, 'getCusNVndByCompany'])->name('getcusandvnd');
        Route::get('/projects/filter', [ProjectController::class, 'filter'])->name('projects.filter');//pr
        Route::get('/getCusByCompany', [ProjectController::class, 'getCusByCompany'])->name('getcus');//pr

        //assignteam in project
        Route::get('/projects/assignteam/create',[AssignTeamController::class,'create'])->name('projects.assignteam.create');
        Route::post('/projects/assignteam/store',[AssignTeamController::class,'store'])->name('projects.assignteam.store');
        Route::get('/projects/getAvailableConsultants', [AssignTeamController::class, 'getAvailableConsultants']);
        Route::get('/projects/getAssignedConsultants', [AssignTeamController::class, 'getAssignedConsultants']);
        Route::delete('/assignteam/{id}/softdelete', [AssignTeamController::class, 'softDelete'])->name('admin.assignteam.softdelete');

        //milestone manage
        route::get('/projects/milestonecreate',[AdminMilestoneController::class, 'create'])->name('projects.milestonecreate');
        Route::get('/projects/{id}/milestones', [AdminMilestoneController::class, 'getMilestones']);
        Route::post('/milestones', [AdminMilestoneController::class, 'store'])->name('milestones.store');
        Route::patch('/projects/milestone/{id}', [AdminMilestoneController::class, 'update'])->name('projects.milestone.update');
        Route::patch('/projects/milestone/doc/{id}',[AdminMilestoneController::class, 'docupload'])->name('projects.milestone.doc.docupload');
        Route::delete('/projects/milestone/{id}/trash', [AdminMilestoneController::class, 'destroy'])->name('projects.milestone.destroy');
        Route::get('/projects/milestone/invoice/{id}', [AdminMilestoneController::class, 'invoice'])->name('projects.milestone.invoice');
        Route::get('/projects/milestone/{id}/trashed', [AdminMilestoneController::class, 'trashed'])->name('projects.milestone.trashed'); // pr
        Route::post('/projects/milestone/{id}/restore',[AdminMilestoneController::class,'restore'])->name('projects.milestone.restore'); // pr
        Route::delete('/projects/milestone/{id}/force-delete',[AdminMilestoneController::class,'forceDelete'])->name('projects.milestone.force.delete'); // pr


        //create tasks based on milestone
        Route::get('/tasks/index',[TaskController::class, 'index'])->name('tasks.index');
        route::get('/tasks/create',[TaskController::class, 'create'])->name('tasks.create');
        Route::get('/tasks/{projectId}/milestones', [TaskController::class, 'getMilestonesByProject']);
        Route::post('/tasks/store',[TaskController::class, 'store'])->name('tasks.store');
        Route::patch('/tasks/index/{id}', [TaskController::class, 'update'])->name('tasks.index.update');
        Route::delete('/tasks/{id}/force-delete', [TaskController::class, 'forceDelete'])->name('tasks.force-delete');
        Route::get('/tasks/filter', [TaskController::class, 'filter'])->name('tasks.filter');//pr


        //assign task to resource
        Route::get('/assigntask/index',[AssignTaskController::class, 'index'])->name('assigntask.index');
        Route::get('/assigntask/create',[AssignTaskController::class, 'create'])->name('assigntask.create');
        Route::get('/get-milestones/{project_id}', [AssignTaskController::class, 'getMilestones'])->name('getMilestones');
        Route::get('/get-tasks/{milestone_id}', [AssignTaskController::class, 'getTasks'])->name('getTasks');
        // Route::get('/get-resources/{project_id}', [AssignTaskController::class, 'getResources']); // rd
        Route::get('/get-resources', [AssignTaskController::class, 'getResources']); // pr change 24-9-25
        Route::get('/get-resources/filter/{project_id}', [AssignTaskController::class, 'getResourcesForFilter']); // pr add 17-10-25
        Route::get('/get-resource-details/{consultant_id}/{role}', [AssignTaskController::class, 'getResourceDetails']); // pr add role 25-9-25
        Route::post('/assigntask/store',[AssignTaskController::class, 'store'])->name('assigntask.store');
        Route::get('/get-assigned-tasks/{task_id}', [AssignTaskController::class, 'getAssignedTasks']);
        Route::delete('/delete-assigned-task/{id}', [AssignTaskController::class, 'deleteAssignedTask']);
        Route::patch('/assigntask/index/update/{id}', [AssignTaskController::class, 'update'])->name('assigntask.index.update'); // pranav
        Route::get('/assigntask/filter', [AssignTaskController::class, 'filter'])->name('assigntask.filter');//pr
        Route::get('/assigntask/filter/resources', [AssignTaskController::class, 'filterResources'])->name('assigntask.filter.resources');//pr

        //company manage by admin
        Route::get('/company/index',[AdminCompanyController::class,'index'])->name('company.index');
        Route::get('/company/create',[AdminCompanyController::class,'create'])->name('company.create');
        Route::post('/company/store',[AdminCompanyController::class,'store'])->name('company.store');
        Route::post('/company/update/{id}',[AdminCompanyController::class,'update'])->name('company.update');
        Route::delete('/company/delete/{id}',[AdminCompanyController::class,'delete'])->name('company.delete');

        //invoice manage by Admin
        Route::get('/invoice/create',[InvoiceController::class,'create'])->name('invoice.create');
        Route::get('/get-company-details/{id}', [InvoiceController::class, 'companyDetails']);
        Route::get('/get-customer-details/{id}', [InvoiceController::class, 'customerDetails']);
        Route::get('/invoice/index',[InvoiceController::class,'index'])->name('invoice.index');
        Route::get('/invoice/filter', [InvoiceController::class, 'fetchInvoices'])->name('invoice.filter');
        Route::post('/invoice/preview',[InvoiceController::class,'preview'])->name('invoice.preview');
        Route::post('/invoice/store',[InvoiceController::class,'store'])->name('invoice.store');
        Route::get('/getcustomers', [InvoiceController::class, 'getCustomersByCompany'])->name('getcustomers');
        Route::get('/invoiceview/{id}',[InvoiceController::class, 'invoiceview']);
        Route::get('/invoice/edit/display/{id}',[InvoiceController::class,'editDisplay'])->name('invoice.edit.display');
        Route::patch('/invoice/edit/{id}',[InvoiceController::class,'edit'])->name('invoice.edit');
        Route::delete('invoice/delete/{id}',[InvoiceController::class,'delete']);

        // reports -pr
        // timesheetProjectReport
        Route::get('/reports/timesheet/project',[TimesheetController::class,'timesheetProjectReport'])->name('reports.timesheet.project');// new -pr 7-7-25
        Route::get('/reports/get-project-by-company',[TimesheetController::class,'getProjectForProjectReport']);// new -pr 8-7-25
        Route::get('/reports/get-resource-by-project',[TimesheetController::class,'getResourceForProjectReport']);// new -pr 8-7-25
        Route::get('/reports/get-timesheet-project-report',[TimesheetController::class,'getTimesheetProjectReport']);// new -pr 9-7-25
        // timesheetResourceReport
        Route::get('/reports/timesheet/resource',[TimesheetController::class,'timesheetResourceReport'])->name('reports.timesheet.resource');// new -pr 7-7-25
        Route::get('/reports/get-resource-by-company',[TimesheetController::class,'getResourceForResourceReport']);// new -pr 11-7-25
        Route::get('/reports/get-project-by-resource',[TimesheetController::class,'getProjectForResourceReport']);// new -pr 11-7-25
        Route::get('/reports/get-timesheet-resource-report',[TimesheetController::class,'getTimesheetResourceReport']);// new -pr 11-7-25
        // timesheetProjectReport
        Route::get('/reports/timesheet/company',[TimesheetController::class,'timesheetCompanyReport'])->name('reports.timesheet.company');// new -pr 24-7-25
        Route::get('/reports/get-timesheet-company-report',[TimesheetController::class,'getTimesheetCompanyReport']);// new -pr 24-7-25

        /* make notification when leave is submitted in admin -pr */
        Route::post('/mark-as-read',[NotificationManageController::class,'markNotification'])->name('markNotification'); // new pr 26-8-25
        Route::get('/view-all-notification',[NotificationManageController::class,'adminViewNotification'])->name('viewNotification'); // new pr 26-8-25

    });
});


Route::get('/', ['as' => 'home', function () {
    return view('welcome');
}]);
Route::prefix('resource')->name('resource.')->group(function () {
    Route::post('/login', [AdminResourceController::class, 'login'])->name('login');
    Route::middleware('auth:resource')->group(function (){
        Route::get('/manager/dashboard',function(){
            return view('resource.manager.dashboard');
        });
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
//this is digvijay
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
