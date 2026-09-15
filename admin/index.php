<?php
require_once __DIR__ . '/../includes/auth.php';
requireAdmin();

$pdo = db();

$total = (int)$pdo->query('SELECT COUNT(*) FROM cursos')->fetchColumn();
$activos = (int)$pdo->query('SELECT COUNT(*) FROM cursos WHERE activo = 1')->fetchColumn();
$categorias = (int)$pdo->query('SELECT COUNT(*) FROM categorias WHERE activo = 1')->fetchColumn();

$ultimos = $pdo->query('SELECT c.id, c.nombre, c.docente, c.activo, cat.nombre AS categoria FROM cursos c JOIN categorias cat ON cat.id = c.categoria_id ORDER BY c.updated_at DESC LIMIT 8')->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Panel | Centro Barrial El General</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<nav class="navbar admin-nav"><div class="container"><a class="navbar-brand" href="index.php">Centro Barrial <strong>El General</strong></a><div class="d-flex align-items-center gap-3"><span class="d-none d-md-inline">Hola, <?= e($_SESSION['admin_nombre']) ?></span><a class="btn btn-outline-light btn-sm" href="logout.php">Salir</a></div></div></nav>
<main class="container py-4 py-md-5">
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4"><div><h1 class="admin-title">Panel de administración</h1><p class="text-muted mb-0">Gestioná los cursos publicados en el sitio.</p></div><a class="btn btn-primary" href="curso-form.php"><i class="bi bi-plus-lg"></i> Agregar curso</a></div>
<div class="row g-3 mb-4">
<div class="col-6 col-lg-4"><div class="stat-card"><span>Cursos</span><strong><?= $total ?></strong></div></div>
<div class="col-6 col-lg-4"><div class="stat-card"><span>Publicados</span><strong><?= $activos ?></strong></div></div>
<div class="col-12 col-lg-4"><div class="stat-card"><span>Categorías activas</span><strong><?= $categorias ?></strong></div></div>
</div>
<div class="admin-card"><div class="d-flex justify-content-between align-items-center mb-3"><h2 class="h5 mb-0">Cursos recientes</h2><a href="cursos.php">Ver todos</a></div>
<div class="table-responsive"><table class="table align-middle"><thead><tr><th>Curso</th><th>Categoría</th><th>Docente</th><th>Estado</th><th></th></tr></thead><tbody>
<?php foreach ($ultimos as $curso): ?><tr><td><?= e($curso['nombre']) ?></td><td><?= e($curso['categoria']) ?></td><td><?= e($curso['docente']) ?></td><td><span class="badge <?= $curso['activo'] ? 'text-bg-success' : 'text-bg-secondary' ?>"><?= $curso['activo'] ? 'Publicado' : 'Oculto' ?></span></td><td class="text-end"><a class="btn btn-sm btn-outline-primary" href="curso-form.php?id=<?= (int)$curso['id'] ?>">Editar</a></td></tr><?php endforeach; ?>
<?php if (!$ultimos): ?><tr><td colspan="5" class="text-center text-muted py-4">Todavía no hay cursos.</td></tr><?php endif; ?>
</tbody></table></div></div>
</main>
</body></html>
