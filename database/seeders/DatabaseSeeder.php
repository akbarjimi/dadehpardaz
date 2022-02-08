<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Request;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Category::factory(4)->create();
        Request::factory(5)->create();
    }
}
