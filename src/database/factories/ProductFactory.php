<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        // 形容詞、作物名、農園名のリスト
        $adjectives = ['完熟', '朝採れ', '新鮮', '有機栽培', '甘い', 'ジューシー', '数量限定', '減農薬', '旬の', '採れたて'];
        $items      = ['いちご', 'トマト', 'みかん', 'ブルーベリー', 'とうもろこし', 'レタス', 'きゅうり', 'じゃがいも', 'にんじん', 'りんご', '桃'];
        $farms      = ['北の大地農園', '南風ファーム', '青空畑', '田中農園', '山の恵み園', 'ひだまり農園'];

        // タイトルをランダム合成（50%の確率で農園名つける）
        $title = $this->faker->randomElement($adjectives)
            . $this->faker->randomElement($items);

        if ($this->faker->boolean(50)) {
            $title = $this->faker->randomElement($farms) . 'の' . $title;
        }

        $descriptions = [
            '旬の味をそのままお届けします。',
            '自然の恵みをたっぷり含んだおいしさ。',
            '食卓に彩りを添える新鮮な野菜です。',
            '甘さと香りが自慢の逸品です。',
            '朝一番に収穫して直送しています。',
            'そのままでも、調理してもおいしく召し上がれます。',
        ];

        // 「食品」カテゴリを取得
        $shokuhinCategory = Category::where('name', '食品')->first();

        return [
            'title' => $title,
            'description' => $this->faker->randomElement($descriptions),
            'price' => $this->faker->numberBetween(300, 1200),
            'image_path' => null,
            'user_id' => 1,
            // 全カテゴリ用
            //'category_id' => Category::inRandomOrder()->first()?->id,
        ];
    }
}
