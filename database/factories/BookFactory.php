<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
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
            'discount' => $this->faker->numberBetween(0, 100),
            'category_id' => Category::all()->random()->id,
            'author_id' => Author::all()->random()->id,
            'status' => 'active',
            'short_description' => $this->faker->text(150),
            'long_description' => $this->faker->realText(350),
        ];
    }
}
