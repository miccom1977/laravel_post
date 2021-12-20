<?php

namespace Database\Seeders;

use App\Models\PostsCategories;
use Illuminate\Database\Seeder;

class PostsCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PostsCategories::factory()->count(200)->create();
    }
}
