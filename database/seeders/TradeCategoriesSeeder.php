<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TradeCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [ 'name' => 'Albañilería y Construcción',  'tw_color' => '#D2691E' ],
            [ 'name' => 'Albañilería',                 'tw_color' => '#A52A2A' ],
            [ 'name' => 'Carpintería',                 'tw_color' => '#8B4513' ],
            [ 'name' => 'Ceramista',                   'tw_color' => '#D2691E' ],
            [ 'name' => 'Cerrajería',                  'tw_color' => '#708090' ],
            [ 'name' => 'Cocinería',                   'tw_color' => '#FF6347' ],
            [ 'name' => 'Electricista',                'tw_color' => '#FFD700' ],
            [ 'name' => 'Gasfitería/Fontanería',       'tw_color' => '#4682B4' ],
            [ 'name' => 'Herrería',                    'tw_color' => '#333333' ],
            [ 'name' => 'Jardinería',                  'tw_color' => '#32CD32' ],
            [ 'name' => 'Mecánica',                    'tw_color' => '#708090' ],
            [ 'name' => 'Mecanica Automotriz',         'tw_color' => '#2F4F4F' ],
            [ 'name' => 'Pintura',                     'tw_color' => '#FF4500' ],
            [ 'name' => 'Plomería',                    'tw_color' => '#1E90FF' ],
            [ 'name' => 'Producción Artesanal',        'tw_color' => '#FF69B4' ],
            [ 'name' => 'Sastrería',                   'tw_color' => '#2F4F4F' ],
            [ 'name' => 'Vidriería',                   'tw_color' => '#00CED1' ],
        ];

        DB::table('trade_categories')->insert($categories);
    }
}
