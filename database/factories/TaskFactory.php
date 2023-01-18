<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->realText(10),
            "points" => rand(100, 300),
            "user_id" => rand(1, User::count()),
            "is_confirmed" => $this->faker->boolean(),
            "last_date" => $this->faker->date(),
            "status" => $this->faker->randomElement(["in_progress", "extended", "completed"])
        ];
    }
}
