<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Project;
use App\Models\Invoice;
use App\Models\Resource;

class DashboardController extends Controller
{
    public function filterPieChart(Request $request)
    {
        try {
            // throw new \Exception('this is test error');
            $companyId = $request->companyId;
            $query = Project::query();

            if($companyId !== 'all' && filled($companyId)){
                $query->where(['company_id' => $companyId]);
            }

            $projects = $query->get();
            
            $planning = $projects->where('status', 'planning')->count();
            $progress = $projects->where('status', 'in_progress')->count();
            $completed = $projects->where('status', 'completed')->count();
            $hold = $projects->where('status', 'hold')->count();

            return response()->json([
                'count' => $projects->count(),
                'planning' => $planning,
                'progress' => $progress,
                'completed' => $completed,
                'hold' => $hold,
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Error fetching pie chart data: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function filterHorizontalBarChart(Request $request)
    {
        try {
            // throw new \Exception('this is test error');
            
            $companies = Company::select('company_name')
                ->withCount('projects')
                ->get();

            $company_name = $companies->pluck('company_name');
            $projects_count = $companies->pluck('projects_count');
            // dd($company_name, $projects_count);
            return response()->json([
                'company_name' => $company_name,
                'projects_count' => $projects_count,
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Error fetching Horizontal Bar Chart data: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function filterPieChartInvoice(Request $request)
    {
        try {
            // throw new \Exception('this is test error');
            $companyId = $request->companyId;
            $query = Invoice::query();

            if($companyId !== 'all' && filled($companyId)){
                $query->where(['company_id' => $companyId]);
            }

            $invoices = $query->get();

            $paid = $invoices->where('status', 'paid')->count();
            $pending = $invoices->where('status', 'pending')->count();
            $overdue = $invoices->where('status', 'overdue')->count();

            return response()->json([
                'count' => $invoices->count(),
                'paid' => $paid,
                'pending' => $pending,
                'overdue' => $overdue,
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Error fetching pie chart invoice data: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function filterPieChartResource(Request $request)
    {
        try {
            // throw new \Exception('this is test error');
            $companyId = $request->companyId;
            $queryActive = Resource::query()->where('status', 'active');
            $queryInactive = Resource::query()->where('status', 'inactive');

            if($companyId !== 'all' && filled($companyId)){
                $queryActive->whereHas('ResourceCompany', function ($q) use ($companyId) {
                    $q->where('companies.id', $companyId);
                });

                $queryInactive->whereHas('ResourceCompany', function ($q) use ($companyId) {
                    $q->where('companies.id', $companyId);
                });
            }

            $resourceActive = $queryActive->get();
            $resourceInactive = $queryInactive->get();

            $active = [];
            $inactive = [];
            $roles = [
                'consultant',
                'senior_consultant',
                'team_lead',
                'senior_team_lead',
                'project_manager',
                'senior_project_manager',
                'program_manager',
                'senior_program_manager',
                'vice_president',
                'director',
                'ceo'
            ];

            foreach($roles as $role){
                $active[$role] = $resourceActive->where('role', $role)->count();
                $inactive[$role] = $resourceInactive->where('role', $role)->count();
            }

            return response()->json([
                'count' => $resourceActive->count() + $resourceInactive->count(),
                'countActive' => $resourceActive->count(),
                'countInactive' => $resourceInactive->count(),
                'active' => $active,
                'inactive' => $inactive,
            ], 200);

        } catch (\Exception $e) {
            \Log::error('Error fetching pie chart resource data: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'. $e->getMessage()], 500);
        }
    }
}
