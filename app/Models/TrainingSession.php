<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingSession extends Model
{
    protected $fillable = [
        'title',
        'session_date',
        'session_type',
        'location',
        'notes',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'session_date' => 'date',
        ];
    }

    public const TYPES = [
        'Drill',
        'Physical Training',
        'Classroom',
        'Field Training',
        'Ceremony',
        'Other',
    ];

    // ── Relationships ─────────────────────────────────────────────────────────

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'session_id');
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    public function presentCount(): int
    {
        return $this->attendances()->where('status', 'present')->count();
    }

    public function totalCadets(): int
    {
        return $this->attendances()->count();
    }

    public function attendanceRate(): float
    {
        $total = $this->totalCadets();
        return $total > 0 ? round($this->presentCount() / $total * 100, 1) : 0;
    }
}
