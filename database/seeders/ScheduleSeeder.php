<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
        foreach($days as $key => $day) {
            DB::table('schedules')->insert([
                'day'   => Str::lower($day),
                'start' => "0:00",
                'stop'  => "6:00",
                'title' => "Tarde y Temprano",
            ]);

            DB::table('schedules')->insert([
                'day'   => Str::lower($day),
                'start' => "6:00",
                'stop'  => "10:00",
                'title' => "Así son las Cosas",
            ]);

            DB::table('schedules')->insert([
                'day'   => Str::lower($day),
                'start' => "10:00",
                'stop'  => "12:00",
                'title' => "Dos en la Ciudad",
            ]);

            DB::table('schedules')->insert([
                'day'   => Str::lower($day),
                'start' => "12:00",
                'stop'  => "16:00",
                'title' => "Pase lo que pase",
            ]);

            DB::table('schedules')->insert([
                'day'   => Str::lower($day),
                'start' => "16:00",
                'stop'  => "18:00",
                'title' => "Cuenta Final Radio",
            ]);

            DB::table('schedules')->insert([
                'day'   => Str::lower($day),
                'start' => "18:00",
                'stop'  => "20:00",
                'title' => "Cuenta Final Radio",
            ]);

            DB::table('schedules')->insert([
                'day'   => Str::lower($day),
                'start' => "20:00",
                'stop'  => "21:00",
                'title' => "Estar Mejor",
            ]);

            DB::table('schedules')->insert([
                'day'   => Str::lower($day),
                'start' => "21:00",
                'stop'  => "22:00",
                'title' => "Agenda País",
            ]);

            DB::table('schedules')->insert([
                'day'   => Str::lower($day),
                'start' => "22:00",
                'stop'  => "23:59",
                'title' => "Viajes de Radio",
            ]);
        }

        DB::table('schedules')->insert([
            'day'   => "saturday",
            'start' => "8:00",
            'stop'  => "10:00",
            'title' => "Tu Diario Cooperativo",
        ]);


    }
}
