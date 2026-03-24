<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    // ── Role constants ────────────────────────────────────────────────────────
    const ROLE_ADMIN   = 'admin';
    const ROLE_OFFICER = 'officer';
    const ROLE_CADET   = 'cadet';

    // ── Lockout policy ────────────────────────────────────────────────────────
    const MAX_LOGIN_ATTEMPTS = 5;
    const LOCKOUT_MINUTES    = 15;

    // ── Mass-assignable fields ────────────────────────────────────────────────
    protected $fillable = [
        'name',
        'student_id',
        'email',
        'password',
        'role',
        'is_active',
        'login_attempts',
        'locked_until',
        'last_login_at',
    ];

    // ── Hidden from serialization ─────────────────────────────────────────────
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // ── Attribute casting ─────────────────────────────────────────────────────
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_active'         => 'boolean',
            'locked_until'      => 'datetime',
            'last_login_at'     => 'datetime',
        ];
    }

    // ── Role helpers ──────────────────────────────────────────────────────────
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isOfficer(): bool
    {
        return $this->role === self::ROLE_OFFICER;
    }

    public function isCadet(): bool
    {
        return $this->role === self::ROLE_CADET;
    }

    /**
     * Returns true when the account lockout period has not yet expired.
     */
    public function isLocked(): bool
    {
        return $this->locked_until !== null && $this->locked_until->isFuture();
    }

    /**
     * Returns the home dashboard URL for this user's role.
     */
    public function dashboardRoute(): string
    {
        return match ($this->role) {
            self::ROLE_ADMIN   => route('admin.dashboard'),
            self::ROLE_OFFICER => route('officer.dashboard'),
            self::ROLE_CADET   => route('cadet.dashboard'),
            default            => route('login'),
        };
    }
}
