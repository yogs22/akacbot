<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nisn' => rand(100000000, 999999999),
            'name' => $this->faker->name,
            'gender' => $this->faker->randomElement($array = ['Laki-laki', 'Perempuan']),
            'address' => $this->faker->address,
            'birthplace' => $this->faker->city,
            'birthdate' => $this->faker->dateTime,
            'phone_number' => $this->faker->phoneNumber,
            'religion' => $this->faker->randomElement(config('array.religion')),
            'major_id' => rand(1,5),
            'class_id' => rand(1,6)
        ];
    }
}
