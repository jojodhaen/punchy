<?php

namespace App\Http\Controllers\API\WorkedHours;

use App\Http\Controllers\Controller;
use App\Models\ClockTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetWeeklyWorkedHoursController extends Controller
{
    public function __invoke(Request $request, string $date)
    {
        foreach (range(0, 6) as $i) {
            $weekDates[$i] = Carbon::create($date)
                ->addDays($i)
                ->timezone('Europe/Brussels');
        }

        return collect($weekDates)->map(function ($weekDate) {
            $clocktime = ClockTime::firstOrCreate([
                'date' => $weekDate->format('Y-m-d'),
                'user_id' => Auth::id(),
            ]);

            $worked_minutes = Carbon::createFromFormat('H:i:s', $clocktime->start_time ?? '00:00:00')
                ->diffInMinutes(Carbon::createFromFormat('H:i:s', $clocktime->end_time ?? '00:00:00'));


            // TODO: Save the break minutes in the database, when the info is final
            if ($weekDate->isWeekend()) {
                $break_minutes = $worked_minutes >= 300 ? 45 : 30;
            } else {
                $break_minutes = $worked_minutes >= 300 ? 60 : 30;
            }

            return collect([
                "date" => $clocktime->date,
                "start_time" => $clocktime->start_time,
                "end_time" => $clocktime->end_time,
                "worked_hours" => Carbon::createFromFormat('H:i:s', '00:00:00')
                    ->addMinutes($worked_minutes)
                    ->format('H:i'),
                "break_minutes" => $break_minutes,
            ]);
        });

    }
}
