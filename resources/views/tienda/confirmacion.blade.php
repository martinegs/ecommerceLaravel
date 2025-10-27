@extends('layouts.app')

@section('title', 'Pedido Confirmado - Supermercado Online')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Mensaje de éxito -->
            <div class="card border-success mb-4">
                <div class="card-body text-center py-5">
                    <i class="fas fa-check-circle fa-5x text-success mb-4"></i>
                    <h2 class="text-success mb-3">¡Pedido Confirmado!</h2>
                    <p class="lead mb-4">Gracias por tu compra. Tu pedido ha sido procesado exitosamente.</p>
                    <div class="alert alert-light d-inline-block">
                        <strong>Número de Pedido:</strong> 
                        <span class="text-primary fs-5">{{ $pedido->numero_pedido }}</span>
                    </div>
                </div>
            </div>

            <!-- Detalles del pedido -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-user"></i> Datos del Cliente</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-2"><strong>Nombre:</strong> {{ $pedido->nombre_cliente }}</p>
                            <p class="mb-2"><strong>Email:</strong> {{ $pedido->email_cliente }}</p>
                            <p class="mb-2"><strong>Teléfono:</strong> {{ $pedido->telefono_cliente }}</p>
                            <hr>
                            <p class="mb-2"><strong>Dirección de Entrega:</strong></p>
                            <p class="mb-0 text-muted">{{ $pedido->direccion_envio }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-info-circle"></i> Estado del Pedido</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <strong>Estado Actual:</strong>
                                <span class="badge bg-warning text-dark ms-2">
                                    <i class="fas fa-clock"></i> {{ ucfirst($pedido->estado) }}
                                </span>
                            </div>
                            <div class="mb-3">
                                <strong>Fecha del Pedido:</strong>
                                <span class="text-muted">{{ $pedido->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="mb-3">
                                <strong>Total Pagado:</strong>
                                <span class="text-primary fs-5">${{ number_format($pedido->total * 1.21, 2) }}</span>
                            </div>
                            <hr>
                            <div class="alert alert-info small mb-0">
                                <i class="fas fa-truck"></i> <strong>Entrega estimada:</strong> 24-48 horas
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Productos del pedido -->
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0"><i class="fas fa-shopping-bag"></i> Productos del Pedido</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-end">Precio Unitario</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pedido->items as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($item->producto->imagen)
                                                    <img src="{{ asset('storage/' . $item->producto->imagen) }}" 
                                                         alt="{{ $item->nombre_producto }}" 
                                                         class="rounded me-3" 
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                @endif
                                                <span>{{ $item->nombre_producto }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $item->cantidad }}</td>
                                        <td class="text-end">${{ number_format($item->precio_unitario, 2) }}</td>
                                        <td class="text-end fw-bold">${{ number_format($item->subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Subtotal:</strong></td>
                                    <td class="text-end">${{ number_format($pedido->total, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>IVA (21%):</strong></td>
                                    <td class="text-end">${{ number_format($pedido->total * 0.21, 2) }}</td>
                                </tr>
                                <tr class="table-success">
                                    <td colspan="3" class="text-end"><strong class="fs-5">TOTAL:</strong></td>
                                    <td class="text-end"><strong class="text-primary fs-5">${{ number_format($pedido->total * 1.21, 2) }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Información adicional -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4 mb-3">
                            <i class="fas fa-envelope fa-2x text-primary mb-2"></i>
                            <h6>Confirmación por Email</h6>
                            <p class="small text-muted">Te hemos enviado un email con los detalles de tu pedido</p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <i class="fas fa-headset fa-2x text-success mb-2"></i>
                            <h6>Soporte 24/7</h6>
                            <p class="small text-muted">¿Necesitas ayuda? Contacta con nuestro equipo</p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <i class="fas fa-undo fa-2x text-info mb-2"></i>
                            <h6>Devolución Fácil</h6>
                            <p class="small text-muted">14 días para devolver tu pedido sin compromiso</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="text-center mb-5">
                <a href="{{ route('inicio') }}" class="btn btn-primary btn-lg me-2">
                    <i class="fas fa-home"></i> Volver al Inicio
                </a>
                <button onclick="window.print()" class="btn btn-outline-secondary btn-lg">
                    <i class="fas fa-print"></i> Imprimir Pedido
                </button>
            </div>
        </div>
    </div>
@endsection
