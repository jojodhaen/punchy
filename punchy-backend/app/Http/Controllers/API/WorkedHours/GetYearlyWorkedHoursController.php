<?php

namespace App\Http\Controllers\API\WorkedHours;

use App\Http\Controllers\Controller;
use App\Models\ClockTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetYearlyWorkedHoursController extends Controller
{
    public function __invoke(Request $request, string $year)
    {
        $worked_minutes = 0;

        ClockTime::where('user_id', Auth::id())
            ->whereYear('date', $year)
            ->get()
            ->each(function ($clocktime) use (&$worked_minutes) {
                $worked_minutes += Carbon::createFromFormat('H:i:s', $clocktime->start_time ?? '00:00:00')
                    ->diffInMinutes(Carbon::createFromFormat('H:i:s', $clocktime->end_time ?? '00:00:00'));
            });

        return $worked_minutes;
    }
}
