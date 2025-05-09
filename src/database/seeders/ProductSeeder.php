<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 「食品」カテゴリを取得 or 作成
        $shokuhinCategory = Category::firstOrCreate(['name' => '食品']);

        // ダミーデータをカテゴリ指定で作成
        Product::factory()
            ->count(10)
            ->create([
                'category_id' => $shokuhinCategory->id, // ★ ここで指定
            ]);

        Product::factory()->count(20)->create(); // ← 20件生成
    }
}
