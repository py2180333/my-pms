<?php
namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ResourceAttendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ResourceAttendanceController extends Controller
{
  
    public function calendar(Request $request)
    {
        $resourceId = auth()->guard('resource')->id();

        $start = $request->input('start');
        $end = $request->input('end');

        $attendances = ResourceAttendance::where('resource_id', $resourceId)
            ->whereBetween('date', [$start, $end])
            ->get();

        $events = [];

        foreach ($attendances as $att) {
            $login = $att->check_in ? Carbon::parse($att->check_in)->format('H:i') : 'NA';
            $logout = $att->check_out ? Carbon::parse($att->check_out)->format('H:i') : 'NA';

            $events[] = [
                'title' => "Login: $login | Logout: $logout",
                'start' => Carbon::parse($att->date)->toDateString(),
                'allDay' => true,
            ];
        }

        return response()->json($events); // Make sure it's a proper JSON response
    }

    public function index(Request $request)
    {
        $resource = Auth::guard('resource')->user();
        $today = now()->toDateString();

        $attendance = ResourceAttendance::firstOrCreate(
            ['resource_id' => $resource->id, 'date' => $today],
            ['status' => 'Present']
        );
        $events = $this->calendar($request);
        //session()->put('break_start_time', null); // used for in-memory break tracking
        return view('resource.attendance', compact('attendance', 'events'));
    }

    public function checkIn()
    {
        $resource = Auth::guard('resource')->user();
        $attendance = ResourceAttendance::where('resource_id', $resource->id)->where('date', now()->toDateString())->first();

        if (!$attendance->check_in) {
            $attendance->check_in = now();
            $attendance->save();
        }

        return back();
    }

    public function startBreak()
    {
        $attendance = ResourceAttendance::where('resource_id', auth()->guard('resource')->id())
            ->whereDate('date', now()->toDateString())
            ->first();

        if ($attendance && !$attendance->current_break_start) {
            $attendance->current_break_start = now();
            $attendance->save();
        }

        return redirect()->route('resource.attendance.index');
    }

    public function endBreak()
    {
        $attendance = ResourceAttendance::where('resource_id', auth()->guard('resource')->id())
            ->whereDate('date', now()->toDateString())
            ->first();

        if (!$attendance || !$attendance->current_break_start) {
            return back()->with('error', 'No break in progress.');
        }

        $breakStart = \Carbon\Carbon::parse($attendance->current_break_start);
        $breakDuration = now()->diffInMinutes($breakStart);

        // 🧪 Check break duration using dd
        // dd([
        //     'Break Start' => $breakStart->toDateTimeString(),
        //     'Now' => now()->toDateTimeString(),
        //     'Duration (minutes)' => $breakDuration
        // ]);

        $attendance->break_minutes += $breakDuration;
        $attendance->current_break_start = null;
        $attendance->save();

        return back()->with('success', 'Break ended.');
    }

    public function checkOut()
    {
        $resource = Auth::guard('resource')->user();
        $attendance = ResourceAttendance::where('resource_id', $resource->id)->where('date', now()->toDateString())->first();

        // true = break start pr add 25-9-25
        if($attendance->current_break_start){
            $breakStart = \Carbon\Carbon::parse($attendance->current_break_start);
            $breakDuration = now()->diffInMinutes($breakStart);

            $attendance->break_minutes += $breakDuration;
            $attendance->current_break_start = null;
            $attendance->save();
        }

        if (!$attendance->check_out) {
            $attendance->check_out = now();
            $attendance->save();
        }

        session()->forget('break_start_time');
        return back();
    }

    public function adminPanel(Request $request)
    {
        $search = $request->input('search');

        // rd
        // $attendances = ResourceAttendance::with('resource')
        //     ->when($search, function ($query, $search) {
        //         $query->whereHas('resource', function ($q) use ($search) {
        //             $q->where('first_name', 'like', "%{$search}%")
        //             ->orWhere('last_name', 'like', "%{$search}%");
        //         })
        //         ->orWhere('date', 'like', "%{$search}%");
        //     })
        //     ->orderBy('date', 'desc')
        //     ->paginate(10)
        //     ->appends(['search' => $search]); // Keeps the search query in pagination links

        // pr
        $attendances = ResourceAttendance::with('resource')->get();

        $attendanceResources = ResourceAttendance::select('resource_id')
            ->with('resource:id,first_name,last_name')
            ->groupBy('resource_id')
            ->get();
        // /pr

        return view('Admin.resource.attendance', compact('attendances', 'search', 'attendanceResources'));
    }
    public function adminAtdUpdate(Request $request, string $id)
    {
        $attendance = ResourceAttendance::findOrFail($id);

        $date = $attendance->date; // Date is already stored per attendance
        $checkIn = $request->input('check_in'); // e.g., "11:53"
        $checkOut = $request->input('check_out'); // e.g., "20:01"

        $attendance->check_in = $checkIn ? Carbon::parse("$date $checkIn") : null;
        $attendance->check_out = $checkOut ? Carbon::parse("$date $checkOut") : null;
        $attendance->break_minutes = $request->input('break_minutes');
        //dd
        //dd($attendance);
        $attendance->save();

        return redirect()->back()->with('success', 'Attendance updated successfully!');
    }

    // pr
    function adminAttendFilter(Request $request){
        try {
            $startDate = $request->startDate;
            $endDate = $request->endDate;
            $resourceId = $request->resource_id;

            // Fetch task based on date
            if (empty($startDate) || empty($endDate)) {
                $dateQuery = ResourceAttendance::select(['id','resource_id','date','check_in','check_out','break_minutes'])
                    ->with('resource:id,first_name,last_name');
            } else {
                $dateQuery = ResourceAttendance::select(['id','resource_id','date','check_in','check_out','break_minutes'])
                    ->with('resource:id,first_name,last_name')
                    ->whereBetween('date', [$startDate, $endDate]);
            }

            // Fetch task based on selected project
            if ($resourceId == 'all' || empty($resourceId)) {
                $attendances = $dateQuery->get();
            } else {
                $attendances = $dateQuery->where('resource_id',$resourceId)->get();
            }

            $workingDays = $attendances->whereNotNull('check_in')->count();

            $totalWorkingHours = 0;
            $totalBreakHours = 0;

            $attendances = $attendances->map(function ($attendance) use (&$totalWorkingHours, &$totalBreakHours){
                $check_in = $attendance->check_in ? Carbon::parse($attendance->check_in)->format('H:i') : 'NA';
                $check_out = $attendance->check_out ? Carbon::parse($attendance->check_out)->format('H:i') : 'NA';

                if(!is_null($attendance->check_in) && !is_null($attendance->check_out)){
                    $checkIn = Carbon::parse($attendance->check_in);
                    $checkOut = Carbon::parse($attendance->check_out);
                    $workingHours = $checkOut->diffInMinutes($checkIn) - $attendance->break_minutes;
                    $totalWorkingHours += $workingHours;
                    $totalBreakHours += $attendance->break_minutes;
                    $formattedWorkingHours = floor($workingHours / 60) . ':' . str_pad($workingHours % 60, 2, '0', STR_PAD_LEFT);
                } else {
                    $formattedWorkingHours = 'NA';
                }

                $attendance->check_in = $check_in;
                $attendance->check_out = $check_out;
                $attendance->working_hours = $formattedWorkingHours;
                return $attendance;
            });

            $formattedTotalWorkingHours = floor($totalWorkingHours / 60) . ':' . str_pad($totalWorkingHours % 60, 2, '0', STR_PAD_LEFT);
            $formattedTotalBreakHours = floor($totalBreakHours / 60) . ':' . str_pad($totalBreakHours % 60, 2, '0', STR_PAD_LEFT);

            return response()->json([
                'attendances' => $attendances,
                'workingDays' => $workingDays,
                'totalWorkigHours' => $formattedTotalWorkingHours,
                'totalBreakHours' => $formattedTotalBreakHours,
            ]);
    
        } catch (\Exception $e) {
            \Log::error('Error fetching attendance: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}
