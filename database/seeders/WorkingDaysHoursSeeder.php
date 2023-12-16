<?php

namespace Database\Seeders;

use App\Enums\DaysHoursStatus;
use App\Models\WorkingDaysHours;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkingDaysHoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days=["شنبه","یکشنبه","دوشنبه","سه شنبه","چهارشنبه"];
        foreach ($days as $key => $day){
            WorkingDaysHours::create([
                "day" => $day,
                "start_work" => "07:00",
                "end_work" => "15:00",
                "status" => DaysHoursStatus::open
            ]);
        }
        WorkingDaysHours::create([
            "day" => "پنجشنبه",
            "start_work" => "07:00",
            "end_work" => "12:00",
            "status" => DaysHoursStatus::open
        ]);
        WorkingDaysHours::create([
            "day" => "جمعه",
            "start_work" => null,
            "end_work" => null,
            "status" => DaysHoursStatus::close
        ]);
    }
}
