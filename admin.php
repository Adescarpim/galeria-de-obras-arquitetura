<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login do Administrador</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <h1>Área Administrativa</h1>

    <?php if (isset($_GET['erro'])): ?>
        <p style="color: red;">Usuário ou senha incorretos.</p>
    <?php endif; ?>

    <form method="post" action="login.php">
        <label for="usuario">Usuário:</label><br>
        <input type="text" id="usuario" name="usuario" required><br>

        <label for="senha">Senha:</label><br>
        <input type="password" id="senha" name="senha" required><br><br>

        <input type="submit" value="Entrar">
    </form>
</body>
</html>
