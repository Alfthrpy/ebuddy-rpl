<?php

namespace Database\Factories;

use App\Models\Overtime;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OvertimeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Overtime::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'objective' => $this->faker->paragraph(),
            'place' => $this->faker->address(),
            'result' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'comment' => $this->faker->sentence(),
            'user_id_creator' => User::factory(),  // assuming you have a User factory
            'user_id_approver' => User::factory(),  // assuming you have a User factory
        ];
    }
}
