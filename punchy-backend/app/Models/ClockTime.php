<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClockTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time',
        'end_time',
        'user_id',
        'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeForWeek($query, int $weekNumber)
    {
        return $query->whereBetween('date', [
            now()->startOfWeek()->addWeeks($weekNumber),
            now()->endOfWeek()->addWeeks($weekNumber),
        ]);
    }

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }
}
