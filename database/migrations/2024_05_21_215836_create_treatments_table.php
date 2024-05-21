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
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('treatment_category_id')->constrained();
            $table->foreignId('appointment_id')->constrained();
            $table->string('name');
            $table->text('description');
            $table->integer('quantity')->default(0);
            $table->integer('price')->default(0);
            $table->integer('discount')->default(0);
            $table->integer('amount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};
