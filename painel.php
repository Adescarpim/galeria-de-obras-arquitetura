<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: login.php');
    exit;
}

include 'obras.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel do Administrador</title>
    <link rel="stylesheet" href="painel.css">
</head>
<body>

    <div class="topo-painel">
        <h1>Painel do Administrador</h1>
        <a class="btn-adicionar" href="adicionar.php">+ Adicionar Nova Obra</a>
    </div>

    <?php foreach ($obras as $obra): ?>
        <div class="obra">
            <div class="info">
                <img src="<?php echo $obra['imagens'][0]; ?>" alt="Miniatura" class="miniatura">
                <span><?php echo htmlspecialchars($obra['titulo']); ?> (<?php echo $obra['ano']; ?>)</span>
            </div>
            <div class="acoes">
                <a href="editar.php?id=<?php echo $obra['id']; ?>" class="btn-editar">Editar</a>
                <a href="excluir.php?id=<?php echo $obra['id']; ?>" class="btn-excluir" onclick="return confirm('Tem certeza que deseja excluir esta obra?')">Excluir</a>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="logout">
        <a href="logout.php" class="logout-btn">Sair</a>
    </div>

</body>
</html>