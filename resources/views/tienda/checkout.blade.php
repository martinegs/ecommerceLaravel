@extends('layouts.app')

@section('title', 'Finalizar Compra - Supermercado Online')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('carrito.index') }}">Carrito</a></li>
            <li class="breadcrumb-item active">Checkout</li>
        </ol>
    </nav>

    <h2 class="mb-4"><i class="fas fa-credit-card"></i> Finalizar Compra</h2>

    <div class="row">
        <!-- Formulario de datos -->
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user"></i> Datos de Entrega</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('pedido.procesar') }}" method="POST" id="checkoutForm">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                   id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="telefono" class="form-label">Teléfono <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control @error('telefono') is-invalid @enderror" 
                                       id="telefono" name="telefono" value="{{ old('telefono') }}" required>
                                @error('telefono')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección de Entrega <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('direccion') is-invalid @enderror" 
                                      id="direccion" name="direccion" rows="3" required>{{ old('direccion') }}</textarea>
                            <small class="form-text text-muted">Incluye calle, número, piso, ciudad y código postal</small>
                            @error('direccion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> <strong>Nota:</strong> Este es un proyecto de demostración. 
                            No se procesarán pagos reales.
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-check-circle"></i> Confirmar Pedido
                            </button>
                            <a href="{{ route('carrito.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Volver al Carrito
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Resumen del pedido -->
        <div class="col-md-5">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0"><i class="fas fa-list"></i> Resumen del Pedido</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3" style="max-height: 300px; overflow-y: auto;">
                        @foreach($items as $item)
                            <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">{{ $item->producto->nombre }}</h6>
                                    <small class="text-muted">Cantidad: {{ $item->cantidad }} x ${{ number_format($item->precio, 2) }}</small>
                                </div>
                                <strong>${{ number_format($item->cantidad * $item->precio, 2) }}</strong>
                            </div>
                        @endforeach
                    </div>

                    <hr>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Envío:</span>
                        <span class="text-success">GRATIS</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span>IVA (21%):</span>
                        <span>${{ number_format($total * 0.21, 2) }}</span>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <strong class="fs-5">Total:</strong>
                        <strong class="text-primary fs-4">${{ number_format($total * 1.21, 2) }}</strong>
                    </div>

                    <div class="alert alert-success small mb-0">
                        <i class="fas fa-truck"></i> <strong>Entrega estimada:</strong> 24-48 horas
                    </div>
                </div>
            </div>

            <!-- Métodos de pago aceptados -->
            <div class="card mt-3">
                <div class="card-body text-center">
                    <h6 class="mb-3">Métodos de Pago Aceptados</h6>
                    <div class="d-flex justify-content-center gap-3">
                        <i class="fab fa-cc-visa fa-2x text-primary"></i>
                        <i class="fab fa-cc-mastercard fa-2x text-warning"></i>
                        <i class="fab fa-cc-paypal fa-2x text-info"></i>
                        <i class="fas fa-credit-card fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
