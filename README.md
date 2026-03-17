# Laravel Starter
Admin Panel basado en Laravel, bootstrap 5, adminLTE 3 con roles y permisos integrado

## Historial de Versiones

- **v2.0.0** (actual): Mejoras y nuevas funcionalidades
- **Laravel 12**: Actualizado a Laravel 12.x
- **Laravel 11**: Versión anterior disponible en tag `v1.0-laravel11`

## Características v2.0.0

### Funcionalidades Core
- jeroennoten/Laravel-AdminLTE
- Roles y permisos basado en Laravel Permissions (Spatie)
- Datatables integrada
- SweetAlert2 integrado
- Exportación Excel (Users, Roles)
- Notificaciones por email

### Mejoras de Código
- **Form Requests**: Validación robusta y reutilizable
- **Laravel Policies**: Control de acceso seguro
- **Soft Deletes**: Recuperar registros eliminados
- **Auditable Trait**: Logs de actividad
- **Model Scopes**: Filtros reutilizables
- **API Resources**: Para consumo API
- **Helpers**: Funciones utilitarias
- **Traducciones**: Español completo
- **Constantes/Enums**: Valores centralizados

## Requisitos

- PHP 8.2+
- Composer 2.0+
- Node.js 18+
- MySQL 8.0+

### Instalación

_Clone el repositorio_

```
git clone https://github.com/robertjota/laravel-starter.git
```

_Instale todas las dependencias del Proyecto con_

```
composer install
```

_Actualice las dependencias de Composer con_

```
composer update
```

_Como el proyecto tiene dependencias en JS instálelas con_

```
npm install
```

_Actualice las dependencias de NPM con_

```
npm update
```

_Compile CSS y JS_

```
npm run dev
o
npm run build
```

_Copie el Archivo .env.example en un archivo nuevo .env con_

```
cp .env.example .env
```

_Configure la base de datos y las demás variables de entorno en el archivo .env_

_Genere una nueva Key para el proyecto con_

```
php artisan key:generate
```

_Ejecute las migraciones (incluye Soft Deletes)_

```
php artisan migrate
```

_Corra los seeder del proyecto con_

```
php artisan db:seed
```

_Corra el proyecto con_

```
php artisan serve
```

_Si todo está correcto puede acceder al proyecto en la dirección http://localhost:8000_

### Usuarios de prueba

| Rol | Email | Contraseña |
|-----|-------|------------|
| Super Admin | superadmin@gmail.com | password |
| Admin | admin@gmail.com | password |
| Usuario | usuario@gmail.com | password |

### Personalización

El sistema base está diseñado para ser personalizado. Puedes modificar lo que requieras para adaptar el sistema a tus necesidades.

Desarrolle esta base porque no encontré una que se adaptara a lo que yo necesitaba y que realmente ahorrara tiempo para nuevos desarrollos, espero les sea útil sobre todo a los que se inician con Laravel.

### Contribuir

Las contribuciones son bienvenidas. Puedes reportar problemas o enviar pull requests en el repositorio de GitHub.

### Licencia
Este proyecto está bajo la licencia MIT.

---
[Robert Arias](https://github.com/robertjota)
_Desarrollador de Sistemas_
