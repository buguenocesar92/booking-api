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
        Schema::create('working_hours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('professional_id');
            $table->string('day_of_week'); // Ejemplo: "Monday", "Tuesday", etc.
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();

            $table->foreign('professional_id')
                  ->references('id')
                  ->on('professionals')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('working_hours');
    }
};
