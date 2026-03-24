<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Adds NROTC-specific security and identity fields to the users table:
     *  - student_id:     official university / service number
     *  - role:           admin | officer | cadet
     *  - is_active:      soft-disable accounts without deletion
     *  - login_attempts: counts consecutive failed logins (OWASP brute-force protection)
     *  - locked_until:   timestamp after which the account may log in again
     *  - last_login_at:  audit trail for security monitoring
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('student_id', 50)->nullable()->unique()->after('name');
            $table->enum('role', ['admin', 'officer', 'cadet'])->default('cadet')->after('student_id');
            $table->boolean('is_active')->default(true)->after('role');
            $table->unsignedSmallInteger('login_attempts')->default(0)->after('is_active');
            $table->timestamp('locked_until')->nullable()->after('login_attempts');
            $table->timestamp('last_login_at')->nullable()->after('locked_until');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'student_id',
                'role',
                'is_active',
                'login_attempts',
                'locked_until',
                'last_login_at',
            ]);
        });
    }
};
