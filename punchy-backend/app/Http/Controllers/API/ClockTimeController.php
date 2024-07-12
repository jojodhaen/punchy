<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ClockTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClockTimeController extends Controller
{
    public function getWorkedHours(Request $request, int $weekNumber)
    {
        $clockTimes = ClockTime::where('user_id', Auth::id())
            ->whereBetween('date', [
                now()->startOfYear()->addWeeks($weekNumber - 1),
                now()->startOfYear()->addWeeks($weekNumber)->addDays(6),
            ])
            ->get();

        $workedHours = 0;

        foreach ($clockTimes as $clockTime) {
            if ($clockTime->start_time && $clockTime->end_time) {
                $workedHours += Carbon::createFromFormat('H:i:s',
                        $clockTime->start_time)->diffInMinutes(Carbon::createFromFormat('H:i:s',
                        $clockTime->end_time)) / 60;
            }
        }

        return response()->json(['worked_hours' => $workedHours]);
    }
}
