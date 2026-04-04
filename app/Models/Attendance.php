<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    protected $table = 'attendance_records';

    protected $fillable = [
        'cadet_id',
        'day_number',
        'training_date',
        'merits',
        'demerits',
        'remarks',
        'e_signature',
        'recorded_by',
    ];

    protected function casts(): array
    {
        return [
            'training_date' => 'date',
            'merits'        => 'integer',
            'demerits'      => 'integer',
            'day_number'    => 'integer',
        ];
    }

    public const TOTAL_DAYS = 15;

    // ── Relationships ─────────────────────────────────────────────────────────

    public function cadet(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cadet_id');
    }

    public function recorder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
