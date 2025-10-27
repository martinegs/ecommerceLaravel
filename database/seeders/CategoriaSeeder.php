<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = [
            [
                'nombre' => 'Frutas y Verduras',
                'descripcion' => 'Frutas y verduras frescas de temporada',
                'imagen' => 'images/frutasverduras.webp',
                'activo' => true
            ],
            [
                'nombre' => 'Carnes y Pescados',
                'descripcion' => 'Carnes frescas y pescados del día',
                'imagen' => 'images/carneypescado.jpg',
                'activo' => true
            ],
            [
                'nombre' => 'Lácteos y Huevos',
                'descripcion' => 'Leche, yogures, quesos y huevos frescos',
                'imagen' => 'images/lacteosyhuevos.webp',
                'activo' => true
            ],
            [
                'nombre' => 'Panadería y Bollería',
                'descripcion' => 'Pan fresco y bollería recién horneada',
                'imagen' => 'images/panaderiaybolleria.webp',
                'activo' => true
            ],
            [
                'nombre' => 'Bebidas',
                'descripcion' => 'Agua, refrescos, zumos y bebidas alcohólicas',
                'imagen' => 'images/bebidas.webp',
                'activo' => true
            ],
            [
                'nombre' => 'Congelados',
                'descripcion' => 'Productos congelados y helados',
                'imagen' => 'images/congelados.webp',
                'activo' => true
            ],
            [
                'nombre' => 'Despensa',
                'descripcion' => 'Conservas, pasta, arroz y legumbres',
                'imagen' => 'images/despensa.jpeg',
                'activo' => true
            ],
            [
                'nombre' => 'Limpieza',
                'descripcion' => 'Productos de limpieza para el hogar',
                'imagen' => 'images/limpieza.jpg',
                'activo' => true
            ]
        ];
        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
