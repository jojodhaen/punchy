<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ClockTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkedHoursController extends Controller
{
    public function getWeeklyWorkedHours(Request $request, string $date)
    {
        foreach (range(0, 6) as $i) {
            $weekDates[$i] = Carbon::create($date)
                ->addDays($i)
                ->timezone('Europe/Brussels');
        }

        $settings = Auth::user()->settings;
        $totalWorkedHoursWithoutBreak = 0;
        $totalWorkedHoursWithBreak = 0;

        $workedHours = collect($weekDates)->map(function ($weekDate) use (
            $settings,
            &$totalWorkedHoursWithBreak,
            &$totalWorkedHoursWithoutBreak,
        ) {
            $clocktimes = ClockTime::firstOrCreate([
                'date' => $weekDate->format('Y-m-d'),
                'user_id' => Auth::id(),
            ]);

            $workedMinutes = Carbon::createFromFormat('H:i:s', $clocktimes->start_time)
                ->diffInMinutes(Carbon::createFromFormat('H:i:s', $clocktimes->end_time));

            if ($weekDate->isWeekend() && $settings->min_break_hours_weekend) {
                if ($workedMinutes < $settings->min_break_hours_weekend * 60) {
                    $breakMinutes = 0;
                } else {
                    if ($settings->max_break_turnover_hours_weekend) {
                        $breakMinutes = $workedMinutes >= $settings->max_break_turnover_hours_weekend * 60
                            ? $settings->max_break_hours_weekend * 60
                            : $settings->min_break_hours_weekend * 60;
                    } else {
                        $breakMinutes = $settings->min_break_hours_weekend * 60;
                    }
                }
            } else {
                if ($workedMinutes < $settings->min_break_hours * 60) {
                    $breakMinutes = 0;
                } else {
                    if ($settings->max_break_turnover_hours) {
                        $breakMinutes = $workedMinutes >= $settings->max_break_turnover_hours * 60
                            ? $settings->max_break_hours * 60
                            : $settings->min_break_hours * 60;
                    } else {
                        $breakMinutes = $settings->min_break_hours * 60;
                    }
                }
            }

            $totalWorkedHoursWithoutBreak += $workedMinutes / 60;
            $totalWorkedHoursWithBreak += ($workedMinutes - $breakMinutes) / 60;

            return collect([
                'date' => $clocktimes->date,
                'start_time' => $clocktimes->start_time,
                'end_time' => $clocktimes->end_time,
                'worked_hours_without_breaks' => $workedMinutes / 60,
                'worked_hours_with_breaks' => ($workedMinutes - $breakMinutes) / 60,
                'break_hours' => $breakMinutes / 60,
            ]);
        });


        return collect([
            'worked_hours' => $workedHours,
            'total_worked_hours_without_breaks' => $totalWorkedHoursWithoutBreak,
            'total_worked_hours_with_breaks' => $totalWorkedHoursWithBreak,
            'overtime' => $totalWorkedHoursWithBreak - $settings->weekly_hours,
        ]);
    }

    public function getWeeklyOvertime()
    {
        return response()->json(['message' => 'getWeeklyOvertime']);
    }
}
