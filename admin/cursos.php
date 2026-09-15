<?php
require_once __DIR__ . '/../includes/auth.php';
requireAdmin();

$pdo = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyCsrf();
    $id = (int)($_POST['id'] ?? 0);
    $accion = $_POST['accion'] ?? '';

    if ($id && $accion === 'toggle') {
        $stmt = $pdo->prepare('UPDATE cursos SET activo = 1 - activo WHERE id = ?');
        $stmt->execute([$id]);
    }

    if ($id && $accion === 'eliminar') {
        $stmt = $pdo->prepare('SELECT imagen FROM cursos WHERE id = ?');
        $stmt->execute([$id]);
        $imagen = $stmt->fetchColumn();
        $stmt = $pdo->prepare('DELETE FROM cursos WHERE id = ?');
        $stmt->execute([$id]);
        if ($imagen) {
            $file = UPLOAD_DIR . basename($imagen);
            if (is_file($file)) @unlink($file);
        }
    }

    redirect('admin/cursos.php');
}

$cursos = $pdo->query('SELECT c.*, cat.nombre AS categoria FROM cursos c JOIN categorias cat ON cat.id = c.categoria_id ORDER BY cat.orden, c.orden, c.nombre')->fetchAll();
?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Cursos | Administración</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" href="../css/admin.css"></head>
<body><nav class="navbar admin-nav"><div class="container"><a class="navbar-brand" href="index.php">Centro Barrial <strong>El General</strong></a><div class="d-flex gap-2"><a class="btn btn-light btn-sm" href="../index.php">Ver sitio</a><a class="btn btn-outline-light btn-sm" href="logout.php">Salir</a></div></div></nav>
<main class="container py-4"><div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4"><h1 class="admin-title mb-0">Cursos</h1><a class="btn btn-primary" href="curso-form.php">+ Agregar curso</a></div>
<div class="admin-card"><div class="table-responsive"><table class="table align-middle"><thead><tr><th>Curso</th><th>Categoría</th><th>Docente</th><th>Estado</th><th class="text-end">Acciones</th></tr></thead><tbody>
<?php foreach ($cursos as $curso): ?><tr><td><strong><?= e($curso['nombre']) ?></strong><br><small class="text-muted"><?= e($curso['dias']) ?> <?= e($curso['horario']) ?></small></td><td><?= e($curso['categoria']) ?></td><td><?= e($curso['docente']) ?></td><td><span class="badge <?= $curso['activo'] ? 'text-bg-success' : 'text-bg-secondary' ?>"><?= $curso['activo'] ? 'Publicado' : 'Oculto' ?></span></td><td class="text-end"><div class="d-flex justify-content-end gap-1"><a class="btn btn-sm btn-outline-primary" href="curso-form.php?id=<?= (int)$curso['id'] ?>">Editar</a><form method="post" class="d-inline"><input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>"><input type="hidden" name="id" value="<?= (int)$curso['id'] ?>"><input type="hidden" name="accion" value="toggle"><button class="btn btn-sm btn-outline-secondary" type="submit"><?= $curso['activo'] ? 'Ocultar' : 'Publicar' ?></button></form><form method="post" class="d-inline" onsubmit="return confirm('¿Eliminar este curso?');"><input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>"><input type="hidden" name="id" value="<?= (int)$curso['id'] ?>"><input type="hidden" name="accion" value="eliminar"><button class="btn btn-sm btn-outline-danger" type="submit">Eliminar</button></form></div></td></tr><?php endforeach; ?>
<?php if (!$cursos): ?><tr><td colspan="5" class="text-center text-muted py-5">No hay cursos cargados.</td></tr><?php endif; ?>
</tbody></table></div></div></main></body></html>
