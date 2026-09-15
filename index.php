<?php
require_once __DIR__ . '/config.php';

$stmt = db()->query('SELECT * FROM categorias WHERE activo = 1 ORDER BY orden, nombre');
$categorias = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cursos y talleres del Centro Barrial El General">
    <title>Cursos y talleres | Centro Barrial El General</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= e(url('css/style.css')) ?>">
</head>
<body>
<header class="site-header">
    <div class="container py-5 text-center">
        <p class="eyebrow mb-1">CENTRO BARRIAL EL GENERAL</p>
        <h1 class="page-title mb-2">Cursos y talleres</h1>
        <p class="page-subtitle mb-0">Elegí una categoría para conocer las propuestas disponibles</p>
    </div>
</header>

<main class="container py-4 py-md-5">
    <div class="row g-3 g-md-4">
        <?php foreach ($categorias as $categoria): ?>
            <div class="col-12 col-md-6 col-lg-4">
                <a class="category-card" href="<?= e(url('categoria.php?slug=' . urlencode($categoria['slug']))) ?>">
                    <span class="category-icon" aria-hidden="true">
                        <i class="bi <?= e($categoria['icono']) ?>"></i>
                    </span>
                    <div>
                        <h2><?= e($categoria['nombre']) ?></h2>
                        <p><?= e($categoria['descripcion']) ?></p>
                    </div>
                    <i class="bi bi-arrow-right category-arrow" aria-hidden="true"></i>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<footer class="site-footer">
    <div class="container text-center py-4">
        <p class="mb-1">Centro Barrial El General</p>
        <small>Dirección Departamental de Cultura</small>
    </div>
</footer>
</body>
</html>
