<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Supermercado Online')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #28a745;
            --secondary-color: #ffc107;
            --dark-color: #343a40;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background-color: var(--primary-color) !important;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        
        .card {
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,.2);
        }
        
        .product-img {
            height: 200px;
            object-fit: cover;
        }
        
        .category-card {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .price {
            color: var(--primary-color);
            font-weight: bold;
            font-size: 1.25rem;
        }
        
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--secondary-color);
            color: var(--dark-color);
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 0.75rem;
            font-weight: bold;
        }
        
        footer {
            background-color: var(--dark-color);
            color: white;
            margin-top: 50px;
        }
        
        .alert {
            border-radius: 10px;
        }
        
        .quantity-input {
            width: 80px;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('inicio') }}">
                <i class="fas fa-shopping-basket"></i> Supermercado Online
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('inicio') }}">Inicio</a>
                    </li>
                </ul>
                <form class="d-flex me-3" action="{{ route('buscar') }}" method="GET">
                    <input class="form-control me-2" type="search" name="q" placeholder="Buscar productos..." aria-label="Buscar">
                    <button class="btn btn-outline-light" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                <a href="{{ route('carrito.index') }}" class="btn btn-outline-light position-relative">
                    <i class="fas fa-shopping-cart"></i> Carrito
                    @if(session()->has('cart_count') && session('cart_count') > 0)
                        <span class="cart-badge">{{ session('cart_count') }}</span>
                    @endif
                </a>
            </div>
        </div>
    </nav>

    <!-- Mensajes de alerta -->
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <!-- Contenido principal -->
    <main class="container my-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="fas fa-shopping-basket"></i> Supermercado Online</h5>
                    <p>Tu supermercado de confianza desde la comodidad de tu hogar.</p>
                </div>
                <div class="col-md-4">
                    <h5>Información</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white text-decoration-none">Sobre Nosotros</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Envíos</a></li>
                        <li><a href="#" class="text-white text-decoration-none">Términos y Condiciones</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contacto</h5>
                    <p>
                        <i class="fas fa-phone"></i> +34 123 456 789<br>
                        <i class="fas fa-envelope"></i> info@supermercado.com
                    </p>
                </div>
            </div>
            <hr class="bg-light">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} Supermercado Online. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
