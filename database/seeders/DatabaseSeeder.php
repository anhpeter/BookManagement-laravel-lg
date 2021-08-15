<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Group;
use App\Models\Order;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use \App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Group::factory(3)->create();
        Profile::factory(5)->create();
        User::factory(10);
        Category::factory(5)->create();
        Author::factory(3)->create();
        Book::factory(30)->create();
        Order::factory(10)->create()->each(function ($order) {
            $ids = range(1, 30);
            shuffle($ids); //trộn
            $sliced = array_slice($ids, 0, array_rand(range(0, 7), 1));
            foreach ($sliced as $id) {
                $item = Book::find($id);
                $order->books()->attach($item->id, ['price' => $item->price, 'qty' => array_rand(array_flip(range(1, 5)), 1)]);
            }
        });
    }
}
