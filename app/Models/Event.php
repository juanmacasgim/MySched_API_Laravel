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
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'recurrence_type',
        'recurrence_interval',
        'recurrence_repeats',
        'recurrence_days',
        'parent_event_id',
        'color',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'start_time' => 'datetime:H:i:s',
        'end_time' => 'datetime:H:i:s',
        'recurrence_days' => 'array', // Cast JSON recurrence_days to an array
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
}
