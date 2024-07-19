<?php

namespace App\Http\Controllers\API\ClockTimes;

use App\Http\Controllers\Controller;
use App\Models\ClockTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetWeeklyClockTimesController extends Controller
{
    public function __invoke(Request $request)
    {
        $clocktimes = $request->validate([
            'date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
        ]);

        ClockTime::updateOrCreate([
            'date' => Carbon::create($clocktimes['date'])->timezone('Europe/Brussels'),
            'user_id' => Auth::id(),
        ], [
            'start_time' => $clocktimes['start_time'],
            'end_time' => $clocktimes['end_time'],
        ]);


        return response()->json(['message' => 'Clock time(s) saved']);
    }
}
