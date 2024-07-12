<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ClockTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetWeeklyClockTimesController extends Controller
{
    public function __invoke(Request $request, string $date)
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
}
