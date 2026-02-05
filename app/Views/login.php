<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema de Facturacion</title>
</head>
<body>
    <h1>Sistema de Facturacion</h1>
    <h2>Iniciar Sesion</h2>
    <form action="<?= base_url('login/auth') ?>" method="post">
        <label>Usuario:</label>
        <input type="text" name="usuario" required>
        <br><br>
        <label>Contraseña:</label>
        <input type="password" name="contrasena" required>
        <br><br>
        <button type="submit">Ingresar</button>
    </form>
</body>
</html>