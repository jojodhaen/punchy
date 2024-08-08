<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function getSettings()
    {
        return Auth::user()
            ->settings
            ->get()
            ->first();
    }

    public function patchSettings(Request $request)
    {
        $validatedFields = $request->validate([
            'weekly_hours' => ['integer', '>0'],
            'min_break_hours' => ['integer', '>=0'],
            'max_break_hours' => ['integer', 'nullable', 'gt:min_break_hours'],
            'max_break_turnover_hours' => ['integer', 'nullable', 'gt:max_break_hours'],
            'min_break_hours_weekend' => ['integer', 'nullable', '>=0'],
            'max_break_hours_weekend' => ['integer', 'nullable', 'gt:min_break_hours_weekend'],
            'max_break_turnover_hours_weekend' => ['integer', 'nullable', 'gt:max_break_hours_weekend'],
        ]);

        Auth::user()
            ->settings
            ->update($validatedFields);

        return response()->json(['message' => 'Settings updated']);
    }
}
