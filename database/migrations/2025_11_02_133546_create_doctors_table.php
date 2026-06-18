<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('bmdc_registration_number',50)->unique()->nullable();
            $table->string('phone',20)->nullable();
            $table->enum('gender',['male','female','other'])->nullable();
            $table->string('qualification',100)->nullable();
            $table->integer('experience_years')->nullable();
            $table->text('bio')->nullable();
            $table->string('clinic_address',225)->nullable();
            $table->decimal('consultation_fee',10,2)->nullable();
            $table->string('profile_image',255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
