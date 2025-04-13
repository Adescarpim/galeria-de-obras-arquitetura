<?php
include 'obras.php';

$id = $_GET['id'] ?? null;
$obra_encontrada = null;

foreach ($obras as $obra) {
    if ($obra['id'] == $id) {
        $obra_encontrada = $obra;
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Detalhes da Obra</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="titulo-detalhes">
        <h1>Detalhes da Obra</h1>
    </div>


    <?php if ($obra_encontrada): ?>
        <div class="detalhes-container">
            <div class="imagens">
                <?php foreach ($obra_encontrada['imagens'] as $img): ?>
                    <img src="<?php echo $img; ?>" alt="Imagem da obra">
                <?php endforeach; ?>
            </div>
            <div class="info">
                <h2><?php echo htmlspecialchars($obra_encontrada['titulo']); ?></h2>
                <p><strong>Arquiteto:</strong> <?php echo htmlspecialchars($obra_encontrada['arquiteto']); ?></p>
                <p><strong>Ano:</strong> <?php echo $obra_encontrada['ano']; ?></p>
                <p><strong>Continente:</strong> <?php echo htmlspecialchars($obra_encontrada['continente']); ?></p>
                <p><strong>História e Curiosidades:</strong> <?php echo htmlspecialchars($obra_encontrada['descricao']); ?></p>
                <p><a href="index.php">Voltar ao catálogo</a></p>
            </div>
        </div>
    <?php else: ?>
        <p>Obra não encontrada.</p>
        <p><a href="index.php">Voltar ao catálogo</a></p>
    <?php endif; ?>
</body>
</html>
