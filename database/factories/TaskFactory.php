<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
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
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'user_id' => User::factory(),
            'parent_id' => null,
            'status' => fake()->randomElement(['in_progress', 'completed', 'pending']),
        ];
    }

    /**
     * Указать, что задача имеет родительскую задачу.
     */
    public function withParent(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'parent_id' => Task::factory(),
            ];
        });
    }

    /**
     * Указать статус задачи как "в процессе".
     */
    public function inProgress(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'in_progress',
            ];
        });
    }

    /**
     * Указать статус задачи как "завершена".
     */
    public function completed(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'completed',
            ];
        });
    }

    /**
     * Указать статус задачи как "ожидает".
     */
    public function pending(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'pending',
            ];
        });
    }
}
