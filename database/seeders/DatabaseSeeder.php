<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the NROTC system with default accounts for each role.
     *
     * IMPORTANT: Change these credentials immediately after first deployment.
     * Passwords satisfy NIST SP 800-63B complexity requirements:
     *   - Minimum 12 characters
     *   - Mix of uppercase, lowercase, digit, and special character
     */
    public function run(): void
    {
        // ── Administrator ─────────────────────────────────────────────────────
        User::firstOrCreate(
            ['email' => 'admin@nrotc.csu.edu.ph'],
            [
                'name'       => 'System Administrator',
                'student_id' => 'ADMIN-001',
                'password'   => Hash::make('Admin@NROTC2026!'),
                'role'       => User::ROLE_ADMIN,
                'is_active'  => true,
            ]
        );

        // ── Officer ───────────────────────────────────────────────────────────
        User::firstOrCreate(
            ['email' => 'officer@nrotc.csu.edu.ph'],
            [
                'name'       => 'Tactical Officer',
                'student_id' => 'OFC-001',
                'password'   => Hash::make('Officer@NROTC2026!'),
                'role'       => User::ROLE_OFFICER,
                'is_active'  => true,
            ]
        );

        // ── Sample Cadet ──────────────────────────────────────────────────────
        User::firstOrCreate(
            ['email' => 'cadet@nrotc.csu.edu.ph'],
            [
                'name'       => 'Sample Cadet',
                'student_id' => '2024-00001',
                'password'   => Hash::make('Cadet@NROTC2026!'),
                'role'       => User::ROLE_CADET,
                'is_active'  => true,
            ]
        );
    }
}
