# Página de categoría — Música

Proyecto inicial para el sitio del Centro Barrial El General.

## Estructura

- `index.html` → página principal de la categoría.
- `css/style.css` → todos los estilos personalizados.
- `js/cursos.js` → datos editables de los cursos + generación del carrusel.
- `assets/flyer-ejemplo.png` → flyer enviado como ejemplo.

## ¿Dónde se cambian los cursos?

Abrí:

`js/cursos.js`

y modificá los objetos dentro de:

`const cursos = [ ... ]`

Cada curso tiene:

- nombre
- descripción
- días
- horario
- costo
- docente
- WhatsApp
- imagen

Para agregar otro curso, copiá uno de los objetos y cambiá sus datos.

## WhatsApp

El número debe colocarse en formato internacional, sin `+`, espacios ni guiones.

Ejemplo:

`59899123456`

El botón genera automáticamente:

`https://wa.me/59899123456`

## Cambiar la imagen

En cada curso:

`imagen: "assets/flyer-ejemplo.png"`

se puede colocar otro archivo dentro de `assets`, por ejemplo:

`imagen: "assets/flyer-musica-2.png"`

## Para crear otra categoría

La idea es duplicar esta carpeta/página y cambiar:

1. El título de la categoría en `index.html`.
2. El texto de la etiqueta de categoría en `js/cursos.js`.
3. Los cursos y sus datos.
4. Las imágenes.

Más adelante, cuando se agregue una base de datos, `cursos.js` puede reemplazarse por datos obtenidos mediante una API sin tener que rehacer el diseño.
