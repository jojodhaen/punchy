<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->double('weekly_hours')->default(30);
            $table->double('min_break_hours')->default(0.5);
            $table->double('max_break_hours')->nullable();
            $table->double('max_break_turnover_hours')->nullable();
            $table->double('min_break_hours_weekend')->nullable();
            $table->double('max_break_hours_weekend')->nullable();
            $table->double('max_break_turnover_hours_weekend')->nullable();

            $table->foreignId('user_id');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
