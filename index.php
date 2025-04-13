<?php 
include 'obras.php';

$continenteSelecionado = $_GET['continente'] ?? '';
$continentes = array_unique(array_column($obras, 'continente'));
$obras_filtradas = $continenteSelecionado
    ? array_filter($obras, fn($obra) => $obra['continente'] === $continenteSelecionado)
    : $obras;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Galeria da Arquitetura</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Galeria da Arquitetura</h1>
        <a href="admin.php" class="login-btn">Área do Administrador</a>
    </header>

    <form method="get" action="index.php">
        <label for="continente">Filtrar por continente:</label><br>
        <select name="continente" id="continente">
            <option value="">Todos</option>
            <?php foreach ($continentes as $continente): ?>
                <option value="<?php echo htmlspecialchars($continente); ?>"
                    <?php if ($continente === $continenteSelecionado) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($continente); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Filtrar">
    </form>

    <?php
    $obras = json_decode(file_get_contents('obras.php'), true);
    // Exibe as obras normalmente
    ?>


    <?php if (count($obras_filtradas) > 0): ?>
        <?php foreach ($obras_filtradas as $obra): ?>
            <div class="obra">
                <h2><?php echo htmlspecialchars($obra['titulo']); ?></h2>
                <img src="<?php echo $obra['imagens'][0]; ?>" alt="Imagem da obra" width="300"><br>
                <p><strong>Arquiteto:</strong> <?php echo htmlspecialchars($obra['arquiteto']); ?></p>
                <p><strong>Ano:</strong> <?php echo $obra['ano']; ?></p>
                <p><strong>Continente:</strong> <?php echo htmlspecialchars($obra['continente']); ?></p>
                <a href="detalhes.php?id=<?php echo $obra['id']; ?>">Ver detalhes</a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
