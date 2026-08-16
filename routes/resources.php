<?php
/* create a new route file in RouteServiceProvider.php - pranav*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Resource\ResourceController;
use App\Http\Controllers\Resource\HolidayController;
use App\Http\Controllers\Resource\TimesheetController;
use App\Http\Controllers\Resource\ResourceHolidayController;
use App\Http\Controllers\Resource\ResourceAttendanceController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\AdminMilestoneController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\AssignTeamController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\Admin\AssignTaskController;
use App\Http\Controllers\NotificationManageController; // new pr 12-8-25

Route::prefix('resource')->name('resource.')->group(function () {
    /* the login from is in resources\views\auth\login.blade.php */
    /* if resources is already login then not access login page again AuthenticatedSessionController.php - pranav */
    Route::post('/login', [ResourceController::class, 'login'])->name('login');
    Route::middleware('auth:resource')->group(function (){
        Route::get('/dashboard',function(){
            return view('resource.dashboard');
        })->name('dashboard');

        Route::get('/profile',[ResourceController::class,'show'])->name('profiles');
        /* use Auth::id(); to update the details. */
        Route::patch('/profile/update',[ResourceController::class,'update'])->name('update');
        Route::post('/logout', [ResourceController::class, 'logout'])->name('logout');
            
        // Project Manager middleware -pr
        Route::middleware(['role:project_manager'])->group(function () {
            
            //pranav project manager timesheet
            Route::get('/timesheet/project_manager',[TimesheetController::class,'showProjectManager'])->name('timesheet.project_manager.show'); // this is for project manager
            Route::get('/timesheet/sidebar/{id}',[TimesheetController::class,'getSidebarTask']); // get sidebar task data
            Route::get('/timesheet/task/row/{at_id}/{startDate}/{no_of_days}',[TimesheetController::class,'taskRow']); // get sidebar task data in row
            Route::get('/timesheet/{id}/{startDate}/{no_of_days}',[TimesheetController::class,'getTimesheetData']); // timesheet_project_manager.js -pranav
            Route::post('/timesheet/projectManager/store',[TimesheetController::class,'projectManagerStore'])->name('projectManagerStore');
            // bulk edit in timesheet
            Route::get('/timesheet/projectManager/bulkEdit',[TimesheetController::class,'bulkEditShow'])->name('timesheet.projectManager.bulkEdit.show'); // pr
            Route::get('/timesheet/projectManager/bulkEdit/filter/{projectId}/{resourceId}/{week}/{status}',[TimesheetController::class,'bulkEditFilter'])->name('timesheet.projectManager.bulkEdit.filter'); // pr
            Route::put('/timesheet/projectManager/bulkEdit/store',[TimesheetController::class,'bulkEditStore'])->name('timesheet.projectManager.bulkEdit.store'); // pr

            // milestone manage use admin controller - pr
            route::get('/projects/milestonecreate',[AdminMilestoneController::class, 'create'])->name('projects.milestonecreate');
            Route::post('/milestones', [AdminMilestoneController::class, 'store'])->name('milestones.store');
            Route::patch('/projects/milestone/{id}', [AdminMilestoneController::class, 'update'])->name('projects.milestone.update');
            Route::delete('/projects/milestone/{id}/trash', [AdminMilestoneController::class, 'destroy'])->name('projects.milestone.destroy');
            Route::patch('/projects/milestone/doc/{id}',[AdminMilestoneController::class, 'docupload'])->name('projects.milestone.doc.docupload');
            Route::get('/projects/milestone/invoice/{id}', [AdminMilestoneController::class, 'invoice'])->name('projects.milestone.invoice');
            Route::get('/projects/milestone/{id}/trashed', [AdminMilestoneController::class, 'trashed'])->name('projects.milestone.trashed');
            Route::post('/projects/milestone/{id}/restore',[AdminMilestoneController::class, 'restore'])->name('projects.milestone.restore');
            Route::delete('/projects/milestone/{id}/force-delete',[AdminMilestoneController::class, 'forceDelete'])->name('projects.milestone.force.delete');
            Route::get('/projects/{id}/milestones', [AdminMilestoneController::class, 'getMilestones']);

            // project management use admin controller - pr
            // Route::delete('/projects/index/{id}/trash',[ProjectController::class,'destroy'])->name('projects.index.destroy');
            // Route::get('/projects/trash',[ProjectController::class,'trashed'])->name('projects.trash');
            Route::post('/projects/{id}/restore',[ProjectController::class,'restore'])->name('projects.restore');
            Route::patch('/projects/index/{id}', [ProjectController::class, 'pmUpdate'])->name('projects.index.update');
            Route::get('/projects/filter', [ProjectController::class, 'pmFilter'])->name('projects.filter');
            Route::get('/projects/{id}/documents', [ProjectController::class, 'getDocuments']);

            //invoice manage by Project Manager use admin controller - pr
            Route::get('/invoice/pm/create',[InvoiceController::class,'pmCreate'])->name('invoice.pm.create');
            Route::get('/get-company-details/pm/{id}', [InvoiceController::class, 'companyDetails']);
            Route::post('/invoice/pm/preview',[InvoiceController::class,'preview'])->name('invoice.preview');
            Route::post('/invoice/pm/store',[InvoiceController::class,'store'])->name('invoice.pm.store');
            //invoice list by Project Manager use admin controller but all function is different - pr new 31-7-25
            Route::get('/invoice/index',[InvoiceController::class,'pmIndex'])->name('invoice.index');
            Route::get('/invoice/filter', [InvoiceController::class, 'pmFetchInvoices'])->name('invoice.filter'); // new pr 4-8-25
            Route::get('/invoiceview/{id}',[InvoiceController::class, 'invoiceview']); // new pr 5-8-25 change pr 8-8-25 pm to common admin
            Route::get('/invoice/edit/display/{id}',[InvoiceController::class,'pmEditDisplay'])->name('invoice.edit.display'); // new pr 5-8-25
            Route::patch('/invoice/edit/{id}',[InvoiceController::class,'pmEdit'])->name('invoice.edit'); // new pr 5-8-25

            //assignteam in project use admin controller - pr
            Route::get('/projects/assignteam/pm/create',[AssignTeamController::class,'pmCreate'])->name('projects.assignteam.pm.create');
            Route::get('/projects/pm/getAvailableConsultants', [AssignTeamController::class, 'pmgetAvailableConsultants']);
            Route::get('/projects/pm/getAssignedConsultants', [AssignTeamController::class, 'getAssignedConsultants']);
            Route::delete('/assignteam/{id}/softdelete', [AssignTeamController::class, 'softDelete'])->name('assignteam.softdelete');
            Route::post('/projects/assignteam/store',[AssignTeamController::class,'store'])->name('projects.assignteam.store');

            // tasks management based on milestone use admin controller - pr
            Route::patch('/tasks/index/{id}', [TaskController::class, 'update'])->name('tasks.index.update');
            Route::delete('/tasks/{id}/force-delete', [TaskController::class, 'forceDelete'])->name('tasks.force-delete');
            route::get('/tasks/create',[TaskController::class, 'pmCreate'])->name('tasks.create');
            Route::get('/tasks/{projectId}/milestones', [TaskController::class, 'getMilestonesByProject']);
            Route::post('/tasks/store',[TaskController::class, 'store'])->name('tasks.store');
            Route::get('/tasks/filter', [TaskController::class, 'filter'])->name('tasks.filter');
        
            //assign task to resource use admin controller - pr
            Route::get('/assigntask/index',[AssignTaskController::class, 'pmIndex'])->name('assigntask.index');
            Route::patch('/assigntask/index/update/{id}', [AssignTaskController::class, 'update'])->name('assigntask.index.update');
            Route::delete('/delete-assigned-task/{id}', [AssignTaskController::class, 'deleteAssignedTask']);
            Route::get('/assigntask/create',[AssignTaskController::class, 'pmCreate'])->name('assigntask.create');
            Route::get('/get-milestones/{project_id}', [AssignTaskController::class, 'getMilestones'])->name('getMilestones');
            Route::get('/get-tasks/{milestone_id}', [AssignTaskController::class, 'getTasks'])->name('getTasks');
            // Route::get('/get-resources/{project_id}', [AssignTaskController::class, 'getResources']); // rd
            Route::get('/get-resources', [AssignTaskController::class, 'getResources']); // pr change 24-9-25
            Route::get('/get-resources/filter/{project_id}', [AssignTaskController::class, 'getResourcesForFilter']); // pr add 17-10-25
            Route::get('/get-resource-details/{consultant_id}/{role}', [AssignTaskController::class, 'getResourceDetails']); // pr add role 25-9-25
            Route::get('/get-assigned-tasks/{task_id}', [AssignTaskController::class, 'getAssignedTasks']);
            Route::post('/assigntask/store',[AssignTaskController::class, 'store'])->name('assigntask.store');
            Route::get('/assigntask/filter', [AssignTaskController::class, 'pmFilter'])->name('assigntask.filter');
            Route::get('/assigntask/filter/resources', [AssignTaskController::class, 'pmFilterResources'])->name('assigntask.filter.resources');


        });

        // Consultant middleware -pr
        Route::middleware(['role:consultant'])->group(function () {

            //pranav consultant timesheet
            Route::get('/timesheet/consultant',[TimesheetController::class,'show'])->name('timesheet.show'); // this is for consultant
            Route::get('/sidebar_timesheet',[ResourceController::class,'sidebar_timesheet'])->name('sidebar_timesheet'); // sidebar_timesheet.js -pranav
            Route::post('/timesheet/store',[TimesheetController::class,'store'])->name('store');

        });

        // Shared Routes (for both roles project_manager and consultant)
        // project management use admin controller - pr
        Route::get('projects/index', [ProjectController::class, 'resIndex'])->name('projects.index')->middleware(['role:project_manager,consultant']);
        //create tasks based on milestone use admin controller - pr
        Route::get('/tasks/index',[TaskController::class, 'resIndex'])->name('tasks.index')->middleware(['role:project_manager,consultant']);
        // make notification when admin assign to team in resources -pr
        Route::post('/mark-as-read',[NotificationManageController::class,'markNotification'])->name('markNotification')->middleware(['role:project_manager,consultant']); // new pr 12-8-25
        Route::get('/view-all-notification',[NotificationManageController::class,'viewNotification'])->name('viewNotification')->middleware(['role:project_manager,consultant']); // new pr 12-8-25
    });
    
});

// attendance route 
Route::middleware(['auth:resource'])->prefix('resource')->name('resource.attendance.')->group(function () {
    Route::get('/attendance', [ResourceAttendanceController::class, 'index'])->name('index');
    Route::get('/attendance/calendar', [ResourceAttendanceController::class, 'calendar'])->name('calendar');
    Route::post('/checkin', [ResourceAttendanceController::class, 'checkIn'])->name('checkin');
    Route::post('/checkout', [ResourceAttendanceController::class, 'checkOut'])->name('checkout');
    Route::post('/breakin', [ResourceAttendanceController::class, 'startBreak'])->name('breakin');
    Route::post('/breakout', [ResourceAttendanceController::class, 'endBreak'])->name('breakout');

    //leave route develop by digvijay
    Route::get('/leave/check-paid-leave', [LeaveController::class, 'checkPaidLeave'])
     ->name('leave.checkPaidLeave');
    Route::get('/leave', [LeaveController::class, 'create'])->name('create');
    Route::get('/leave/calendar-data', [LeaveController::class, 'calendarData'])->name('leave.calendarData');
    Route::post('/leave/store', [LeaveController::class, 'store'])->name('leave.store');
});

//for admin side
Route::middleware(['auth:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // manage resource addendence 
        Route::patch('/attendance/update/{id}', [ResourceAttendanceController::class, 'adminAtdUpdate'])->name('attendance.update');
        Route::get('/attendance', [ResourceAttendanceController::class, 'adminPanel'])->name('attendance');
        Route::get('/attendance/filter', [ResourceAttendanceController::class, 'adminAttendFilter'])->name('attendance.filter');// pr
        
        //this is for manage resource leaves
        Route::get('/leave', [LeaveController::class, 'adminPanelleave'])->name('leave');
        Route::get('/leaves/calendar-data/{id}', [LeaveController::class, 'calendarJson']);
        Route::put('/leaves/update-status/{id}', [LeaveController::class, 'updateStatus'])->name('leaves.updateStatus');
        Route::delete('/leaves/destroy/{id}', [LeaveController::class, 'destroy'])->name('leaves.destroy');
        Route::get('/leaves/filter', [LeaveController::class, 'filter'])->name('leaves.filter');// pr
    });