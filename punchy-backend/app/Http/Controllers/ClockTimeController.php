<?php

namespace App\Http\Controllers;

use App\Models\ClockTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClockTimeController extends Controller
{
    public function getClockTimes(Request $request, string $date)
    {
        foreach (range(0, 6) as $i) {
            $weekDates[$i] = Carbon::create($date)
                ->addDays($i)
                ->timezone('Europe/Brussels')
                ->format('Y-m-d');
        }

        return collect($weekDates)->map(function ($weekDate) {
            $clocktime = ClockTime::firstOrCreate([
                'date' => $weekDate,
                'user_id' => Auth::id(),
            ]);
            return collect([
                "date" => $clocktime->date,
                "start_time" => $clocktime->start_time,
                "end_time" => $clocktime->end_time,
            ]);
        });
    }

    public function setClockTime(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
        ]);

        ClockTime::updateOrCreate([
            'date' => Carbon::create($request->date)->timezone('Europe/Brussels'),
            'user_id' => Auth::id(),
        ], [
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return response()->json(['message' => 'Clock time saved']);


    }

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
                $workedHours += Carbon::createFromFormat('H:i:s', $clockTime->start_time)->diffInMinutes(Carbon::createFromFormat('H:i:s', $clockTime->end_time)) / 60;
            }
        }

        return response()->json(['worked_hours' => $workedHours]);
    }
}
