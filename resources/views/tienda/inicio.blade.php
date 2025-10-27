@extends('layouts.app')

@section('title', 'Inicio - Supermercado Online')

@section('content')
    <!-- Banner principal -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="bg-primary text-white p-5 rounded text-center">
                <h1 class="display-4"><i class="fas fa-shopping-basket"></i> Bienvenido a tu Supermercado Online</h1>
                <p class="lead">Los mejores productos frescos y de calidad directamente a tu hogar</p>
            </div>
        </div>
    </div>

    <!-- Categorías -->
    <section class="mb-5">
        <h2 class="mb-4"><i class="fas fa-th-large"></i> Categorías</h2>
        <div class="row g-4">
            @forelse($categorias as $categoria)
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('categoria', $categoria->id) }}" class="text-decoration-none">
                        <div class="card category-card">
                            @if($categoria->imagen)
                                <img src="{{ asset($categoria->imagen) }}" class="card-img-top" alt="{{ $categoria->nombre }}" style="height: 150px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body text-center">
                                <h5 class="card-title text-dark">{{ $categoria->nombre }}</h5>
                                @if($categoria->descripcion)
                                    <p class="card-text text-muted small">{{ Str::limit($categoria->descripcion, 60) }}</p>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> No hay categorías disponibles en este momento.
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Productos destacados -->
    <section class="mb-5">
        <h2 class="mb-4"><i class="fas fa-star"></i> Productos Destacados</h2>
        <div class="row g-4">
            @forelse($productosDestacados as $producto)
                <div class="col-md-3 col-sm-6">
                    <div class="card h-100">
                        @if($producto->imagen)
                            <img src="{{ asset($producto->imagen) }}" class="card-img-top product-img" alt="{{ $producto->nombre }}">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center product-img">
                                <i class="fas fa-box fa-3x text-muted"></i>
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            <p class="card-text text-muted small flex-grow-1">{{ Str::limit($producto->descripcion, 80) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="price">${{ number_format($producto->precio, 2) }}</span>
                                <small class="text-muted">{{ $producto->unidad }}</small>
                            </div>
                            <div class="d-flex gap-2 mt-3">
                                <a href="{{ route('producto', $producto->id) }}" class="btn btn-outline-primary btn-sm flex-grow-1">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                                <form action="{{ route('carrito.agregar') }}" method="POST" class="flex-grow-1">
                                    @csrf
                                    <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                    <input type="hidden" name="cantidad" value="1">
                                    <button type="submit" class="btn btn-primary btn-sm w-100" @if($producto->stock <= 0) disabled @endif>
                                        <i class="fas fa-cart-plus"></i> Agregar
                                    </button>
                                </form>
                            </div>
                            @if($producto->stock <= 0)
                                <small class="text-danger mt-2"><i class="fas fa-exclamation-triangle"></i> Sin stock</small>
                            @elseif($producto->stock < 10)
                                <small class="text-warning mt-2"><i class="fas fa-exclamation-circle"></i> Últimas unidades</small>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> No hay productos destacados en este momento.
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Ventajas -->
    <section class="mb-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card text-center border-0 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-truck fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Envío Rápido</h5>
                        <p class="card-text">Recibe tus productos en 24-48 horas</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center border-0 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-leaf fa-3x text-success mb-3"></i>
                        <h5 class="card-title">Productos Frescos</h5>
                        <p class="card-text">Calidad garantizada en todos nuestros productos</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center border-0 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-shield-alt fa-3x text-info mb-3"></i>
                        <h5 class="card-title">Compra Segura</h5>
                        <p class="card-text">Tus datos protegidos en todo momento</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
