<?php
require_once __DIR__ . '/config.php';

$slug = trim($_GET['slug'] ?? '');

$stmt = db()->prepare('SELECT * FROM categorias WHERE slug = ? AND activo = 1 LIMIT 1');
$stmt->execute([$slug]);
$categoria = $stmt->fetch();

if (!$categoria) {
    http_response_code(404);
    exit('Categoría no encontrada.');
}

$stmt = db()->prepare('SELECT * FROM cursos WHERE categoria_id = ? AND activo = 1 ORDER BY orden, nombre');
$stmt->execute([$categoria['id']]);
$cursos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= e($categoria['nombre']) ?> - Centro Barrial El General">
    <title><?= e($categoria['nombre']) ?> | Centro Barrial El General</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= e(url('css/style.css')) ?>">
</head>
<body>
<header class="site-header">
    <div class="container py-4 py-md-5">
        <a class="back-link" href="<?= e(url('index.php')) ?>">
            <i class="bi bi-arrow-left" aria-hidden="true"></i> Todas las categorías
        </a>
        <div class="text-center mt-3">
            <p class="eyebrow mb-1">CENTRO BARRIAL EL GENERAL</p>
            <h1 class="page-title mb-2"><?= e($categoria['nombre']) ?></h1>
            <p class="page-subtitle mb-0">Cursos y talleres disponibles</p>
        </div>
    </div>
</header>

<main class="container py-4 py-md-5">
    <?php if (!$cursos): ?>
        <div class="empty-state">
            <i class="bi bi-calendar2-x" aria-hidden="true"></i>
            <h2>No hay cursos publicados todavía</h2>
            <p>Próximamente encontrarás aquí las propuestas de esta categoría.</p>
        </div>
    <?php else: ?>
        <section aria-labelledby="titulo-cursos">
            <div class="section-heading text-center mb-4">
                <span class="section-kicker">CURSOS Y TALLERES</span>
                <h2 id="titulo-cursos">Conocé las propuestas</h2>
                <p>Deslizá para ver cada curso y consultar directamente con el docente.</p>
            </div>

            <div id="cursosCarousel" class="carousel slide" data-bs-touch="true" aria-label="Cursos de <?= e($categoria['nombre']) ?>">
                <div class="carousel-inner" id="carouselCursos">
                    <?php foreach ($cursos as $index => $curso): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <article class="course-card">
                                <div class="flyer-wrapper">
                                    <?php if (!empty($curso['imagen'])): ?>
                                        <img src="<?= e(url('assets/flyers/' . basename($curso['imagen']))) ?>" alt="Flyer del curso <?= e($curso['nombre']) ?>">
                                    <?php else: ?>
                                        <div class="no-image"><i class="bi bi-image" aria-hidden="true"></i><span>Sin flyer disponible</span></div>
                                    <?php endif; ?>
                                </div>

                                <div class="course-info">
                                    <span class="course-category"><?= e($categoria['nombre']) ?></span>
                                    <h2 class="course-title"><?= e($curso['nombre']) ?></h2>

                                    <?php if (!empty($curso['descripcion'])): ?>
                                        <p class="course-description"><?= nl2br(e($curso['descripcion'])) ?></p>
                                    <?php endif; ?>

                                    <div class="course-data">
                                        <?php if (!empty($curso['dias'])): ?>
                                            <div class="data-row"><span class="data-icon"><i class="bi bi-calendar3" aria-hidden="true"></i></span><div><span class="data-label">Días</span><span class="data-value"><?= e($curso['dias']) ?></span></div></div>
                                        <?php endif; ?>
                                        <?php if (!empty($curso['horario'])): ?>
                                            <div class="data-row"><span class="data-icon"><i class="bi bi-clock" aria-hidden="true"></i></span><div><span class="data-label">Horario</span><span class="data-value"><?= e($curso['horario']) ?></span></div></div>
                                        <?php endif; ?>
                                        <?php if (!empty($curso['costo'])): ?>
                                            <div class="data-row"><span class="data-icon"><i class="bi bi-cash-coin" aria-hidden="true"></i></span><div><span class="data-label">Costo</span><span class="data-value"><?= e($curso['costo']) ?></span></div></div>
                                        <?php endif; ?>
                                        <?php if (!empty($curso['docente'])): ?>
                                            <div class="data-row"><span class="data-icon"><i class="bi bi-person" aria-hidden="true"></i></span><div><span class="data-label">Docente</span><span class="data-value"><?= e($curso['docente']) ?></span></div></div>
                                        <?php endif; ?>
                                    </div>

                                    <?php if (!empty($curso['whatsapp'])): ?>
                                        <a class="whatsapp-btn" href="<?= e(whatsappUrl($curso['whatsapp'], $curso['nombre'])) ?>" target="_blank" rel="noopener noreferrer">
                                            <i class="bi bi-whatsapp" aria-hidden="true"></i> Consultar por WhatsApp
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if (count($cursos) > 1): ?>
                    <button class="carousel-control-prev" type="button" data-bs-target="#cursosCarousel" data-bs-slide="prev" aria-label="Curso anterior">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#cursosCarousel" data-bs-slide="next" aria-label="Curso siguiente">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>
                    <div class="carousel-indicators" id="carouselIndicadores">
                        <?php foreach ($cursos as $index => $curso): ?>
                            <button type="button" data-bs-target="#cursosCarousel" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" <?= $index === 0 ? 'aria-current="true"' : '' ?> aria-label="Mostrar curso <?= $index + 1 ?>"></button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>
</main>

<footer class="site-footer">
    <div class="container text-center py-4">
        <p class="mb-1">Centro Barrial El General</p>
        <small>Dirección Departamental de Cultura</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
