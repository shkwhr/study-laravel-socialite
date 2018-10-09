<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Faker\Factoryモデル定義(日本語定義)
        $faker = Faker\Factory::create('ja_JP');

        // 項目定義
        for ($i = 0; $i < 10; $i++) {
          App\Book::create([
             'user_id'         => $faker->numberBetween(  1,    3)
            ,'organization_id' => $faker->word()
            ,'item_name'       => $faker->word()                    // 文字列
            ,'item_number'     => $faker->numberBetween(  1,  999)  // 数値(範囲)
            ,'item_amount'     => $faker->numberBetween(100, 5000)  // 数値(範囲)
            ,'published'       => $faker->dateTime('now')
            ,'created_at'      => $faker->dateTime('now')
            ,'updated_at'      => $faker->dateTime('now')
          ]);
        }
    }
}
