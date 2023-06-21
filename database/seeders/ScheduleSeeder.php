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
        $days       = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"];
        $titles      = ["Tarde y Temprano", "Así son las Cosas", "Dos en la Ciudad", "Pase lo que pase", "Cuenta Final Radio", 
                    "Estar Mejor", "Agenda País", "Viajes de Radio", "Tu Diario Cooperativo"];
        $start      = ["0:00", "6:00", "10:00", "12:00", "16:00", "18:00", "20:00", "21:00", "22:00"];
        $stop       = ["5:59", "9:59", "11:59", "15:59", "17:59", "19:59", "20:59", "21:59", "23:59"];
        $iteration  = [5, 3, 1, 3, 1, 1, 0, 0, 1];

        foreach($days as $key => $day) {

            foreach($titles as $jey => $title) {
                DB::table('schedules')->insert([
                    'day'   => Str::lower($day),
                    'start' => $start[$jey],
                    'stop'  => $stop[$jey],
                    'title' => $title,
                ]);

                $n = 0;
                $lastid = DB::getPdo()->lastInsertId();

                do {
                    $h = $this->diff($n, $iteration[$jey], $start[$jey], $stop[$jey]);

                    DB::table('schedules')->insert([
                        'parent_id' => $lastid,
                        'day'       => Str::lower($day),
                        'start'     => $h["start"], // 
                        'stop'      => $h["stop"], //
                        'title'     => $title,
                    ]);

                    $n++;
                } while($n <= $iteration[$jey]);
            }

        }

        DB::table('schedules')->insert([
            'day'   => "saturday",
            'start' => "8:00",
            'stop'  => "10:00",
            'title' => "Tu Diario Cooperativo",
        ]);


    }

    public function diff($n, $iteration, $start, $stop) {
        $iStart = intval(explode(":", $start)[0]);
        $iStop = intval(explode(":", $start)[0]);

        if($n <= $iteration) { 
            $niStart = $iStart + $n;
            $niStop = $iStop + $n;
        } else {
            $niStart = $iStart;
            $niStop = $iStop;
        }

        $newStart = implode(":", [$niStart, "00"]);
        $newStop = implode(":", [$niStop, "59"]);

        $result = ["start" => $newStart, "stop" => $newStop];

        return $result;
    }
}
