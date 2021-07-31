<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'slug' => $this->faker->slug(),
            'price' => $this->faker->numberBetween(50000, 300000),
            'category_id' => 1,
            'author_id' => 1,
            'category_id' => 1,
            'status' => 'active',
            'picture' => 'https://dangchiviet.com/wp-content/uploads/2019/07/review-sach-nha-gia-kim.jpg',
            'short_description' => $this->faker->text(150),
            'long_description' => $this->faker->realText(350),
        ];
    }
}
