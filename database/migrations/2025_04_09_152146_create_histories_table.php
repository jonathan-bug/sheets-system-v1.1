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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->string('employee_dui');
            $table->unsignedBigInteger('period_id');
            $table->foreign('employee_dui')
                  ->references('dui')
                  ->on('employees')
                  ->onDelete('cascade');
            $table->foreign('period_id')
                  ->references('id')
                  ->on('periods')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
