<?php

namespace Database\Factories;

use App\Models\Letter;
use App\Models\User;
use App\Models\Template;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LetterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Letter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'no_letter' => $this->faker->unique()->numerify('LET-####'),
            'date_out' => $this->faker->date(),
            'attachment' => $this->faker->word(),
            'subject' => implode(' ', $this->faker->words(2)),
            'destination' => $this->faker->address(),
            'destination_position' => $this->faker->jobTitle(),
            'content' => $this->faker->paragraph(),
            'comment' => 'Tidak Ada Komentar',
            'wm_creator' => $this->faker->name(),
            'wm_approver' => $this->faker->name(),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'user_id_creator' => User::factory(),  // Mengacu ke User factory
            'user_id_approver' => User::factory(), // Mengacu ke User factory
            'template_id' => 1,  // Mengacu ke Template factory
        ];
    }
}
