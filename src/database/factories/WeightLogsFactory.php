<?php

namespace Database\Factories;
use App\Models\WeightLogs;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeightLogsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 5),
            'date' => $this->faker->date(),
            'weight' => $this->faker->randomFloat(1, 40, 120),
            'calories' => $this->faker->numberBetween(1000,3000),
            'exercise_time' => $this->faker->time('H:i:s'),
            'exercise_content' => $this->faker->text(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
