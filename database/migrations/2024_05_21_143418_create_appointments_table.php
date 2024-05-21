<?php

use App\Enums\AppointmentStatusEnum;
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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinic_id')->constrained();
            $table->foreignId('patient_id')->constrained();
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('users');
            $table->date('schedule_date');
            $table->integer('height');
            $table->integer('weight');
            $table->string('blood_pressure');
            $table->text('symptoms');
            $table->text('diagnostic')->nullable();
            $table->integer('doctor_fee')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('amount')->default(0);
            $table->enum('status', AppointmentStatusEnum::values())->default(AppointmentStatusEnum::SCHEDULED->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
