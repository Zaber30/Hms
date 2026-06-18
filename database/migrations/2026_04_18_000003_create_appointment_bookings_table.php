<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('appointment_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('schedule_id');
            $table->unsignedBigInteger('patient_id');
            $table->string('status')->default('pending'); // pending, approved, rejected, completed, cancelled
            $table->text('patient_notes')->nullable();
            $table->text('doctor_notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->foreign('schedule_id')->references('id')->on('appointment_schedules')->cascadeOnDelete();
            $table->foreign('patient_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unique(['schedule_id', 'patient_id'], 'schedule_patient_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointment_bookings');
    }
};
