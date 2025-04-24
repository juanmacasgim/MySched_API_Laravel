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
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');  // Foreign key to users table
            $table->string('name'); // Name of the calendar
            $table->string('description')->nullable(); // Description of the calendar
            $table->enum('type', [
                'standard_calendar',
                'daily_journal',
                'timetable',
                'shift_roster'
            ])->default('standard_calendar'); // Type of the calendar: 'Standar Calendar, 'Daily Journal' (Diario), 'Timetable' (Horarios o Agenda), 'Shift Roster' (Turnos)
            $table->string('color')->default('#000000'); // Color of the calendar
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendars');
    }
};
