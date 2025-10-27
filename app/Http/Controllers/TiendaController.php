<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    public function inicio()
    {
        $categorias = Categoria::where('activo', true)->get();
        $productosDestacados = Producto::where('destacado', true)
            ->where('activo', true)
            ->limit(8)
            ->get();
        
        return view('tienda.inicio', compact('categorias', 'productosDestacados'));
    }

    public function categoria($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categorias = Categoria::where('activo', true)->get();
        $productos = Producto::where('categoria_id', $id)
            ->where('activo', true)
            ->paginate(12);
        
        return view('tienda.categoria', compact('categoria', 'categorias', 'productos'));
    }

    public function producto($id)
    {
        $producto = Producto::with('categoria')->findOrFail($id);
        $productosRelacionados = Producto::where('categoria_id', $producto->categoria_id)
            ->where('id', '!=', $id)
            ->where('activo', true)
            ->limit(4)
            ->get();
        
        return view('tienda.producto', compact('producto', 'productosRelacionados'));
    }

    public function buscar(Request $request)
    {
        $query = $request->input('q');
        $categorias = Categoria::where('activo', true)->get();
        $productos = Producto::where('nombre', 'like', "%{$query}%")
            ->orWhere('descripcion', 'like', "%{$query}%")
            ->where('activo', true)
            ->paginate(12);
        
        return view('tienda.buscar', compact('productos', 'categorias', 'query'));
    }
}
