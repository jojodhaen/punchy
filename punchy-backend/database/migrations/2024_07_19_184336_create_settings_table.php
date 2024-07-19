<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->integer('weekly_hours');
            $table->integer('min_break_hours');
            $table->integer('max_break_hours')->nullable();
            $table->integer('max_break_turnover_hours')->nullable();
            $table->integer('min_break_hours_weekend');
            $table->integer('max_break_hours_weekend')->nullable();
            $table->integer('max_break_turnover_hours_weekend')->nullable();

            $table->foreignId('user_id');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
