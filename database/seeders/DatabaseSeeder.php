<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Group;
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
        User::factory(10)->create();
        Profile::factory(1)->create();
        Category::factory(5)->create();
        Book::factory(30)->create();
    }
}
