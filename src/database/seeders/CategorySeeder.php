<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['家電', 'ファッション', '本', '食品', 'その他'];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
