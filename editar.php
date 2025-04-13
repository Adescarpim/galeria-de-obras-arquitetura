<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: admin.php');
    exit;
}

include 'obras.php';

$id = $_GET['id'] ?? null;
$obra_encontrada = null;

foreach ($obras as $obra) {
    if ($obra['id'] == $id) {
        $obra_encontrada = $obra;
        break;
    }
}

if (!$obra_encontrada) {
    echo "Obra não encontrada.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($obras as &$obra) {
        if ($obra['id'] == $id) {
            $obra['titulo'] = $_POST['titulo'];
            $obra['arquiteto'] = $_POST['arquiteto'];
            $obra['ano'] = (int) $_POST['ano'];
            $obra['continente'] = $_POST['continente'];
            $obra['descricao'] = $_POST['descricao'];
            $obra['imagens'] = array_filter($_POST['imagens'], fn($img) => trim($img) !== '');
            break;
        }
    }

    $conteudo = "<?php\n\$obras = " . var_export($obras, true) . ";\n?>";
    file_put_contents('obras.php', $conteudo);

    header('Location: painel.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Obra</title>
    <link rel="stylesheet" href="editar.css">
</head>
<body>
    <div class="container">
        <h1>Editar Obra</h1>
        <form method="post">
            <label>Título:</label>
            <input type="text" name="titulo" value="<?php echo htmlspecialchars($obra_encontrada['titulo']); ?>" required>

            <label>Arquiteto:</label>
            <input type="text" name="arquiteto" value="<?php echo htmlspecialchars($obra_encontrada['arquiteto']); ?>" required>

            <label>Ano:</label>
            <input type="number" name="ano" value="<?php echo $obra_encontrada['ano']; ?>" required>

            <label>Continente:</label>
            <select name="continente" required>
                <?php
                $continentes = ['África', 'América', 'Ásia', 'Europa', 'Oceania'];
                foreach ($continentes as $cont) {
                    $selected = ($obra_encontrada['continente'] === $cont) ? 'selected' : '';
                    echo "<option $selected>$cont</option>";
                }
                ?>
            </select>

            <label>Descrição:</label>
            <textarea name="descricao" rows="4" required><?php echo htmlspecialchars($obra_encontrada['descricao']); ?></textarea>

            <label>Imagens (URLs):</label>
            <?php
            for ($i = 0; $i < 6; $i++) {
                $url = $obra_encontrada['imagens'][$i] ?? '';
                echo "<input type='text' name='imagens[]' value='" . htmlspecialchars($url) . "' placeholder='URL da imagem " . ($i + 1) . "'>";
            }
            ?>

            <input type="submit" value="Salvar">
        </form>
        <a href="painel.php">Cancelar</a>
    </div>
</body>
</html>