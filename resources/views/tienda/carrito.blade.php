@extends('layouts.app')

@section('title', 'Carrito de Compras - Supermercado Online')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4"><i class="fas fa-shopping-cart"></i> Mi Carrito de Compras</h2>
        </div>
    </div>

    @if($items->count() > 0)
        <div class="row">
            <!-- Items del carrito -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @foreach($items as $item)
                            <div class="row align-items-center border-bottom py-3">
                                <div class="col-md-2">
                                    @if($item->producto->imagen)
                                        <img src="{{ asset('storage/' . $item->producto->imagen) }}" class="img-fluid rounded" alt="{{ $item->producto->nombre }}">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 80px;">
                                            <i class="fas fa-box fa-2x text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <h5 class="mb-1">{{ $item->producto->nombre }}</h5>
                                    <small class="text-muted">{{ $item->producto->categoria->nombre }}</small>
                                </div>
                                <div class="col-md-2">
                                    <p class="mb-0 fw-bold">${{ number_format($item->precio, 2) }}</p>
                                    <small class="text-muted">por {{ $item->producto->unidad }}</small>
                                </div>
                                <div class="col-md-2">
                                    <form action="{{ route('carrito.actualizar', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="input-group input-group-sm">
                                            <input type="number" name="cantidad" class="form-control text-center" value="{{ $item->cantidad }}" min="1" max="{{ $item->producto->stock }}" onchange="this.form.submit()">
                                        </div>
                                    </form>
                                    @if($item->cantidad > $item->producto->stock)
                                        <small class="text-danger">Stock: {{ $item->producto->stock }}</small>
                                    @endif
                                </div>
                                <div class="col-md-2 text-end">
                                    <p class="mb-2 fw-bold text-primary">${{ number_format($item->cantidad * $item->precio, 2) }}</p>
                                    <form action="{{ route('carrito.eliminar', $item->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este producto del carrito?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach

                        <div class="mt-3">
                            <form action="{{ route('carrito.vaciar') }}" method="POST" onsubmit="return confirm('¿Vaciar todo el carrito?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fas fa-trash-alt"></i> Vaciar Carrito
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resumen del pedido -->
            <div class="col-md-4">
                <div class="card sticky-top" style="top: 20px;">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-file-invoice-dollar"></i> Resumen del Pedido</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span>${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Envío:</span>
                            <span>$0.00</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total:</strong>
                            <strong class="text-primary fs-4">${{ number_format($total, 2) }}</strong>
                        </div>
                        <a href="{{ route('checkout') }}" class="btn btn-primary btn-lg w-100 mb-2">
                            <i class="fas fa-credit-card"></i> Proceder al Pago
                        </a>
                        <a href="{{ route('inicio') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-arrow-left"></i> Seguir Comprando
                        </a>
                    </div>
                </div>

                <!-- Información de envío -->
                <div class="card mt-3">
                    <div class="card-body">
                        <h6 class="card-title"><i class="fas fa-truck"></i> Información de Envío</h6>
                        <ul class="list-unstyled small mb-0">
                            <li class="mb-2"><i class="fas fa-check text-success"></i> Envío gratuito en pedidos superiores a $50.000</li>
                            <li class="mb-2"><i class="fas fa-check text-success"></i> Entrega en 24-48 horas</li>
                            <li><i class="fas fa-check text-success"></i> Devolución gratuita en 14 días</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12">
                <div class="card text-center py-5">
                    <div class="card-body">
                        <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
                        <h3 class="mb-3">Tu carrito está vacío</h3>
                        <p class="text-muted mb-4">¡Comienza a agregar productos y disfruta de nuestras ofertas!</p>
                        <a href="{{ route('inicio') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-shopping-basket"></i> Ir a Comprar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
