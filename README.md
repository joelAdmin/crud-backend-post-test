# CRUD Backend con Laravel 11 y Docker

Este proyecto es un backend basado en Laravel 11 para la gestión de Posts y Comments, utilizando Docker para la virtualización de servicios. Incluye autenticación con Laravel Sanctum y documentación API con Swagger.

## 📌 Características

- CRUD de Posts y Comments.
- Autenticación con Laravel Sanctum.
- Contenedores Docker para backend, base de datos y Nginx.
- Documentación de API con Swagger.
- Uso de Laravel Resources y Requests para validación.

## 📂 Estructura del Proyecto

```
/
├── .dockerignore
├── .gitignore
├── README.md
├── docker-compose.yml
├── Dockerfile
├── nginx/
│   └── nginx.conf
├── backend/  (Aplicación Laravel 11)
│   ├── .env.example
│   ├── composer.json
│   └── (estructura de Laravel)
└── mdbdata/  (Datos de la base de datos, ignorados en Git)
```

## 🚀 Instalación y Configuración

### 1️⃣ Clonar el Repositorio

```sh
git clone https://github.com/joelAdmin/crud-backend-post-test.git
cd crud-backend-post-test
```

### 2️⃣ Configurar Docker y Levantar Servicios

```sh
docker-compose up -d
```

Verificar contenedores activos:

```sh
docker ps
```

### 3️⃣ Crear el Proyecto Laravel (si es necesario)

```sh
docker-compose run --rm -u root backend composer create-project laravel/laravel:^11.0 . --ignore-platform-reqs
```

### 4️⃣ Configurar la Base de Datos

Modificar `.env` en `backend/`:

```
DB_HOST=db
DB_PORT=3306
DB_DATABASE=postDb
DB_USERNAME=root
DB_PASSWORD=root
```

Ejecutar migraciones:

```sh
docker-compose exec backend php artisan migrate
```

### 5️⃣ Crear Modelos y Relaciones

```sh
docker-compose exec backend php artisan make:model Post -m
```

```sh
docker-compose exec backend php artisan make:model Comment -m
```

Ejecutar nuevamente las migraciones:

```sh
docker-compose exec backend php artisan migrate
```

### 6️⃣ Configurar Autenticación con Sanctum

```sh
docker-compose exec backend composer require laravel/sanctum
```

Publicar configuración y migrar:

```sh
docker-compose exec backend php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
docker-compose exec backend php artisan migrate
```

### 7️⃣ Crear Controladores y Rutas

```sh
docker-compose exec backend php artisan make:controller PostController
```

En `routes/web.php`, definir las rutas de la API:

```php
use App\Http\Controllers\PostController;

Route::apiResource('posts', PostController::class);
```

### 8️⃣ Generar Documentación API con Swagger

```sh
docker-compose exec backend composer require darkaonline/l5-swagger
```

```sh
docker-compose exec backend php artisan l5-swagger:generate
```

Acceder a la documentación en `http://localhost/api/documentation`

### 9️⃣ Crear Usuarios de Prueba con Seeder

```sh
docker-compose exec backend php artisan make:seeder UserSeeder
```

```sh
docker-compose exec backend php artisan migrate --seed
```

### 🔥 Probar API con Postman

#### Login

**Endpoint:** `POST http://localhost/api/login`

**Body:**
```json
{
    "email": "admin@example.com",
    "password": "password123"
}
```

---

Este `README.md` está diseñado para guiar a cualquier desarrollador en la instalación, despliegue y uso del proyecto. ¡Déjame saber si necesitas ajustes! 🚀
