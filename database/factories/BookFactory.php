<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $title = $this->faker->unique(true)->text(80);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
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
