<?php
// =====================================================
// CONFIGURACIÓN DE LA APLICACIÓN
// =====================================================

// Datos de MySQL/MariaDB del hosting.
// En XAMPP/WAMP local normalmente es localhost/root/sin contraseña.
define('DB_HOST', 'localhost');
define('DB_NAME', 'centro_barrial');
define('DB_USER', 'root');
define('DB_PASS', '');

// Si la aplicación está en una subcarpeta, por ejemplo:
// https://dominio.com/categorias-centro-barrial/
// usar: define('BASE_URL', '/categorias-centro-barrial');
// Si está directamente en el dominio: ''.
define('BASE_URL', '/proyectos/cateogrias-centro-barrial/');

define('UPLOAD_DIR', __DIR__ . '/assets/flyers/');
define('MAX_IMAGE_SIZE', 5 * 1024 * 1024); // 5 MB

function db(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';

        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    }

    return $pdo;
}

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function url(string $path = ''): string
{
    return rtrim(BASE_URL, '/') . '/' . ltrim($path, '/');
}

function redirect(string $path): never
{
    header('Location: ' . url($path));
    exit;
}

function whatsappUrl(string $phone, string $courseName): string
{
    $phone = preg_replace('/\D+/', '', $phone);
    $message = 'Hola, quisiera consultar por el curso de ' . $courseName . '.';
    return 'https://wa.me/' . $phone . '?text=' . rawurlencode($message);
}
