<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Pedido;
use App\Models\ItemPedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PedidoController extends Controller
{
    public function checkout()
    {
        $sessionId = Session::getId();
        $carrito = Carrito::where('session_id', $sessionId)->first();

        if (!$carrito || $carrito->items->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío');
        }

        $items = $carrito->items()->with('producto')->get();
        $total = $carrito->getTotal();

        return view('tienda.checkout', compact('carrito', 'items', 'total'));
    }

    public function procesar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string'
        ]);

        $sessionId = Session::getId();
        $carrito = Carrito::where('session_id', $sessionId)->first();

        if (!$carrito || $carrito->items->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío');
        }

        DB::beginTransaction();
        try {
            $total = $carrito->getTotal();

            $pedido = Pedido::create([
                'numero_pedido' => Pedido::generarNumeroPedido(),
                'nombre_cliente' => $request->nombre,
                'email_cliente' => $request->email,
                'telefono_cliente' => $request->telefono,
                'direccion_envio' => $request->direccion,
                'total' => $total,
                'estado' => 'pendiente'
            ]);

            foreach ($carrito->items as $item) {
                ItemPedido::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $item->producto_id,
                    'nombre_producto' => $item->producto->nombre,
                    'cantidad' => $item->cantidad,
                    'precio_unitario' => $item->precio,
                    'subtotal' => $item->cantidad * $item->precio
                ]);

                $producto = $item->producto;
                $producto->stock -= $item->cantidad;
                $producto->save();
            }

            $carrito->items()->delete();
            $carrito->delete();

            DB::commit();

            return redirect()->route('pedido.confirmacion', $pedido->id)->with('success', '¡Pedido realizado con éxito!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Hubo un error al procesar tu pedido. Por favor intenta nuevamente.');
        }
    }

    public function confirmacion($id)
    {
        $pedido = Pedido::with('items.producto')->findOrFail($id);
        return view('tienda.confirmacion', compact('pedido'));
    }
}
