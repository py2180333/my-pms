<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Assigntask;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer('resource.sidebar', function ($view) {
            $assignedTasks = [];

            if (Auth::guard('resource')->check() && Auth::guard('resource')->user()->role === 'consultant') {
                $consultant = Auth::guard('resource')->user();

                $assignedTasks = Assigntask::with(['task', 'project', 'milestone'])
                    ->where('consultant_id', $consultant->id)
                    ->get();
            }

            $view->with('assignedTasks', $assignedTasks);
        });
    }
}
