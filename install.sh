#!/bin/bash

# Script de instalación para Supermercado Online
# Para sistemas Unix/Linux/Mac

echo "🛒 Instalando Supermercado Online..."
echo ""

# Verificar si existe composer
if ! command -v composer &> /dev/null
then
    echo "❌ Composer no está instalado. Por favor instala Composer primero."
    echo "Visita: https://getcomposer.org/download/"
    exit 1
fi

# Verificar si existe PHP
if ! command -v php &> /dev/null
then
    echo "❌ PHP no está instalado. Por favor instala PHP 8.1 o superior."
    exit 1
fi

# Verificar versión de PHP
PHP_VERSION=$(php -r "echo PHP_VERSION;" | cut -d "." -f 1,2)
if (( $(echo "$PHP_VERSION < 8.1" | bc -l) )); then
    echo "❌ Se requiere PHP 8.1 o superior. Versión actual: $PHP_VERSION"
    exit 1
fi

echo "✅ Composer encontrado"
echo "✅ PHP $PHP_VERSION encontrado"
echo ""

# Instalar dependencias
echo "📦 Instalando dependencias de Composer..."
composer install

# Copiar archivo .env
if [ ! -f .env ]; then
    echo "📝 Copiando archivo de configuración..."
    cp .env.example .env
else
    echo "⚠️  Archivo .env ya existe, omitiendo..."
fi

# Generar clave de aplicación
echo "🔑 Generando clave de aplicación..."
php artisan key:generate

# Crear base de datos SQLite
if [ ! -f database/database.sqlite ]; then
    echo "🗄️  Creando base de datos SQLite..."
    touch database/database.sqlite
else
    echo "⚠️  Base de datos ya existe, omitiendo..."
fi

# Ejecutar migraciones y seeders
echo "🔄 Ejecutando migraciones y seeders..."
read -p "¿Deseas ejecutar las migraciones? Esto creará las tablas y datos de prueba (s/n): " -n 1 -r
echo
if [[ $REPLY =~ ^[Ss]$ ]]
then
    php artisan migrate:fresh --seed
    echo "✅ Base de datos configurada con datos de prueba"
fi

echo ""
echo "✅ ¡Instalación completada!"
echo ""
echo "Para iniciar el servidor de desarrollo:"
echo "  php artisan serve"
echo ""
echo "La aplicación estará disponible en:"
echo "  http://localhost:8000"
echo ""
echo "🚀 ¡Listo para usar!"
