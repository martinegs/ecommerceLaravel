@extends('layouts.app')

@section('title', $producto->nombre . ' - Supermercado Online')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('categoria', $producto->categoria_id) }}">{{ $producto->categoria->nombre }}</a></li>
            <li class="breadcrumb-item active">{{ $producto->nombre }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Imagen del producto -->
        <div class="col-md-6 mb-4">
            <div class="card">
                @if($producto->imagen)
                    <img src="{{ asset($producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}" style="max-height: 500px; object-fit: contain;">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 500px;">
                        <i class="fas fa-box fa-5x text-muted"></i>
                    </div>
                @endif
            </div>
        </div>

        <!-- Detalles del producto -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    @if($producto->destacado)
                        <span class="badge bg-warning text-dark mb-2">
                            <i class="fas fa-star"></i> Destacado
                        </span>
                    @endif
                    
                    <h1 class="card-title mb-3">{{ $producto->nombre }}</h1>
                    
                    <div class="mb-3">
                        <span class="badge bg-primary">{{ $producto->categoria->nombre }}</span>
                    </div>

                    <div class="mb-4">
                        <h2 class="price mb-0">${{ number_format($producto->precio, 2) }}</h2>
                        <small class="text-muted">Precio por {{ $producto->unidad }}</small>
                    </div>

                    @if($producto->descripcion)
                        <div class="mb-4">
                            <h5>Descripción</h5>
                            <p class="text-muted">{{ $producto->descripcion }}</p>
                        </div>
                    @endif

                    <div class="mb-4">
                        <h5>Disponibilidad</h5>
                        @if($producto->stock <= 0)
                            <span class="badge bg-danger">
                                <i class="fas fa-times-circle"></i> Sin stock
                            </span>
                        @elseif($producto->stock < 10)
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-exclamation-circle"></i> Últimas {{ $producto->stock }} unidades
                            </span>
                        @else
                            <span class="badge bg-success">
                                <i class="fas fa-check-circle"></i> En stock ({{ $producto->stock }} disponibles)
                            </span>
                        @endif
                    </div>

                    @if($producto->stock > 0)
                        <form action="{{ route('carrito.agregar') }}" method="POST">
                            @csrf
                            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                            <div class="mb-4">
                                <label for="cantidad" class="form-label"><strong>Cantidad:</strong></label>
                                <div class="input-group" style="max-width: 200px;">
                                    <button type="button" class="btn btn-outline-secondary" onclick="decrementar()">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" class="form-control text-center" id="cantidad" name="cantidad" value="1" min="1" max="{{ $producto->stock }}">
                                    <button type="button" class="btn btn-outline-secondary" onclick="incrementar({{ $producto->stock }})">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-cart-plus"></i> Agregar al Carrito
                            </button>
                        </form>
                    @else
                        <button class="btn btn-secondary btn-lg w-100" disabled>
                            <i class="fas fa-times-circle"></i> Producto no disponible
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Productos relacionados -->
    @if($productosRelacionados->count() > 0)
        <section class="mt-5">
            <h3 class="mb-4"><i class="fas fa-box-open"></i> Productos Relacionados</h3>
            <div class="row g-4">
                @foreach($productosRelacionados as $relacionado)
                    <div class="col-md-3 col-sm-6">
                        <div class="card h-100">
                            @if($relacionado->imagen)
                                <img src="{{ asset($relacionado->imagen) }}" class="card-img-top product-img" alt="{{ $relacionado->nombre }}">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center product-img">
                                    <i class="fas fa-box fa-3x text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $relacionado->nombre }}</h5>
                                <p class="card-text text-muted small flex-grow-1">{{ Str::limit($relacionado->descripcion, 60) }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="price">${{ number_format($relacionado->precio, 2) }}</span>
                                    <small class="text-muted">{{ $relacionado->unidad }}</small>
                                </div>
                                <a href="{{ route('producto', $relacionado->id) }}" class="btn btn-outline-primary btn-sm mt-3">
                                    <i class="fas fa-eye"></i> Ver Producto
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
@endsection

@section('scripts')
<script>
    function incrementar(max) {
        let input = document.getElementById('cantidad');
        let valor = parseInt(input.value);
        if (valor < max) {
            input.value = valor + 1;
        }
    }

    function decrementar() {
        let input = document.getElementById('cantidad');
        let valor = parseInt(input.value);
        if (valor > 1) {
            input.value = valor - 1;
        }
    }
</script>
@endsection
