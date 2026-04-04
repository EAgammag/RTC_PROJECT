<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add detailed cadet profile fields to the users table.
     *
     * Personal: date_of_birth, gender, blood_type, religion, contact_number
     * Academic: course_year
     * Physical: height, weight
     * Address:  address
     * Emergency: emergency_name, emergency_relationship, emergency_contact
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('date_of_birth')->nullable()->after('student_id');
            $table->string('gender', 20)->nullable()->after('date_of_birth');
            $table->string('blood_type', 10)->nullable()->after('gender');
            $table->string('religion', 100)->nullable()->after('blood_type');
            $table->string('contact_number', 20)->nullable()->after('religion');
            $table->string('course_year', 100)->nullable()->after('contact_number');
            $table->string('address')->nullable()->after('course_year');
            $table->string('height', 20)->nullable()->after('address');
            $table->string('weight', 20)->nullable()->after('height');
            $table->string('emergency_name')->nullable()->after('weight');
            $table->string('emergency_relationship', 100)->nullable()->after('emergency_name');
            $table->string('emergency_contact', 20)->nullable()->after('emergency_relationship');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'date_of_birth',
                'gender',
                'blood_type',
                'religion',
                'contact_number',
                'course_year',
                'address',
                'height',
                'weight',
                'emergency_name',
                'emergency_relationship',
                'emergency_contact',
            ]);
        });
    }
};
