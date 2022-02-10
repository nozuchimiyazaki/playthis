<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('genres')->insert([
            'name' => 'ロック',
            'order' => 1
        ]);
        DB::table('genres')->insert([
            'name' => 'ジャズ',
            'order' => 2
        ]);
        DB::table('genres')->insert([
            'name' => 'ハードロック',
            'order' => 3
        ]);
        DB::table('genres')->insert([
            'name' => 'メタル',
            'order' => 4
        ]);
        DB::table('genres')->insert([
            'name' => 'プログレ',
            'order' => 5
        ]);
        DB::table('genres')->insert([
            'name' => 'ラテン',
            'order' => 6
        ]);
        DB::table('genres')->insert([
            'name' => 'J-POP',
            'order' => 7
        ]);
        DB::table('genres')->insert([
            'name' => 'フォーク',
            'order' => 8
        ]);
        DB::table('genres')->insert([
            'name' => 'その他',
            'order' => 99
        ]);
    }
}
