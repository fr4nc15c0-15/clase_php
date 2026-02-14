# Preguntas y respuestas para entrevista oral

## 1) ¿Qué es Symfony?
Framework PHP que aporta estructura profesional, componentes reutilizables y buenas prácticas.

## 2) ¿Qué es Doctrine ORM?
Una capa que permite trabajar con objetos PHP en lugar de escribir SQL manual en cada operación.

## 3) ¿Qué hace una migración?
Versiona cambios de base de datos para poder aplicar/revertir estructura de forma controlada.

## 4) ¿Cómo protegiste rutas?
Con `access_control` en `security.yaml`, permitiendo `/login` pública y el resto autenticado.

## 5) ¿Qué validaciones usaste?
`NotBlank`, `Email`, `Positive` en atributos de entidad.

## 6) ¿Qué diferencia hay entre entidad y repositorio?
Entidad representa datos; repositorio encapsula consultas a base de datos.

## 7) ¿Por qué usar Twig?
Separa presentación de lógica, mejora mantenimiento y seguridad (escape HTML por defecto).

## 8) ¿Cómo se guarda un libro?
Con formulario Symfony -> validación -> `persist()` -> `flush()`.

## 9) ¿Qué papel tiene `base.html.twig`?
Layout común con menú, flashes y bloques reutilizables.

## 10) ¿Cómo se gestionan roles?
Campo `rol` en `Usuario` y método `getRoles()` adaptado al formato de Symfony.
