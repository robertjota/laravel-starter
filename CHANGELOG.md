# Changelog

Todos los cambios notables de este proyecto serán documentados en este archivo.

El formato está basado en [Keep a Changelog](https://keepachangelog.com/es-ES/1.0.0/).

## [2.0.1] - 2026-03-20

### Added
- Sistema de auditoria completo con registro de actividades
- Modelo `Activity` para registrar todas las acciones de usuarios
- Modelo `AccessLog` para registrar login/logout con IP, dispositivo y navegador
- Controlador `AuditController` con vistas para actividades y logs de acceso
- `AuditPolicy` con soporte para Super Admin
- Menu de auditoria en sidebar
- Middleware `LogAccess` para captura de login
- Campo `session_id` en AccessLog para vincular login/logout

### Fixed
- Compatibilidad PHP 8.4: Corregido deprecated warning en funcion `settings()` del helper
- Corregido typo en ruta de eliminacion de permisos (`permmisions` -> `permissions`)
- Select2 removido de configuracion global (conflictaba con estilos)
- Deduplicacion de registros de acceso usando session_id
- Metodo down() duplicado en migracion de soft deletes

### Changed
- Trait `Auditable` ahora usa modelo `Activity` en lugar de solo logs
- README.md actualizado con matriz de compatibilidad PHP
- Super Admin tiene acceso total sin necesidad de permisos individuales
- Sistema de logs usa middleware en lugar de eventos (mas control)

### Refactored
- Seleccion de roles: de multi-select (checkboxes) a select unico
- Simplificada logica de actualizacion de contrasena en UserController
- Eliminada vista y metodos de asignar rol (funcionalidad unificada en edit)
- LoginController ahora maneja logout directamente

## [2.0.0] - 2026-03-17

### Added
- Actualización completa a Laravel 12
- Migración a Vite 7.x (Laravel 12 default)
- Trait `Auditable` para logs de actividad en modelos
- Scopes de modelo para filtros reutilizables
- Form Requests para validación robusta (`StoreUserRequest`, `UpdateUserRequest`, etc.)
- Policies para control de acceso (`UserPolicy`, `RolePolicy`, `PermissionPolicy`)
- Soft Deletes en modelo User
- Exportaciones Excel (Users, Roles)
- Notificaciones por email (creación/eliminación de usuarios)
- Enum `UserRole` para tipos de usuario
- Archivo de configuración `system.php` centralizado
- Traducciones completas al español
- Permisos configurables para Users, Roles y Permissions

### Changed
- Actualización de dependencias a versiones compatibles con Laravel 12
- Arreglo de vulnerabilidades npm (axios, form-data, immutable, lodash, rollup)

## [1.0.0] - 2024-01-15

### Added
- Versión inicial basada en Laravel 11
- AdminLTE 3 integrado
- Sistema de roles y permisos (Spatie)
- CRUD completo de Usuarios, Roles y Permisos
- Datatables integrada
- SweetAlert2 integrado
- Panel de administración con perfil de usuario
- Bootstrap 5
- Autenticación con Laravel UI

---

## Notas de 版本

- **[2.0.1]** - Mantenimiento: Compatibilidad PHP 8.2-8.4
- **[2.0.0]** - Major: Laravel 12 upgrade
- **[1.0.0]** - Initial: Laravel 11 base
