<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //return [
        //'name' => $this->faker->name(),
        //'email' => $this->faker->unique()->safeEmail(),
        //'email_verified_at' => now(),
        //'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //'remember_token' => Str::random(10),
        //];
        return [
            'username' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'fullname' => $this->faker->name(),
            //'group_id' => 1,
            'password' => $this->faker->password(), // password
            'status' => 'active',
            'avatar' => 'https://media-cdn.laodong.vn/storage/newsportal/2021/2/26/883735/Jennie-1-1598428156.jpg?w=414&h=276&crop=auto&scale=both',
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}