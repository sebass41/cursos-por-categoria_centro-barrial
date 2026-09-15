<?php
require_once __DIR__ . '/../includes/auth.php';

if (!empty($_SESSION['admin_id'])) {
    redirect('admin/index.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verifyCsrf();

    $usuario = trim($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = db()->prepare('SELECT * FROM admin_users WHERE usuario = ? LIMIT 1');
    $stmt->execute([$usuario]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_nombre'] = $admin['nombre'] ?: $admin['usuario'];
        redirect('admin/index.php');
    }

    $error = 'Usuario o contraseña incorrectos.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración | Centro Barrial El General</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body class="login-page">
<div class="login-card">
    <div class="text-center mb-4">
        <div class="admin-logo"><i class="bi bi-building"></i></div>
        <h1>Administración</h1>
        <p>Centro Barrial El General</p>
    </div>

    <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>

    <form method="post">
        <input type="hidden" name="csrf_token" value="<?= e(csrfToken()) ?>">
        <div class="mb-3">
            <label class="form-label" for="usuario">Usuario</label>
            <input class="form-control" type="text" id="usuario" name="usuario" required autocomplete="username">
        </div>
        <div class="mb-4">
            <label class="form-label" for="password">Contraseña</label>
            <input class="form-control" type="password" id="password" name="password" required autocomplete="current-password">
        </div>
        <button class="btn btn-primary w-100" type="submit">Ingresar</button>
    </form>
</div>
</body>
</html>
