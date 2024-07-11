<?php

namespace Database\Factories;

use App\Models\ClockTime;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ClockTimeFactory extends Factory
{
    protected $model = ClockTime::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'start_time' => Carbon::now(),
            'end_time' => Carbon::now()->addHours(6),
            'date' => Carbon::now(),

            'user_id' => User::factory(),
        ];
    }
}
