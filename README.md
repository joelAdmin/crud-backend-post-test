# CRUD Backend API REST (Posts & Comments) - Laravel 11 + Docker + Uso de Swagger

[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)](https://docker.com)
[![Swagger](https://img.shields.io/badge/Swagger-85EA2D?style=for-the-badge&logo=swagger&logoColor=black)](https://swagger.io)

API RESTful para gestión de posts y comentarios con autenticación mediante Laravel Sanctum.

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

## 📋 Características
- CRUD completo para Posts y Comments
- Autenticación con Laravel Sanctum
- Documentación Swagger/OpenAPI
- Entorno Dockerizado (Nginx + MariaDB + PHPMyAdmin)
- Migraciones y Seeders
- Validación de datos con Form Requests
- Relaciones Eloquent (Post -> Comments)

## 🚀 Requisitos Previos
- Docker >= 20.10
- Docker Compose >= 2.23
- Git

## 🛠️ Instalación

### 1. Clonar Repositorio
```bash
git clone https://github.com/joelAdmin/crud-backend-post-test.git

```

### 2. Configurar Docker y Levantar Servicios

```sh
docker-compose up -d
```

### 2. Verificar contenedores activos:

```sh
docker-compose ps
```


---

### 📌 Notas Adicionales:
1. **Rutas API**: En Laravel 11 deberás crear manualmente `routes/api.php` y registrar las rutas en `bootstrap/app.php`.

2. **Seguridad**: 
   - Cambiar credenciales de DB en producción
   - Usar variables de entorno para datos sensibles

3. **Frontend**: El directorio `frontend/` está preparado para integrar con React/Vue/Next.js

4. **PHPMyAdmin**: Accesible en http://localhost:8080 (usuario: `root`, contraseña: `root`)

¡Listo para clonar y usar! 🎉
