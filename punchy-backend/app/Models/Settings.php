<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = [
        'weekly_hours',
        'min_break_hours',
        'max_break_hours',
        'max_break_turnover_hours',
        'min_break_hours_weekend',
        'max_break_hours_weekend',
        'max_break_turnover_hours_weekend',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
