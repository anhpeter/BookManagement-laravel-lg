<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'fullname' => $this->faker->name(),
            'avatar' => 'https://media-cdn.laodong.vn/storage/newsportal/2021/2/26/883735/Jennie-1-1598428156.jpg?w=414&h=276&crop=auto&scale=both',
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'birthday' => $this->faker->date(),
        ];
    }
}
