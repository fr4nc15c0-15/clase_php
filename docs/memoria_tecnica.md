# Memoria técnica - BookMarket

## Objetivo
Desarrollar una aplicación web sencilla para gestionar libros y categorías con autenticación.

## Stack tecnológico
- PHP 8
- Symfony 6
- Doctrine ORM
- Twig
- MySQL
- Doctrine Migrations

## Arquitectura
Se utiliza patrón MVC:
- Modelo: entidades Doctrine.
- Vista: Twig.
- Controlador: clases en `src/Controller`.

## Seguridad
- Login por email + contraseña.
- Contraseñas hasheadas.
- Protección CSRF en login y borrado.
- Control de acceso por rutas.

## Persistencia
Las entidades se mapearon con atributos PHP 8. La estructura SQL se despliega mediante migraciones versionadas.

## Conclusión
El proyecto cumple funcionalidades mínimas DAW y es fácilmente ampliable.
