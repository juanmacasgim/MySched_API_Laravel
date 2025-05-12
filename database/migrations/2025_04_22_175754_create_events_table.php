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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('calendar_id');
            $table->string('title'); // Title of the event
            $table->text('description')->nullable(); // Description of the event
            $table->dateTime('start_date'); // Start date of the event ex: 2025-04-22 00:00:00
            $table->dateTime('end_date')->nullable();   // End date of the event: ex: 2025-04-22 23:59:59
            $table->string('color')->default('#000000'); // Color of the event
            $table->time('start_time')->nullable(); // Start time of the event: ex: 00:00:00
            $table->time('end_time')->nullable(); // End time of the event: ex: 23:59:59
            $table->timestamps();
            $table->enum('recurrence_type', [
                'daily',
                'weekly',
                'monthly',
                'yearly',
                'special'
            ])->nullable(); // Daily, Weekly, Monthly, Yearly, Special
            $table->integer('recurrence_interval')->nullable(); // Interval for recurrence (e.g., every 2 days)
            $table->integer('recurrence_repeats')->nullable(); // Number of times the event repeats
            $table->json('recurrence_days')->nullable(); // Days of the week for weekly recurrence: ['Monday', 'Tuesday', ...]
            $table->unsignedBigInteger('parent_event_id')->nullable();

            $table->foreign('calendar_id')->references('id')->on('calendars')->onDelete('cascade');
            $table->foreign('parent_event_id')->references('id')->on('events')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
