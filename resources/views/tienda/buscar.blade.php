@extends('layouts.app')

@section('title', 'Búsqueda: ' . $query . ' - Supermercado Online')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Búsqueda</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Sidebar de categorías -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-list"></i> Categorías</h5>
                </div>
                <div class="list-group list-group-flush">
                    @foreach($categorias as $cat)
                        <a href="{{ route('categoria', $cat->id) }}" class="list-group-item list-group-item-action">
                            {{ $cat->nombre }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Resultados de búsqueda -->
        <div class="col-md-9">
            <div class="mb-4">
                <h2><i class="fas fa-search"></i> Resultados de Búsqueda</h2>
                <p class="text-muted">Mostrando resultados para: <strong>"{{ $query }}"</strong></p>
                <span class="badge bg-secondary">{{ $productos->total() }} productos encontrados</span>
            </div>

            <div class="row g-4">
                @forelse($productos as $producto)
                    <div class="col-md-4 col-sm-6">
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
                                <p class="card-text text-muted small flex-grow-1">{{ Str::limit($producto->descripcion, 100) }}</p>
                                <div class="mb-2">
                                    <span class="badge bg-primary">{{ $producto->categoria->nombre }}</span>
                                </div>
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
                                    <small class="text-warning mt-2"><i class="fas fa-exclamation-circle"></i> Últimas {{ $producto->stock }} unidades</small>
                                @else
                                    <small class="text-success mt-2"><i class="fas fa-check-circle"></i> Disponible</small>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="card text-center py-5">
                            <div class="card-body">
                                <i class="fas fa-search fa-5x text-muted mb-4"></i>
                                <h3 class="mb-3">No se encontraron resultados</h3>
                                <p class="text-muted mb-4">No hemos encontrado productos que coincidan con tu búsqueda "{{ $query }}"</p>
                                <a href="{{ route('inicio') }}" class="btn btn-primary">
                                    <i class="fas fa-home"></i> Volver al Inicio
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Paginación -->
            <div class="mt-4 d-flex justify-content-center">
                {{ $productos->links() }}
            </div>
        </div>
    </div>
@endsection
