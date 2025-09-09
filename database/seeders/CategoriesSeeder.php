<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Agricultura, Pesca y Forestal',             'tw_color' => '#22C55E'],
            ['name' => 'Ropa y Accesorios',                         'tw_color' => '#F97316'],
            ['name' => 'Automóviles',                               'tw_color' => '#525252'],
            ['name' => 'Servicios Empresariales y Profesionales',   'tw_color' => '#EAB308'],
            ['name' => 'Informática, Comunicaciones y Electrónica', 'tw_color' => '#71717A'],
            ['name' => 'Construcción y Renovación',                 'tw_color' => '#FDE047'],
            ['name' => 'Educación',                                 'tw_color' => '#84CC16'],
            ['name' => 'Entretenimiento',                           'tw_color' => '#4F46E5'],
            ['name' => 'Familia y Comunidad',                       'tw_color' => '#059669'],
            ['name' => 'Financiamiento y Jurídico',                 'tw_color' => '#0D9488'],
            ['name' => 'Comida y Bebidas',                          'tw_color' => '#06B6D4'],
            ['name' => 'Salud y Medicina',                          'tw_color' => '#94A3B8'],
            ['name' => 'Casa y Jardín',                             'tw_color' => '#B45309'],
            ['name' => 'Productos y Servicios Industriales',        'tw_color' => '#334155'],
            ['name' => 'Cuidado Personal',                          'tw_color' => '#F472B6'],
            ['name' => 'Utilidades Públicas y Medio Ambiente',      'tw_color' => '#BEF264'],
            ['name' => 'Inmobiliaria y Seguros',                    'tw_color' => '#E11D48'],
            ['name' => 'Compras y Tiendas Especializadas',          'tw_color' => '#0284C7'],
            ['name' => 'Deportes y Recreación',                     'tw_color' => '#FDA4AF'],
            ['name' => 'Transporte',                                'tw_color' => '#C084FC'],
            ['name' => 'Viajes y Alojamiento',                      'tw_color' => '#0284C7'],
        ];

        DB::table('categories')->insert($categories);
    }
}
