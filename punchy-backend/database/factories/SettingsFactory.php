<?php

namespace Database\Factories;

use App\Models\Settings;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SettingsFactory extends Factory
{
    protected $model = Settings::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'weekly_hours' => $this->faker->randomNumber(),
            'min_break_hours' => $this->faker->randomNumber(),
            'max_break_hours' => $this->faker->randomNumber(),
            'max_break_turnover_hours' => $this->faker->randomNumber(),
            'min_break_hours_weekend' => $this->faker->randomNumber(),
            'max_break_hours_weekend' => $this->faker->randomNumber(),
            'max_break_turnover_hours_weekend' => $this->faker->randomNumber(),

            'user_id' => User::factory(),
        ];
    }
}
