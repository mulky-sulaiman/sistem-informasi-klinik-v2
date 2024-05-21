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
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->tinyText('description')->nullable();
            // Region
            $table->text('address')->nullable();
            $table->char('province_id', 2)->index()->nullable();
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->char('regency_id', 4)->index()->nullable();
            $table->foreign('regency_id')->references('id')->on('regencies');
            $table->char('district_id', 7)->index()->nullable();
            $table->foreign('district_id')->references('id')->on('districts');
            $table->char('village_id', 10)->index()->nullable();
            $table->foreign('village_id')->references('id')->on('villages');
            // --
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinics');
    }
};
