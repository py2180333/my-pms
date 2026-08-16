<?php

namespace App\Http\Controllers\Admin;
use App\Models\Leave;
use App\Models\LeaveDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;// pr
use App\Notifications\LeaveNotification; // new pr 26-8-25
use App\Models\Resource; // new pr 26-8-25
use App\Models\Admin; // new pr 26-8-25
use Illuminate\Support\Facades\Validator; // new pr 7-10-25
use Carbon\CarbonPeriod; // new pr 8-10-25

class LeaveController extends Controller
{
    public function create()
    {
        // pr add 3-10-25
        $created = Auth::user()->created_at;

        $min = $created->isCurrentYear()
            ? $created->startOfMonth()->toDateString()
            : now()->startOfYear()->toDateString();

        $max = now()->addYear()->endOfYear()->toDateString();
        // /pr add 3-10-25
        return view('resource.leaves', compact('min', 'max'));
    }

    public function calendarData(Request $request)
    {
        $leaves = Leave::with('leaveDetails')
            ->where('resource_id', Auth::id())
            ->get();

        $events = [];

        foreach ($leaves as $leave) {
            foreach ($leave->leaveDetails as $detail) {
                $start = \Carbon\Carbon::parse($detail->start_date);
                $end = \Carbon\Carbon::parse($detail->end_date);

                $statusColor = match($leave->status) {
                    'approved' => 'green',
                    'pending' => 'orange',
                    default => 'red',
                };

                for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
                    $events[] = [
                        'title' => ucfirst($detail->leave_duration) . ' - ' . ucfirst($detail->leave_type),
                        'start' => $date->toDateString(),
                        'color' => $statusColor,
                        'textColor' => '#fff',
                    ];
                }
            }
        }

        return response()->json($events);
    }

    private function getColorByStatus($status)
    {
        return match($status) {
            'approved' => 'green',
            'pending' => 'orange',
            'rejected' => 'red',
            default => 'gray',
        };
    }


    // Store a new leave request
    public function store(Request $request)
    {
        $validatordata = $request->validate([
            'resource_id' => 'required|exists:resources,id',
            'reason_for_leave' => 'required|string',
            'leave_details' => 'required|array',
            'leave_details.*.start_date' => 'required|date',
            'leave_details.*.end_date' => 'required|date|after_or_equal:leave_details.*.start_date',
            'leave_details.*.leave_type' => 'required|in:paid,unpaid',
            'leave_details.*.leave_duration' => 'required|in:fullday,halfday',
        ]);

        // Store validated data and proceed with creating leave records
        $leave = Leave::create([
            'resource_id' => $request->resource_id,
            'reason_for_leave' => $request->reason_for_leave,
        ]);

        foreach ($request->leave_details as $detail) {
            $start = \Carbon\Carbon::parse($detail['start_date']);
            $end = \Carbon\Carbon::parse($detail['end_date']);

            //$days = $start->diffInDaysFiltered(fn($date) => !$date->isWeekend(), $end) + 1;
            $days = $start->diffInDays($end) + 1;// pr
            $totalDay = $detail['leave_duration'] === 'halfday' ? 0.5 * $days : $days;
            
            LeaveDetail::create([
                'leave_id' => $leave->id,
                'start_date' => $detail['start_date'],
                'end_date' => $detail['end_date'],
                'leave_type' => $detail['leave_type'],
                'leave_duration' => $detail['leave_duration'],
                'totalday' => $totalDay,
            ]);
        }

        // send leave notification to admin new pr 26-8-25
        $resource = Resource::select('first_name', 'last_name', 'email')
            ->findOrFail($request->resource_id); // new pr 26-8-25
        Admin::first()->notify(new LeaveNotification($resource)); // new pr 26-8-25

        return redirect()->back()->with('success', 'Leave request submitted successfully.');
    }
    
    public function adminPanelleave()
    {
        $leaves = Leave::with(['resource','leaveDetails'])->get();
        foreach ($leaves as $leave) {
            $totalDays = 0;
            $paidDays = 0;
            $unpaidDays = 0;

            foreach ($leave->leaveDetails as $detail) {
                $start = \Carbon\Carbon::parse($detail->start_date);
                $end = \Carbon\Carbon::parse($detail->end_date);
                $dayType = $detail->totalday; 
                $days = $start->diffInDays($end) + 1;

                $totalDays += $days;

                if ($detail->leave_type == 'paid') {
                    $paidDays += $days;
                } elseif ($detail->leave_type == 'unpaid') {
                    $unpaidDays += $days;
                }
            }

            $leave->total_days = $dayType;
            $leave->paid_days = $paidDays;
            $leave->unpaid_days = $unpaidDays;
        }

        // pr
        $resources = Leave::select('resource_id')
            ->with('resource:id,first_name,last_name')
            ->groupBy('resource_id')
            ->get();
        // /pr

        return view('Admin.resource.leaves', compact('leaves','resources'));
    }

    //calendar data for admin side 
    public function calendarJson($id)
    {
        $leave = Leave::with('leaveDetails')->findOrFail($id);

        $events = [];

        foreach ($leave->leaveDetails as $detail) {
            $start = \Carbon\Carbon::parse($detail->start_date);
            $end = \Carbon\Carbon::parse($detail->end_date);
            $statusColor = match ($leave->status) {
                'approved' => 'green',
                'pending' => 'orange',
                default => 'gray',
            };

            for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
                $events[] = [
                    'title' => ucfirst($detail->leave_duration) . ' - ' . ucfirst($detail->leave_type),
                    'start' => $date->toDateString(),
                    'color' => $statusColor,
                    'textColor' => '#fff',
                ];
            }
        }

        return response()->json($events);
    }

    // Approve or reject a leave request (manager action)
    public function updateStatus(Request $request, $id)
    {
        $leave = Leave::findOrFail($id);
        //$this->authorize('update', $leave);  // Ensure manager can update the status
        
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $leave->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Leave status updated.');
    }

    //destory leave by admin 
    public function destroy($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->delete();

        return redirect()->back()->with('success', 'Leave deleted successfully.');
    }
    // // leave every month get day
    // public function checkPaidLeave(Request $request)
    // {
    //     $resourceId = Auth::id();

    //     $resourceCreated = DB::table('resources')->where('id', $resourceId)->value('created_at');
    //     if (!$resourceCreated) {
    //         return response()->json(['error' => 'Resource not found'], 404);
    //     }

    //     $startDate = \Carbon\Carbon::parse($resourceCreated)->startOfMonth();

    //     // 👇 Latest requested date (from frontend)
    //     $latestRequestedDate = $request->input('latest_requested_date');
    //     // 👇 future requested date (from frontend)
    //     $futureRequestedDate = $request->input('future_requested_date'); // pr add 3-10-25
        
    //     $endDate = $latestRequestedDate ? \Carbon\Carbon::parse($latestRequestedDate)->startOfMonth() : now()->startOfMonth();

    //     // ✅ Restrict entitlement to current year only
    //     $startOfYear = \Carbon\Carbon::createFromDate(now()->year, 1, 1)->startOfMonth();
    //     $endOfYear = \Carbon\Carbon::createFromDate(now()->year, 12, 1)->startOfMonth();
        
    //     for($i=0; $i<2; $i++){ // pr add loop 6-10-25
    //         if ($startDate < $startOfYear) {
    //             $startDate = $startOfYear;
    //         }
    //         if ($endDate > $endOfYear) {
    //             $endDate = $endOfYear;
    //         }

    //         // ✅ Count entitled months within current year
    //         $entitled = $startDate->diffInMonths($endDate) + 1;

    //         // ✅ Used paid leaves in current year
    //         $usedPaidLeaves = DB::table('leave_details')
    //             ->join('leaves', 'leave_details.leave_id', '=', 'leaves.id')
    //             ->where('leaves.resource_id', $resourceId)
    //             ->where('leave_details.leave_type', 'paid')
    //             ->where('leaves.status','!=', 'rejected')
    //             // ->whereYear('leave_details.start_date', now()->year) // rd
    //             ->whereYear('leave_details.start_date', $endDate->year) // pr add 3-10-25
    //             ->sum('leave_details.totalday');

    //         $remaining = $entitled - $usedPaidLeaves;

    //         $remaining_array[$i] = $remaining; // pr add 6-10-25

    //         // $futureRequestedDate is not empty // pr add 6-10-25
    //         if(!empty($futureRequestedDate)){
    //             $endDate = Carbon::parse($futureRequestedDate)->startOfMonth();

    //             // ✅ Restrict entitlement to current year only
    //             $startOfYear = \Carbon\Carbon::createFromDate($endDate->year, 1, 1)->startOfMonth();
    //             $endOfYear = \Carbon\Carbon::createFromDate($endDate->year, 12, 1)->startOfMonth();
    //         } else {
    //             break;
    //         }
    //         // /pr add 6-10-25
    //     }

    //     // rd
    //     // return response()->json([
    //     //     'startDate' => $startDate,
    //     //     'endDate' => $endDate,
    //     //     'total_entitled' => $entitled,
    //     //     'used_paid_leaves' => $usedPaidLeaves,
    //     //     'remaining_paid_leaves' => $remaining,
    //     // ]);
    //     // /rd

    //     // pr change 6-10-25
    //     return response()->json([
    //         'remaining_paid_leaves' => $remaining_array[0],
    //         'remaining_future_paid_leaves' => $remaining_array[1] ?? null
    //     ]);
    //     // /pr change 6-10-25
    // }

    // leave every month get day
    public function checkPaidLeave(Request $request)
    {
        /* validate request */
            // pr add 8-10-25
            $validator = Validator::make($request->all(), [
                'rows' => 'required|array|min:1',
                'rows.*.start' => 'required|date',
                'rows.*.end' => 'required|date|after_or_equal:rows.*.start',
                'rows.*.duration' => 'required|in:fullday,halfday'
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()
                ]);
            }

            // retirve validated input
            $validated = $validator->validated();
            // /pr add 8-10-25
        /* /validate request */

        /* restrict the date range */
            $resourceId = Auth::id();

            $resourceCreated = DB::table('resources')->where('id', $resourceId)->value('created_at');
            if (!$resourceCreated) {
                return response()->json([
                    'status' => false,
                    'message' => 'Resource not found'
                ], 404);
            }

            $resourceCreatedDate = \Carbon\Carbon::parse($resourceCreated)->startOfMonth(); // pr change 8-10-25

            $current_year = now()->year; // pr add 8-10-25
            $next_year = now()->year + 1; // pr add 8-10-25

            // ✅ Restrict entitlement to current year only
            $startOfCurrentYear = \Carbon\Carbon::createFromDate($current_year, 1, 1)->startOfMonth(); // pr change 8-10-25
            $endOfNextYear = \Carbon\Carbon::createFromDate($next_year, 12, 31)->endOfMonth(); // pr change 8-10-25

            // pr change 8-10-25
            if ($resourceCreatedDate < $startOfCurrentYear) {
                $minStartDate = $startOfCurrentYear;
            } else {
                $minStartDate = $resourceCreatedDate;
            }
            // /pr change 8-10-25

            $maxEndDate = $endOfNextYear; // pr add 8-10-25
        /* /restrict the date range */

        /* set max leave array for year and month */
            // pr add 9-10-25
            $range = CarbonPeriod::create($minStartDate, '1 month', $maxEndDate);
            $currnt_year_count = 1;
            $next_year_count = 1;
            foreach($range as $date){
                $year = $date->year;
                $month = $date->month;

                if(!isset($maxLeaveMonth[$year][$month])){
                    $maxLeaveMonth[$year][$month] = 0;
                }

                if(now()->year === $year){
                    $maxLeaveMonth[$year][$month] = $currnt_year_count++;
                    $maxLeaveYear[$year] = $currnt_year_count - 1;
                } else {
                    $maxLeaveMonth[$year][$month] = $next_year_count++;
                    $maxLeaveYear[$year] = $next_year_count - 1;
                }

                $requestedLeaveMonth[$year][$month] = 0;
                $requestedLeaveYear[$year] = 0;

                $usedLeaveMonth[$year][$month] = 0;
                $usedLeaveYear[$year] = 0;
            }
            // /pr add 9-10-25
        /* /set max leave array for year and month */

        /* get and set req leave array for year and month */
            // pr add 8-10-25
            // $rows_array = $request->rows;
            $rows_array = $validated['rows'];
            foreach($rows_array as $row){
                $start = Carbon::parse($row['start']);
                $end = Carbon::parse($row['end']);
                $duration = $row['duration'] === 'halfday' ? 0.5 : 1;

                if(($start < $minStartDate) || ($end > $maxEndDate)){
                    return response()->json([
                        'status' => false,
                        'message' => 'you are out of range.'
                    ]);
                    exit();
                }

                $period = CarbonPeriod::create($start, $end);
                foreach($period as $date){
                    $year = $date->year;
                    $month = $date->month;
                    if(!isset($requestedLeaveMonth[$year][$month])){
                        $requestedLeaveMonth[$year][$month] = 0;
                    }
                    $requestedLeaveMonth[$year][$month] += $duration;

                    if(!isset($requestedLeaveYear[$year])){
                        $requestedLeaveYear[$year] = 0;
                    }
                    $requestedLeaveYear[$year] += $duration;
                }
            }
            // /pr add 8-10-25
        /* /get and set req leave array for year and month */

        /* get and set used leave array for year and month */
            // pr add 8-10-25
            $usedPaidLeaves = DB::table('leave_details')
                ->join('leaves', 'leave_details.leave_id', '=', 'leaves.id')
                ->where('leaves.resource_id', $resourceId)
                ->where('leave_details.leave_type', 'paid')
                ->where('leaves.status','!=', 'rejected')
                ->whereBetween('leave_details.start_date', [$minStartDate, $maxEndDate]) // pr add 3-10-25
                ->get(); // pr add 8-10-25

            $rows_array = $usedPaidLeaves;
            foreach($rows_array as $row){
                $start = Carbon::parse($row->start_date);
                $end = Carbon::parse($row->end_date);
                $duration = $row->leave_duration === 'halfday' ? 0.5 : 1;

                if(($start < $minStartDate) || ($end > $maxEndDate)){
                    return response()->json([
                        'status' => false,
                        'message' => 'you are out of range from data base.'
                    ], 404);
                    exit();
                }

                $period = CarbonPeriod::create($start, $end);
                foreach($period as $date){
                    $year = $date->year;
                    $month = $date->month;
                    if(!isset($usedLeaveMonth[$year][$month])){
                        $usedLeaveMonth[$year][$month] = 0;
                    }
                    $usedLeaveMonth[$year][$month] += $duration;

                    if(!isset($usedLeaveYear[$year])){
                        $usedLeaveYear[$year] = 0;
                    }
                    $usedLeaveYear[$year] += $duration;
                }
            }
            // /pr add 8-10-25
        /* /get and set used leave array for year and month */

        /* decide allow or not */
            // pr add 9-10-25
            foreach($maxLeaveYear as $indexYear => $maxYear){
                $amountYear = $maxYear - ($requestedLeaveYear[$indexYear] + $usedLeaveYear[$indexYear]);
                if($amountYear < 0){
                    return response()->json([
                        'status' => false,
                        'message' => 'you are out of range '.$maxYear.' for '.$indexYear.' year.'
                    ]);
                    exit();
                }
            }
            foreach($maxLeaveMonth as $indexYear => $maxYear){
                foreach($maxYear as $indexMonth => $maxMonth){
                    $amountMonth = $maxMonth - ($requestedLeaveMonth[$indexYear][$indexMonth] + $usedLeaveMonth[$indexYear][$indexMonth]);
                    if($amountMonth < 0){
                        return response()->json([
                            'status' => false,
                            'message' => 'you are out of range '.$maxMonth.' for '.$indexYear.' year of '.$indexMonth.' month.'
                        ]);
                        exit();
                    }
                }
            }
            // /pr add 9-10-25
        /* decide allow or not */

        // pr change 9-10-25
        return response()->json(['status' => true]);
        // /pr change 9-10-25
    }


    // pr
    function filter(Request $request){
        try {
            $type = $request->type;
            $startDate = $request->startDate;
            $endDate = $request->endDate;
            $status = $request->status;
            $resourceId = $request->resource_id;

            // Fetch leave based on selected type
            if ($type == 'all' || empty($type)) {
                $typeQuery = Leave::with(['resource','leaveDetails']);
            } else {
                $typeQuery = Leave::with(['resource','leaveDetails'])
                    ->whereHas('leaveDetails', function($query) use ($type){
                        $query->where('leave_type',$type);
                    });
            }

            // Fetch leave based on date
            if (empty($startDate) || empty($endDate)) {
                $dateQuery = $typeQuery;
            } else {
                $dateQuery = $typeQuery->whereHas('leaveDetails', function($query) use ($startDate, $endDate){
                    $query->whereBetween('start_date',[$startDate, $endDate]);
                });
            }

            // Fetch leave based on selected status
            if ($status == 'all' || empty($status)) {
                $statusQuery = $dateQuery;
            } else {
                $statusQuery = $dateQuery->where('status',$status);
            }

            // Fetch leave based on selected status
            if ($resourceId == 'all' || empty($resourceId)) {
                $leaves = $statusQuery->get();
            } else {
                $leaves = $statusQuery->where('resource_id',$resourceId)->get();
            }

            // rd
            foreach ($leaves as $leave) {
                $totalDays = 0;
                $paidDays = 0;
                $unpaidDays = 0;

                foreach ($leave->leaveDetails as $detail) {
                    $numOfDays = $detail->totalday; 

                    $totalDays += $numOfDays;

                    if ($detail->leave_type == 'paid') {
                        $paidDays += $numOfDays;
                    } elseif ($detail->leave_type == 'unpaid') {
                        $unpaidDays += $numOfDays;
                    }
                }

                $leave->total_days = $totalDays;
                $leave->paid_days = $paidDays;
                $leave->unpaid_days = $unpaidDays;
            }
            // /rd

            $totalLeaves = 0;
            $paidLeaves = 0;
            $unpaidLeaves = 0;

            foreach ($leaves as $leave) {

                $totalLeaves += $leave->total_days;
                $paidLeaves += $leave->paid_days;
                $unpaidLeaves += $leave->unpaid_days;
            }

            return response()->json([
                'leaves' => $leaves,
                'totalLeaves' => $totalLeaves,
                'paidLeaves' => $paidLeaves,
                'unpaidLeaves' => $unpaidLeaves,
            ]);
    
        } catch (\Exception $e) {
            \Log::error('Error fetching leave: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}
