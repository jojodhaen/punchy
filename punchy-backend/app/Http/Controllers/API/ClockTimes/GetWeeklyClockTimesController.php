<?php

namespace App\Http\Controllers\API\ClockTimes;

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


// 7 + 6.5 + 8.5 + 8.5 + 8 = 17 + 15 + 6.5 = 38.5
// 1 + 1 + 1 + 1 + 0.75 = 4.75
// 34.5 - 4.75 = 29.75
// 0.25 + 0.25 + 0.25 + 0.25 + 0.25 = 1.25
// 34.5 - 1.25 = 33.25

// 33:75

// 8.5 + 8.5 + 8.5 + 8.5 = 34
