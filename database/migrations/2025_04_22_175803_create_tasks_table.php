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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title'); // Title of the task
            $table->string('description')->nullable(); // Description of the task
            $table->dateTime('start_date'); // Start time of the task ex: 2025-04-22 00:00:00
            $table->dateTime('end_date')->nullable();   // End time of the task: ex: 2025-04-22 23:59:59
            $table->time('start_time')->nullable(); // Start time of the task: ex: 00:00:00
            $table->time('end_time')->nullable(); // End time of the task: ex: 23:59:59
            $table->timestamps();
            $table->boolean('completed')->default(false); // Task completion status

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
