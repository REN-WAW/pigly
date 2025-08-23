<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class WeightTargetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

        $param = [
            'user_id' => 1,
            'target_weight' => $faker->randomFloat(1, 50, 70),
            'created_at' => now(),
            'updated_at' => now(),
        ];
            DB::table('weight_target')->insert($param);
    }
}
