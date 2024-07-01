<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genreData = [
            'name' => '寿司'
        ];
        DB::table('genres')->insert($genreData);
        $genreData = [
            'name' => '焼肉'
        ];
        DB::table('genres')->insert($genreData);
        $genreData = [
            'name' => 'ラーメン'
        ];
        DB::table('genres')->insert($genreData);
        $genreData = [
            'name' => 'イタリアン'
        ];
        DB::table('genres')->insert($genreData);
        $genreData = [
            'name' => '居酒屋'
        ];
        DB::table('genres')->insert($genreData);
    }
}
