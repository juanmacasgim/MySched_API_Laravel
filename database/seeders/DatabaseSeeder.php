<?php

namespace Database\Seeders;

use App\Models\Calendar;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
        public function run(): void
    {
        // User::factory(10)->create();

        DB::table('users')->insert([
            [
                'email' => 'juanmariacastillogimenez@gmail.com',
                'password' => bcrypt('12345678'),
                'name' => 'Juan Maria Castillo Gimenez',
                'date_of_birth' => '2001-03-01',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'email' => 'usuario1@gmail.com',
                'password' => bcrypt('12345678'),
                'name' => 'Usuario Prueba 1',
                'date_of_birth' => '2000-01-01',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'email' => 'usuario2@gmail.com',
                'password' => bcrypt('12345678'),
                'name' => 'Usuario Prueba 2',
                'date_of_birth' => '2004-07-10',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('calendars')->insert([
            [
                'user_id' => 1,
                'name' => 'Calendario de Juan Maria',
                'description' => 'Calendario de Juan Maria Castillo Gimenez',
                'type' => 'standard_calendar',
                'color' => '#1976d2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 1,
                'name' => 'Diario de Juan Maria',
                'description' => 'Diario de Juan Maria Castillo Gimenez',
                'type' => 'daily_journal',
                'color' => '#1976d2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'name' => 'Calendario de Usuario 1',
                'description' => 'Calendario de Usuario 1',
                'type' => 'standard_calendar',
                'color' => '#1976d2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 3,
                'name' => 'Calendario de Usuario 2',
                'description' => 'Calendario de Usuario 2',
                'type' => 'standard_calendar',
                'color' => '#1976d2',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        $relations_user_calendar = [
            [
                'user_email' => 'usuario1@gmail.com',
                'calendar_name' => 'Calendario de Juan Maria',
                'access_type' => 'Read',
                'color' => '#1976d2'
            ],
            [
                'user_email' => 'usuario2@gmail.com',
                'calendar_name' => 'Calendario de Juan Maria',
                'access_type' => 'Write',
                'color' => '#1976d2'
            ],
            [
                'user_email' => 'usuario2@gmail.com',
                'calendar_name' => 'Diario de Juan Maria',
                'access_type' => 'Read',
                'color' => '#1976d2'
            ],
        ];

        foreach ($relations_user_calendar as $relation) {
            $user = User::where('email', $relation['user_email'])->first();
            $calendar = Calendar::where('name', $relation['calendar_name'])->first();

            if ($user && $calendar) {
                DB::table('user_calendar')->updateOrInsert(
                    ['user_id' => $user->id, 'calendar_id' => $calendar->id],
                    [
                        'access_type' => $relation['access_type'],
                        'color' => $relation['color'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }

        $relations_events_calendar = [
            [
                'calendar_name' => 'Calendario de Juan Maria',
                'title' => 'Entrega de Proyecto',
                'description' => 'Entrega de Proyecto Final',
                'start_date' => '2025-06-06 09:00:00',
                'end_date' => '2025-06-06 11:00:00',
                'color' => '#1976d2',
                'recurrence_type' => null,
                'recurrence_interval' => null,
                'recurrence_repeats' => null,
                'recurrence_days' => null,
            ],
            [
                'calendar_name' => 'Calendario de Juan Maria',
                'title' => 'Presentaciones de Proyecto',
                'description' => 'Presentación de Proyecto Final',
                'start_date' => '2025-06-13 07:00:00',
                'end_date' => '2025-06-13 09:30:00',
                'color' => '#1976d2',
                'recurrence_type' => null,
                'recurrence_interval' => null,
                'recurrence_repeats' => null,
                'recurrence_days' => null,
            ],
            [
                'calendar_name' => 'Diario de Juan Maria',
                'title' => 'Entrega de Proyecto Diario',
                'description' => 'Esto es una prueba de texto de una entrada del diario',
                'start_date' => '2025-06-06 10:00:00',
                'end_date' => '2025-06-06 12:00:00',
                'color' => '#1976d2',
                'recurrence_type' => null,
                'recurrence_interval' => null,
                'recurrence_repeats' => null,
                'recurrence_days' => null,
            ],
            [
                'calendar_name' => 'Calendario de Usuario 1',
                'title' => 'Cumpleaños de Usuario 1',
                'description' => 'Cumpleaños de Usuario 1',
                'start_date' => '2023-01-01 00:00:00',
                'end_date' => '2023-01-01 23:59:59',
                'color' => '#1976d2',
                'recurrence_type' => 'yearly',
                'recurrence_interval' => 1,
                'recurrence_repeats' => 1,
                'recurrence_days' => null,
            ],
            [
                'calendar_name' => 'Calendario de Usuario 2',
                'title' => 'Cumpleaños de Usuario 2',
                'description' => 'Cumpleaños de Usuario 2',
                'start_date' => '2023-07-10 00:00:00',
                'end_date' => '2023-07-10 23:59:59',
                'color' => '#1976d2',
                'recurrence_type' => 'yearly',
                'recurrence_interval' => 1,
                'recurrence_repeats' => 100,
                'recurrence_days' => null,
            ],
        ];

        foreach ($relations_events_calendar as $relation) {
            $calendar = Calendar::where('name', $relation['calendar_name'])->first();

            if ($calendar) {
                DB::table('events')->updateOrInsert(
                    ['calendar_id' => $calendar->id, 'title' => $relation['title']],
                    [
                        'description' => $relation['description'],
                        'start_date' => $relation['start_date'],
                        'end_date' => $relation['end_date'],
                        'color' => $relation['color'],
                        'recurrence_type' => $relation['recurrence_type'],
                        'recurrence_interval' => $relation['recurrence_interval'],
                        'recurrence_repeats' => $relation['recurrence_repeats'],
                        'recurrence_days' => $relation['recurrence_days'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }

        DB::table('tasks')->insert([
            [
                'user_id' => 1,
                'title' => 'Tarea 1',
                'description' => 'Descripción de la tarea 1',
                'completed' => false,
                'start_date' => '2025-06-01 09:00:00',
                'end_date' => '2025-06-01 11:00:00',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'title' => 'Tarea 2',
                'description' => 'Descripción de la tarea 2',
                'completed' => false,
                'start_date' => '2025-06-02 10:00:00',
                'end_date' => '2025-06-02 12:00:00',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        $relations_tasks_events = [
            [
                'task_title' => 'Tarea 2',
                'event_title' => 'Cumpleaños de Usuario 1',
            ]
        ];

        foreach ($relations_tasks_events as $relation) {
            $task = DB::table('tasks')->where('title', $relation['task_title'])->first();
            $event = DB::table('events')->where('title', $relation['event_title'])->first();

            if ($task && $event) {
                DB::table('task_event')->updateOrInsert(
                    [
                        'task_id' => $task->id,
                        'event_id' => $event->id
                    ]

                );
            }
        }
    }
}
