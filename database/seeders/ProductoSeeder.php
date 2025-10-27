<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productos = [
            // Frutas y Verduras (categoria_id: 1)
            ['categoria_id' => 1, 'nombre' => 'Manzanas Rojas', 'descripcion' => 'Manzanas rojas de primera calidad', 'precio' => 1850.00, 'unidad' => 'kg', 'stock' => 100, 'destacado' => true, 'activo' => true],
            ['categoria_id' => 1, 'nombre' => 'Bananas', 'descripcion' => 'Bananas frescas', 'precio' => 1200.00, 'unidad' => 'kg', 'stock' => 150, 'destacado' => true, 'activo' => true],
            ['categoria_id' => 1, 'nombre' => 'Tomates', 'descripcion' => 'Tomates maduros y jugosos', 'precio' => 1650.00, 'unidad' => 'kg', 'stock' => 80, 'destacado' => false, 'activo' => true],
            ['categoria_id' => 1, 'nombre' => 'Lechugas', 'descripcion' => 'Lechugas frescas y crujientes', 'precio' => 950.00, 'unidad' => 'unidad', 'stock' => 60, 'destacado' => false, 'activo' => true],
            ['categoria_id' => 1, 'nombre' => 'Naranjas', 'descripcion' => 'Naranjas para jugo', 'precio' => 1400.00, 'unidad' => 'kg', 'stock' => 120, 'destacado' => true, 'activo' => true],
            ['categoria_id' => 1, 'nombre' => 'Papas', 'descripcion' => 'Papas para todo tipo de recetas', 'precio' => 980.00, 'unidad' => 'kg', 'stock' => 200, 'destacado' => false, 'activo' => true],
            ['categoria_id' => 1, 'nombre' => 'Cebollas', 'descripcion' => 'Cebollas blancas selectas', 'precio' => 850.00, 'unidad' => 'kg', 'stock' => 90, 'destacado' => false, 'activo' => true],
            ['categoria_id' => 1, 'nombre' => 'Frutillas', 'descripcion' => 'Frutillas frescas de temporada', 'precio' => 2800.00, 'unidad' => 'kg', 'stock' => 40, 'destacado' => true, 'activo' => true],
            
            // Carnes y Pescados (categoria_id: 2)
            ['categoria_id' => 2, 'nombre' => 'Pechuga de Pollo', 'descripcion' => 'Pechuga de pollo fresca sin piel', 'precio' => 4850.00, 'unidad' => 'kg', 'stock' => 50, 'destacado' => true, 'activo' => true],
            ['categoria_id' => 2, 'nombre' => 'Carne Picada', 'descripcion' => 'Carne picada especial', 'precio' => 6200.00, 'unidad' => 'kg', 'stock' => 40, 'destacado' => false, 'activo' => true],
            ['categoria_id' => 2, 'nombre' => 'Asado', 'descripcion' => 'Asado de primera calidad', 'precio' => 8500.00, 'unidad' => 'kg', 'stock' => 25, 'destacado' => false, 'activo' => true],
            ['categoria_id' => 2, 'nombre' => 'Salmón Fresco', 'descripcion' => 'Salmón rosado fresco', 'precio' => 12900.00, 'unidad' => 'kg', 'stock' => 30, 'destacado' => true, 'activo' => true],
            ['categoria_id' => 2, 'nombre' => 'Merluza', 'descripcion' => 'Merluza limpia sin espinas', 'precio' => 9800.00, 'unidad' => 'kg', 'stock' => 35, 'destacado' => false, 'activo' => true],
            ['categoria_id' => 2, 'nombre' => 'Milanesas de Carne', 'descripcion' => 'Milanesas de carne premium', 'precio' => 7500.00, 'unidad' => 'kg', 'stock' => 20, 'destacado' => false, 'activo' => true],
            
            // Lácteos y Huevos (categoria_id: 3)
            ['categoria_id' => 3, 'nombre' => 'Leche Entera', 'descripcion' => 'Leche entera sachet 1L', 'precio' => 980.00, 'unidad' => 'litro', 'stock' => 100, 'destacado' => true, 'activo' => true],
            ['categoria_id' => 3, 'nombre' => 'Yogur Natural', 'descripcion' => 'Yogur natural x4 unidades', 'precio' => 1850.00, 'unidad' => 'pack', 'stock' => 80, 'destacado' => false, 'activo' => true],
            ['categoria_id' => 3, 'nombre' => 'Queso Cremoso', 'descripcion' => 'Queso cremoso 200g', 'precio' => 2400.00, 'unidad' => 'unidad', 'stock' => 30, 'destacado' => false, 'activo' => true],
            ['categoria_id' => 3, 'nombre' => 'Manteca', 'descripcion' => 'Manteca con sal 200g', 'precio' => 1650.00, 'unidad' => 'unidad', 'stock' => 60, 'destacado' => false, 'activo' => true],
            ['categoria_id' => 3, 'nombre' => 'Huevos', 'descripcion' => 'Maple de 12 huevos', 'precio' => 2950.00, 'unidad' => 'maple', 'stock' => 90, 'destacado' => true, 'activo' => true],
            
            // Panadería y Bollería (categoria_id: 4)
            ['categoria_id' => 4, 'nombre' => 'Pan Francés', 'descripcion' => 'Pan francés tradicional', 'precio' => 850.00, 'unidad' => 'unidad', 'stock' => 150, 'destacado' => true, 'activo' => true],
            ['categoria_id' => 4, 'nombre' => 'Pan Lactal', 'descripcion' => 'Pan de molde lactal', 'precio' => 1950.00, 'unidad' => 'unidad', 'stock' => 70, 'destacado' => false, 'activo' => true],
            ['categoria_id' => 4, 'nombre' => 'Medialunas', 'descripcion' => 'Medialunas de manteca x6', 'precio' => 2800.00, 'unidad' => 'pack', 'stock' => 50, 'destacado' => false, 'activo' => true],
            ['categoria_id' => 4, 'nombre' => 'Facturas Surtidas', 'descripcion' => 'Facturas surtidas x6', 'precio' => 3200.00, 'unidad' => 'pack', 'stock' => 40, 'destacado' => false, 'activo' => true],
            
            // Bebidas (categoria_id: 5)
            ['categoria_id' => 5, 'nombre' => 'Agua Mineral', 'descripcion' => 'Agua mineral sin gas 2L', 'precio' => 850.00, 'unidad' => 'unidad', 'stock' => 200, 'destacado' => true, 'activo' => true],
            ['categoria_id' => 5, 'nombre' => 'Coca Cola', 'descripcion' => 'Coca Cola 2.25L', 'precio' => 2450.00, 'unidad' => 'unidad', 'stock' => 150, 'destacado' => false, 'activo' => true],
            ['categoria_id' => 5, 'nombre' => 'Jugo de Naranja', 'descripcion' => 'Jugo de naranja Baggio 1L', 'precio' => 1650.00, 'unidad' => 'litro', 'stock' => 80, 'destacado' => false, 'activo' => true],
            ['categoria_id' => 5, 'nombre' => 'Cerveza Quilmes', 'descripcion' => 'Cerveza Quilmes lata x6', 'precio' => 4500.00, 'unidad' => 'pack', 'stock' => 100, 'destacado' => false, 'activo' => true],
            ['categoria_id' => 5, 'nombre' => 'Vino Tinto', 'descripcion' => 'Vino tinto Malbec 750ml', 'precio' => 5800.00, 'unidad' => 'botella', 'stock' => 60, 'destacado' => true, 'activo' => true],
            
            // Congelados (categoria_id: 6)
            ['categoria_id' => 6, 'nombre' => 'Pizza Muzzarella', 'descripcion' => 'Pizza muzzarella congelada', 'precio' => 3200.00, 'unidad' => 'unidad', 'stock' => 70, 'destacado' => false, 'activo' => true],
            ['categoria_id' => 6, 'nombre' => 'Arvejas Congeladas', 'descripcion' => 'Arvejas congeladas 300g', 'precio' => 1250.00, 'unidad' => 'pack', 'stock' => 90, 'destacado' => false, 'activo' => true],
            ['categoria_id' => 6, 'nombre' => 'Helado Vainilla', 'descripcion' => 'Helado de vainilla 1kg', 'precio' => 4800.00, 'unidad' => 'pote', 'stock' => 60, 'destacado' => true, 'activo' => true],
            ['categoria_id' => 6, 'nombre' => 'Papas Fritas McCain', 'descripcion' => 'Papas fritas congeladas 1kg', 'precio' => 3650.00, 'unidad' => 'pack', 'stock' => 50, 'destacado' => false, 'activo' => true],
            
            // Despensa (categoria_id: 7)
            ['categoria_id' => 7, 'nombre' => 'Arroz Gallo Oro', 'descripcion' => 'Arroz blanco largo fino 1kg', 'precio' => 1580.00, 'unidad' => 'kg', 'stock' => 120, 'destacado' => true, 'activo' => true],
            ['categoria_id' => 7, 'nombre' => 'Fideos Matarazzo', 'descripcion' => 'Fideos secos guiseros 500g', 'precio' => 1250.00, 'unidad' => 'pack', 'stock' => 150, 'destacado' => false, 'activo' => true],
            ['categoria_id' => 7, 'nombre' => 'Lentejas', 'descripcion' => 'Lentejas secas 500g', 'precio' => 1450.00, 'unidad' => 'pack', 'stock' => 100, 'destacado' => false, 'activo' => true],
            ['categoria_id' => 7, 'nombre' => 'Aceite de Girasol', 'descripcion' => 'Aceite de girasol Cocinero 1.5L', 'precio' => 2850.00, 'unidad' => 'botella', 'stock' => 80, 'destacado' => true, 'activo' => true],
            ['categoria_id' => 7, 'nombre' => 'Puré de Tomate', 'descripcion' => 'Puré de tomate Arcor 520g', 'precio' => 1350.00, 'unidad' => 'lata', 'stock' => 100, 'destacado' => false, 'activo' => true],
            ['categoria_id' => 7, 'nombre' => 'Atún La Campagnola', 'descripcion' => 'Atún al natural pack x3', 'precio' => 3850.00, 'unidad' => 'pack', 'stock' => 90, 'destacado' => false, 'activo' => true],
            
            // Limpieza (categoria_id: 8)
            ['categoria_id' => 8, 'nombre' => 'Detergente Skip', 'descripcion' => 'Detergente líquido Skip 3L', 'precio' => 8900.00, 'unidad' => 'botella', 'stock' => 60, 'destacado' => true, 'activo' => true],
            ['categoria_id' => 8, 'nombre' => 'Cif Crema', 'descripcion' => 'Crema de limpieza Cif 500ml', 'precio' => 2650.00, 'unidad' => 'botella', 'stock' => 80, 'destacado' => false, 'activo' => true],
            ['categoria_id' => 8, 'nombre' => 'Papel Higiénico Elite', 'descripcion' => 'Papel higiénico Elite x12 rollos', 'precio' => 6500.00, 'unidad' => 'pack', 'stock' => 100, 'destacado' => false, 'activo' => true],
            ['categoria_id' => 8, 'nombre' => 'Ayudín Limpiador', 'descripcion' => 'Ayudín limpiador 1L', 'precio' => 2200.00, 'unidad' => 'botella', 'stock' => 70, 'destacado' => false, 'activo' => true],
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}
