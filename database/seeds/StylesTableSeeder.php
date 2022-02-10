<?php

use Illuminate\Database\Seeder;

class StylesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('styles')->insert([
            'name' => 'アコギ',
            'order' => 1
        ]);
        DB::table('styles')->insert([
            'name' => 'シングルコイル',
            'order' => 2
        ]);
        DB::table('styles')->insert([
            'name' => 'ハムバッカー',
            'order' => 3
        ]);
        DB::table('styles')->insert([
            'name' => 'アーム奏法',
            'order' => 4
        ]);
        DB::table('styles')->insert([
            'name' => 'タッピング',
            'order' => 5
        ]);
        DB::table('styles')->insert([
            'name' => '特殊奏法',
            'order' => 6
        ]);
    }
}
