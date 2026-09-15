# Centro Barrial El General — versión con MySQL + PHP

Esta versión reemplaza los datos escritos en los archivos JavaScript por una base de datos MySQL/MariaDB y agrega un panel de administración en PHP.

## Qué incluye

- `index.php`: página inicial con las categorías.
- `categoria.php?slug=musica`: página dinámica de cada categoría.
- `database.sql`: estructura, categorías y datos de ejemplo.
- `config.php`: conexión a MySQL y configuración.
- `admin/login.php`: acceso al panel.
- `admin/index.php`: dashboard.
- `admin/cursos.php`: listar, publicar/ocultar y eliminar cursos.
- `admin/curso-form.php`: agregar y editar cursos, incluyendo subida del flyer.
- `admin/logout.php`: cerrar sesión.
- `includes/auth.php`: sesión y protección CSRF.
- `assets/flyers/`: carpeta donde se guardan los flyers subidos.
- `css/style.css`: estilos públicos.
- `css/admin.css`: estilos del panel.

## Importante: hay 8 categorías

En la lista original se mencionaron "7 categorías", pero se enumeraron 8. En esta versión se cargan las 8 categorías enumeradas:

1. Apoyo y formación
2. Arte y expresión
3. Artesanías y oficios creativos
4. Bienestar y salud
5. Cocina, huerta y alimentación
6. Movimiento y expresión
7. Música
8. Informática y tecnología

Si Informática no debe ser una categoría independiente, eliminála de `database.sql` o desde la base de datos.

## Instalación en XAMPP/WAMP

1. Copiá la carpeta `centro-barrial-db` dentro de `htdocs`.
2. Iniciá Apache y MySQL.
3. Abrí phpMyAdmin.
4. Importá `database.sql`.
5. Revisá `config.php` y colocá usuario/contraseña de MySQL si son diferentes.
6. Abrí `http://localhost/centro-barrial-db/`.
7. Panel: `http://localhost/centro-barrial-db/admin/login.php`.

## Instalación en hosting

Necesitás un hosting con PHP, MySQL/MariaDB y PDO MySQL habilitado.

1. Creá una base de datos desde el panel del hosting.
2. Importá `database.sql` en esa base.
3. Subí los archivos del proyecto.
4. Modificá `config.php` con los datos reales de la base:
   - `DB_HOST`
   - `DB_NAME`
   - `DB_USER`
   - `DB_PASS`
5. Si el proyecto está en una subcarpeta, configurá `BASE_URL`.
6. Verificá que `assets/flyers/` tenga permisos para que PHP pueda guardar imágenes.

## Acceso inicial

Usuario: `admin`

Contraseña: `admin123`

**Cambiala antes de usar el sitio en producción.**

## Cómo funciona ahora

Ya no necesitás tener un `musica.js`, `cocina.js`, etc. con los datos de cada curso.

La información queda en MySQL:

`categorias` → define las categorías.

`cursos` → guarda cada curso y su categoría.

Cuando alguien entra a:

`categoria.php?slug=musica`

PHP consulta MySQL, obtiene los cursos de Música y genera el carrusel.

## WhatsApp

El número se guarda en la base de datos, por ejemplo:

`59899123456`

El sistema genera automáticamente un enlace con un mensaje inicial:

`Hola, quisiera consultar por el curso de ...`

No hace falta guardar el mensaje manualmente.

## Flyers

Desde el panel se puede subir un JPG, PNG o WEBP de hasta 5 MB.

El archivo se guarda en `assets/flyers/` y en la base de datos solo se almacena su nombre.

## Seguridad incluida

- PDO con consultas preparadas.
- Contraseñas almacenadas mediante `password_hash`.
- Sesiones para el panel.
- Protección CSRF en formularios administrativos.
- Validación de tipo MIME y tamaño de imágenes.
- El nombre original del archivo no se usa directamente para evitar problemas de nombres/rutas.
- Escape HTML mediante `htmlspecialchars` para los datos mostrados.

## Siguiente mejora recomendable

Para una segunda etapa se puede agregar administración de categorías, múltiples administradores/roles, recuperación de contraseña y una API REST si después querés separar completamente frontend y backend.
