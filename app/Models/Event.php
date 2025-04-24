<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'calendar_id',
        'title',
        'description',
        'start_time',
        'end_time',
        'start_time_event',
        'end_time_event',
        'recurrence',
        'parent_event_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'recurrence' => 'array', // Cast JSON recurrence to an array
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    /**
     * Relationship: An event belongs to a calendar.
     */
    public function calendar()
    {
        return $this->belongsTo(Calendar::class);
    }

    /**
     * Relationship: An event can have a parent event (recurring events).
     */
    public function parentEvent()
    {
        return $this->belongsTo(Event::class, 'parent_event_id');
    }

    /**
     * Relationship: An event can have many child events (recurring events).
     */
    public function childEvents()
    {
        return $this->hasMany(Event::class, 'parent_event_id');
    }

    /**
     * Get the recurrence type (e.g., Daily, Weekly, Monthly).
     *
     * @return string|null
     */
    public function getRecurrenceType(): ?string
    {
        return $this->recurrence['type'] ?? null;
    }

    /**
     * Get the recurrence duration.
     *
     * @return int|null
     */
    public function getRecurrenceDuration(): ?int
    {
        return $this->recurrence['duration'] ?? null;
    }

    /**
     * Set the recurrence details.
     *
     * @param string $type
     * @param int $duration
     * @return void
     */
    public function setRecurrence(string $type, int $duration): void
    {
        $this->recurrence = [
            'type' => $type,
            'duration' => $duration,
        ];
    }
}
