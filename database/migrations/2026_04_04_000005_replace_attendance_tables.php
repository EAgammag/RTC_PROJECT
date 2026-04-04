<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop old tables
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('training_sessions');

        // New flat attendance table — one row per cadet per training day
        Schema::create('attendance_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cadet_id')->constrained('users')->cascadeOnDelete();
            $table->tinyInteger('day_number');          // 1 – 15
            $table->date('training_date')->nullable();
            $table->smallInteger('merits')->default(0);
            $table->smallInteger('demerits')->default(0);
            $table->string('remarks', 500)->nullable();
            $table->string('e_signature', 255)->nullable(); // instructor initials / name
            $table->foreignId('recorded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(['cadet_id', 'day_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_records');
    }
};
