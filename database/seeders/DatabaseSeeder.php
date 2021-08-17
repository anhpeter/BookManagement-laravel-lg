<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Group;
use App\Models\Order;
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
        Group::factory()->create();
        User::factory(100)->create();
        Category::factory(10)->create();
        Author::factory(10)->create();
        Book::factory(300)->create();
        Order::factory(100)->create()->each(function ($order) {
            $ids = range(1, 300);
            shuffle($ids); //trộn
            $sliced = array_slice($ids, 0, array_rand(range(0, 7), 1));
            $total = 0;
            foreach ($sliced as $id) {
                $item = Book::find($id);
                $price = $item->price;
                $qty = array_rand(array_flip(range(1, 5)), 1);
                $total += $price * $qty;
                $order->books()->attach($item->id, ['price' => $price, 'qty' => $qty]);
            }
            $order->update(['total_price' => $total]);
        });
    }
}
