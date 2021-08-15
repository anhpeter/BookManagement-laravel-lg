<?php

namespace Database\Factories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Group::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $input = array("admin", "editor", "viewer");
        return [
            'name' => $input[array_rand($input, 1)],
            'description' => $this->faker->paragraph(random_int(3, 5)),
            'status' => 'active',
            //
        ];
    }
}
