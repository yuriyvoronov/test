<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;
use Carbon\Carbon;

class TaskFactory extends Factory
{
    protected $model = Task::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
                'user_id' => 1,
                'status' => 'todo',
                'priority' => rand(1,5),
                'title' => $this->faker->text,
                'description' => $this->faker->text,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'completed_at' => null
        ];
    }
}
