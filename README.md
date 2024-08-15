<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Acerca del Proyecto

Este proyecto es un CRUD de notas desarrollado en Laravel, diseñado como una prueba técnica. Incluye funcionalidades básicas para la gestión de estudiantes, materias y notas, y se implementa un seed que carga una materia llamada "Matemáticas" al ejecutar las migraciones.

## Requisitos

- PHP >= 8.0
- Composer
- MySQL o cualquier otra base de datos compatible con Laravel

## Instalación

Sigue estos pasos para configurar el proyecto en tu máquina local:

### 1. Clonar el repositorio

```bash
git clone https://github.com/ShadowYRed/crud-laravel.git
cd crud-laravel

2. Instalar dependencias de PHP con Composer
bash
Copiar código
composer install
3. Configurar el archivo .env
Copia el archivo .env.example a .env y configura las variables de entorno, especialmente la conexión a la base de datos:

bash
Copiar código
cp .env.example .env
Luego, genera una clave de aplicación:

bash
Copiar código
php artisan key:generate
4. Migrar la base de datos con seeder
Migra la base de datos y ejecuta el seeder para insertar automáticamente la materia "Matemáticas":

bash
Copiar código
php artisan migrate --seed
5. Iniciar el servidor de desarrollo
Inicia el servidor local de Laravel:

bash
Copiar código
php artisan serve
El proyecto estará disponible en http://localhost:8000.
