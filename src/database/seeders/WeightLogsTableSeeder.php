<?php

namespace Database\Seeders;

use App\Models\WeightLogs;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeightLogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WeightLogs::factory()->count(35)->create();
    }
}
