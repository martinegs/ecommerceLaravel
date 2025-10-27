<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\ItemCarrito;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CarritoController extends Controller
{
    private function obtenerCarrito()
    {
        $sessionId = Session::getId();
        $carrito = Carrito::where('session_id', $sessionId)->first();

        if (!$carrito) {
            $carrito = Carrito::create([
                'session_id' => $sessionId
            ]);
        }

        return $carrito;
    }

    public function index()
    {
        $carrito = $this->obtenerCarrito();
        $items = $carrito->items()->with('producto')->get();
        $total = $carrito->getTotal();

        return view('tienda.carrito', compact('carrito', 'items', 'total'));
    }

    public function agregar(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1'
        ]);

        $producto = Producto::findOrFail($request->producto_id);
        
        if ($producto->stock < $request->cantidad) {
            return back()->with('error', 'No hay suficiente stock disponible');
        }

        $carrito = $this->obtenerCarrito();
        
        $itemExistente = ItemCarrito::where('carrito_id', $carrito->id)
            ->where('producto_id', $producto->id)
            ->first();

        if ($itemExistente) {
            $itemExistente->cantidad += $request->cantidad;
            $itemExistente->save();
        } else {
            ItemCarrito::create([
                'carrito_id' => $carrito->id,
                'producto_id' => $producto->id,
                'cantidad' => $request->cantidad,
                'precio' => $producto->precio
            ]);
        }

        return back()->with('success', 'Producto agregado al carrito');
    }

    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1'
        ]);

        $item = ItemCarrito::findOrFail($id);
        
        if ($item->producto->stock < $request->cantidad) {
            return back()->with('error', 'No hay suficiente stock disponible');
        }

        $item->cantidad = $request->cantidad;
        $item->save();

        return back()->with('success', 'Carrito actualizado');
    }

    public function eliminar($id)
    {
        $item = ItemCarrito::findOrFail($id);
        $item->delete();

        return back()->with('success', 'Producto eliminado del carrito');
    }

    public function vaciar()
    {
        $carrito = $this->obtenerCarrito();
        $carrito->items()->delete();

        return back()->with('success', 'Carrito vaciado');
    }
}
