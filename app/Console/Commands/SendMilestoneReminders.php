<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Milestone;
use App\Models\Admin;
use App\Notifications\MilestoneReminder;
use Carbon\Carbon;

class SendMilestoneReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-milestone-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email reminders for milestones to the admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting milestone reminder process...');

        // Get the admin user
        $admin = Admin::first(); // Assuming a single admin
        if (!$admin) {
            $this->error('No admin found. Exiting...');
            return;
        }

        // Fetch milestones with a forecasting date within the next 5 days
        $milestones = Milestone::where('forecasting_date', '>=', Carbon::now()->startOfDay())
            ->where('forecasting_date', '<=', Carbon::now()->addDays(5)->endOfDay())
            ->get();
            $this->info("Fetched milestones: " . $milestones->count());

        foreach ($milestones as $milestone) {
            $milestoneDate = Carbon::parse($milestone->forecasting_date);
            $currentDate = Carbon::now();
        
            $daysToForecasting = $currentDate->startOfDay()->diffInDays($milestoneDate->startOfDay(), false);
        
            $this->info("Milestone: {$milestone->milestone_name} - Forecasting Date: {$milestoneDate} - Days to forecasting: $daysToForecasting");
        
            if (in_array($daysToForecasting, [5, 3, 1])) {
                $details = [
                    'subject' => "Reminder: {$milestone->milestone_name} Due Soon",
                    'message' => "The milestone '{$milestone->milestone_name}' is scheduled for {$milestoneDate->toFormattedDateString()}. Please review it.",
                    'actionText' => 'View Milestone',
                    'actionURL' => url("/admin/projects/index"),
                ];
        
                $admin->notify(new MilestoneReminder($details));
                $this->info("Reminder sent to {$admin->email} for milestone: {$milestone->milestone_name}");
            } else {
                $this->info("No reminders sent for milestone: {$milestone->milestone_name}");
            }
        }
               

        $this->info('Milestone reminder process completed.');
    }

}
