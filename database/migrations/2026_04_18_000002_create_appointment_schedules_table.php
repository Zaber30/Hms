<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('appointment_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id');
            $table->date('schedule_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('max_patients_per_day')->default(10);
            $table->integer('current_bookings')->default(0);
            $table->decimal('consultation_fee', 10, 2)->nullable();
            $table->string('status')->default('available'); // available, fully_booked, cancelled
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('doctor_id')->references('id')->on('users')->cascadeOnDelete();
            $table->unique(['doctor_id', 'schedule_date', 'start_time'], 'doctor_schedule_time_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointment_schedules');
    }
};
