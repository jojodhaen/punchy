<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('clock_times', function (Blueprint $table) {
            $table->id();

            $table->time('start_time')->default('00:00');
            $table->time('end_time')->default('00:00');
            $table->date('date');

            $table->foreignId('user_id');

            $table->unique(['date', 'user_id']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clock_times');
    }
};
