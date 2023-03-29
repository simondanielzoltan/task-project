<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\State;
use App\Models\Priority;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $state = Arr::random(State::STATUSES);
        $priority = Arr::random(Priority::STATUSES);
        return [
            'name' => fake()->sentence(),
            'description' => fake()->text(),
            'deadline_at' => fake()->dateTime(),
            'state_id' => State::whereName($state)->first()->id,
            'priority_id' => Priority::whereName($priority)->first()->id,
            'created_by' => User::factory(),
        ];
    }
}
