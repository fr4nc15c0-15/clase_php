# BookMarket (Symfony 6 - nivel DAW)

Proyecto didáctico SIMPLE para explicar en clase cómo montar una aplicación web con Symfony 6, Doctrine, Twig, MySQL, migraciones y login.

## 1) Estructura del proyecto

- `src/Entity`: entidades Doctrine (`Usuario`, `Libro`, `Categoria`, `Mensaje`, `Valoracion`, `Pedido`).
- `src/Controller`: controladores (`Home`, `Security`, `Libro`, `Categoria`).
- `src/Form`: formularios Symfony (`LibroType`, `CategoriaType`).
- `src/Security`: autenticador de login.
- `templates`: vistas Twig.
- `config/packages`: configuración de framework, doctrine, twig y security.
- `migrations`: migración inicial SQL.

## 2) Comandos Symfony (paso a paso)

> Estos comandos son los que usarías en local para construirlo desde cero.

```bash
# 1. Crear proyecto
composer create-project symfony/skeleton:"6.4.*" BookMarket
cd BookMarket

# 2. Instalar paquetes principales
composer require twig orm maker --dev
composer require symfony/security-bundle symfony/form symfony/validator doctrine/doctrine-migrations-bundle

# 3. Configurar base de datos en .env
# DATABASE_URL="mysql://root:root@127.0.0.1:3306/bookmarket?serverVersion=8.0&charset=utf8mb4"

# 4. Crear entidades y migraciones
php bin/console make:entity
php bin/console make:migration
php bin/console doctrine:migrations:migrate

# 5. Crear login
php bin/console make:user
php bin/console make:auth

# 6. CRUD de Libro y Categoria
php bin/console make:crud Libro
php bin/console make:crud Categoria

# 7. Levantar servidor
symfony server:start
```

## 3) Relaciones del modelo (explicación fácil)

- **Usuario 1:N Libro**: un usuario puede publicar muchos libros.
- **Libro N:1 Categoria**: cada libro pertenece a una categoría.
- **Usuario 1:N Pedido**: un usuario puede tener muchos pedidos.
- **Pedido N:1 Usuario**: cada pedido pertenece a un único usuario.

## 4) Cómo funciona Doctrine ORM

Doctrine ORM convierte objetos PHP en filas de base de datos:

1. Tú creas una clase en `src/Entity`.
2. Añades atributos `#[ORM\Column]`, `#[ORM\OneToMany]`, etc.
3. Doctrine genera SQL de migración.
4. En controlador, guardas con:
   - `$entityManager->persist($objeto)`
   - `$entityManager->flush()`
5. Para leer, usas repositorios (`find`, `findAll`, `findBy`).

Idea clave para entrevista: **trabajamos con objetos, Doctrine traduce a SQL**.

## 5) Cómo funciona el login

1. El usuario entra en `/login`.
2. Envia email, password y token CSRF.
3. `LoginFormAuthenticator` crea un `Passport`.
4. Symfony busca usuario por email (provider en `security.yaml`).
5. Compara contraseña con hash.
6. Si es correcto, crea sesión y redirige.
7. `access_control` protege rutas privadas.

## 6) Validaciones usadas

- `NotBlank`: campos obligatorios.
- `Email`: email válido en Usuario.
- `Positive`: precio, total y puntuación positiva.

## 7) Rutas principales

- `/` portada.
- `/login` formulario login.
- `/libro/*` CRUD de libros (protegido).
- `/categoria/*` CRUD de categorías (protegido).

## 8) Memoria técnica (texto listo)

Ver `docs/memoria_tecnica.md`.

## 9) Preguntas de entrevista oral (respuestas preparadas)

Ver `docs/entrevista_oral.md`.
