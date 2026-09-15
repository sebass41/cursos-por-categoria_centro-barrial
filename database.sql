CREATE DATABASE IF NOT EXISTS centro_barrial
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE centro_barrial;

CREATE TABLE IF NOT EXISTS categorias (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(120) NOT NULL,
    slug VARCHAR(120) NOT NULL UNIQUE,
    icono VARCHAR(80) DEFAULT 'bi-grid',
    descripcion VARCHAR(255) DEFAULT NULL,
    orden INT NOT NULL DEFAULT 0,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS cursos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    categoria_id INT UNSIGNED NOT NULL,
    nombre VARCHAR(160) NOT NULL,
    descripcion TEXT DEFAULT NULL,
    dias VARCHAR(255) DEFAULT NULL,
    horario VARCHAR(120) DEFAULT NULL,
    costo VARCHAR(120) DEFAULT NULL,
    docente VARCHAR(160) DEFAULT NULL,
    whatsapp VARCHAR(30) DEFAULT NULL,
    imagen VARCHAR(255) DEFAULT NULL,
    orden INT NOT NULL DEFAULT 0,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_cursos_categoria
        FOREIGN KEY (categoria_id) REFERENCES categorias(id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    INDEX idx_cursos_categoria_activo (categoria_id, activo, orden)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS admin_users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(80) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    nombre VARCHAR(120) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO categorias (nombre, slug, icono, descripcion, orden) VALUES
('Apoyo y formación', 'apoyo-y-formacion', 'bi-mortarboard-fill', 'Espacios de aprendizaje y apoyo educativo.', 1),
('Arte y expresión', 'arte-y-expresion', 'bi-palette-fill', 'Propuestas para crear y expresarse a través del arte.', 2),
('Artesanías y oficios creativos', 'artesanias-y-oficios-creativos', 'bi-scissors', 'Talleres prácticos para aprender y crear.', 3),
('Bienestar y salud', 'bienestar-y-salud', 'bi-heart-pulse-fill', 'Actividades orientadas al bienestar integral.', 4),
('Cocina, huerta y alimentación', 'cocina-huerta', 'bi-flower1', 'Propuestas relacionadas con cocina, huerta y alimentación.', 5),
('Movimiento y expresión', 'movimiento-y-expresion', 'bi-person-arms-up', 'Actividades corporales, movimiento y expresión.', 6),
('Música', 'musica', 'bi-music-note-beamed', 'Cursos y talleres relacionados con la música.', 7),
('Informática y tecnología', 'informatica-y-tecnologia', 'bi-laptop', 'Propuestas de informática y herramientas digitales.', 8)
ON DUPLICATE KEY UPDATE nombre = VALUES(nombre), icono = VALUES(icono), descripcion = VALUES(descripcion), orden = VALUES(orden);

-- Usuario inicial del panel de administración.
-- Usuario: admin
-- Contraseña: admin123
-- CAMBIAR esta contraseña inmediatamente en producción.
INSERT INTO admin_users (usuario, password_hash, nombre) VALUES
('admin', '$2y$12$XlPnKaCDqDHP0kxABx6.yOjxWZgh3YvujJ72vP4D1i0SQE7q8ZOYu', 'Administrador')
ON DUPLICATE KEY UPDATE usuario = VALUES(usuario);

-- Curso de ejemplo usando el flyer que ya tenías.
INSERT INTO cursos
(categoria_id, nombre, descripcion, dias, horario, costo, docente, whatsapp, imagen, orden, activo)
SELECT id,
       'Curso de Música',
       'Propuesta musical para aprender, crear y compartir.',
       'Lunes y miércoles',
       '18:00 a 19:30 hs',
       '$ 000',
       'Nombre del docente',
       '59899000000',
       'flyer-ejemplo.png',
       1,
       1
FROM categorias
WHERE slug = 'musica'
AND NOT EXISTS (
    SELECT 1 FROM cursos WHERE nombre = 'Curso de Música' AND categoria_id = categorias.id
);
