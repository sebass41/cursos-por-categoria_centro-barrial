<?php
require_once __DIR__ . '/../includes/auth.php';
requireAdmin();

$pdo = db();
$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
$editing = $id > 0;
$errors = [];

$curso = [
    'categoria_id' => '', 'nombre' => '', 'descripcion' => '', 'dias' => '',
    'horario' => '', 'costo' => '', 'docente' => '', 'whatsapp' => '',
    'imagen' => '', 'orden' => 0, 'activo' => 1
];

if ($editing) {
    $stmt = $pdo->prepare('SELECT * FROM cursos WHERE id = ?');
    $stmt->execute([$id]);
    $found = $stmt->fetch();
    if (!$found) exit('Curso no encontrado.');
    $curso = $found;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyCsrf();
    $curso['categoria_id'] = (int)($_POST['categoria_id'] ?? 0);
    $curso['nombre'] = trim($_POST['nombre'] ?? '');
    $curso['descripcion'] = trim($_POST['descripcion'] ?? '');
    $curso['dias'] = trim($_POST['dias'] ?? '');
    $curso['horario'] = trim($_POST['horario'] ?? '');
    $curso['costo'] = trim($_POST['costo'] ?? '');
    $curso['docente'] = trim($_POST['docente'] ?? '');
    $curso['whatsapp'] = trim($_POST['whatsapp'] ?? '');
    $curso['orden'] = (int)($_POST['orden'] ?? 0);
    $curso['activo'] = isset($_POST['activo']) ? 1 : 0;

    if (!$curso['categoria_id']) $errors[] = 'Seleccioná una categoría.';
    if ($curso['nombre'] === '') $errors[] = 'El nombre del curso es obligatorio.';

    $newImage = null;
    if (!empty($_FILES['imagen']['name'])) {
        if ($_FILES['imagen']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'No se pudo subir la imagen.';
        } elseif ($_FILES['imagen']['size'] > MAX_IMAGE_SIZE) {
            $errors[] = 'La imagen no puede superar los 5 MB.';
        } else {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($_FILES['imagen']['tmp_name']);
            $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
            if (!isset($allowed[$mime])) {
                $errors[] = 'La imagen debe ser JPG, PNG o WEBP.';
            } else {
                $newImage = bin2hex(random_bytes(12)) . '.' . $allowed[$mime];
            }
        }
    }

    if (!$errors) {
        if ($newImage) {
            if (!is_dir(UPLOAD_DIR)) mkdir(UPLOAD_DIR, 0755, true);
            if (!move_uploaded_file($_FILES['imagen']['tmp_name'], UPLOAD_DIR . $newImage)) {
                $errors[] = 'No se pudo guardar la imagen en el servidor.';
            }
        }

        if (!$errors) {
            if ($editing) {
                $imagenFinal = $newImage ?: $curso['imagen'];
                $stmt = $pdo->prepare('UPDATE cursos SET categoria_id=?, nombre=?, descripcion=?, dias=?, horario=?, costo=?, docente=?, whatsapp=?, imagen=?, orden=?, activo=? WHERE id=?');
                $stmt->execute([$curso['categoria_id'], $curso['nombre'], $curso['descripcion'], $curso['dias'], $curso['horario'], $curso['costo'], $curso['docente'], $curso['whatsapp'], $imagenFinal, $curso['orden'], $curso['activo'], $id]);
                if ($newImage && !empty($curso['imagen'])) {
                    $old = UPLOAD_DIR . basename($curso['imagen']);
                    if (is_file($old)) @unlink($old);
                }
            } else {
                $stmt = $pdo->prepare('INSERT INTO cursos (categoria_id,nombre,descripcion,dias,horario,costo,docente,whatsapp,imagen,orden,activo) VALUES (?,?,?,?,?,?,?,?,?,?,?)');
                $stmt->execute([$curso['categoria_id'], $curso['nombre'], $curso['descripcion'], $curso['dias'], $curso['horario'], $curso['costo'], $curso['docente'], $curso['whatsapp'], $newImage, $curso['orden'], $curso['activo']]);
            }
            redirect('admin/cursos.php');
        }
    }
}

$categorias = $pdo->query('SELECT id,nombre FROM categorias WHERE activo=1 ORDER BY orden,nombre')->fetchAll();
?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title><?= $editing ? 'Editar' : 'Agregar' ?> curso</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" href="../css/admin.css"></head>
<body><nav class="navbar admin-nav"><div class="container"><a class="navbar-brand" href="index.php">Centro Barrial <strong>El General</strong></a><a class="btn btn-outline-light btn-sm" href="logout.php">Salir</a></div></nav>
<main class="container py-4 py-md-5"><div class="mb-4"><a href="cursos.php">← Volver a cursos</a><h1 class="admin-title mt-2"><?= $editing ? 'Editar curso' : 'Agregar curso' ?></h1></div>
<?php if ($errors): ?><div class="alert alert-danger"><ul class="mb-0"><?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
<form class="admin-card" method="post" enctype="multipart/form-data"><input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>"><input type="hidden" name="id" value="<?= (int)$id ?>">
<div class="row g-3">
<div class="col-12 col-md-6"><label class="form-label" for="categoria_id">Categoría *</label><select class="form-select" id="categoria_id" name="categoria_id" required><option value="">Seleccionar...</option><?php foreach ($categorias as $cat): ?><option value="<?= (int)$cat['id'] ?>" <?= (int)$curso['categoria_id'] === (int)$cat['id'] ? 'selected' : '' ?>><?= e($cat['nombre']) ?></option><?php endforeach; ?></select></div>
<div class="col-12 col-md-6"><label class="form-label" for="nombre">Nombre del curso *</label><input class="form-control" id="nombre" name="nombre" value="<?= e($curso['nombre']) ?>" required></div>
<div class="col-12"><label class="form-label" for="descripcion">Descripción</label><textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?= e($curso['descripcion']) ?></textarea></div>
<div class="col-12 col-md-6"><label class="form-label" for="dias">Días</label><input class="form-control" id="dias" name="dias" placeholder="Ej.: lunes y miércoles" value="<?= e($curso['dias']) ?>"></div>
<div class="col-12 col-md-6"><label class="form-label" for="horario">Horario</label><input class="form-control" id="horario" name="horario" placeholder="Ej.: 18:00 a 19:30 hs" value="<?= e($curso['horario']) ?>"></div>
<div class="col-12 col-md-6"><label class="form-label" for="costo">Costo</label><input class="form-control" id="costo" name="costo" placeholder="Ej.: $ 1.500 mensuales" value="<?= e($curso['costo']) ?>"></div>
<div class="col-12 col-md-6"><label class="form-label" for="docente">Docente</label><input class="form-control" id="docente" name="docente" value="<?= e($curso['docente']) ?>"></div>
<div class="col-12 col-md-6"><label class="form-label" for="whatsapp">WhatsApp</label><input class="form-control" id="whatsapp" name="whatsapp" placeholder="Ej.: 59899123456" value="<?= e($curso['whatsapp']) ?>"><div class="form-text">Usá código de país, sin +, espacios ni guiones.</div></div>
<div class="col-12 col-md-6"><label class="form-label" for="imagen">Flyer</label><input class="form-control" type="file" id="imagen" name="imagen" accept="image/jpeg,image/png,image/webp"><div class="form-text">JPG, PNG o WEBP. Máximo 5 MB.</div><?php if (!empty($curso['imagen'])): ?><small class="text-muted d-block mt-2">Actual: <?= e($curso['imagen']) ?></small><?php endif; ?></div>
<div class="col-12 col-md-6"><label class="form-label" for="orden">Orden</label><input class="form-control" type="number" id="orden" name="orden" value="<?= (int)$curso['orden'] ?>"></div>
<div class="col-12"><div class="form-check form-switch"><input class="form-check-input" type="checkbox" id="activo" name="activo" <?= $curso['activo'] ? 'checked' : '' ?>><label class="form-check-label" for="activo">Publicar este curso</label></div></div>
</div>
<div class="d-flex gap-2 justify-content-end mt-4"><a class="btn btn-outline-secondary" href="cursos.php">Cancelar</a><button class="btn btn-primary" type="submit"><?= $editing ? 'Guardar cambios' : 'Agregar curso' ?></button></div>
</form></main></body></html>
