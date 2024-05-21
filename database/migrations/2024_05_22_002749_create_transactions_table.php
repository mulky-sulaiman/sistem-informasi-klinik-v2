<?php

use App\Enums\PaymentStatusEnum;
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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained();
            $table->string('patient_name');
            $table->string('patient_phone')->nullable();
            $table->tinyInteger('patient_age')->default(0);
            $table->string('doctor_name');
            $table->string('doctor_phone')->nullable();
            $table->date('appointment_date');
            $table->text('note')->nullable();
            $table->enum('status', PaymentStatusEnum::values())->default(PaymentStatusEnum::UNPAID->value);
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
