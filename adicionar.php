<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: admin.php');
    exit;
}

include 'obras.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $arquiteto = $_POST['arquiteto'];
    $ano = (int) $_POST['ano'];
    $continente = $_POST['continente'];
    $descricao = $_POST['descricao'];

    // Coletar e limpar as URLs
    $imagens = array_filter($_POST['imagens'], function ($img) {
        return trim($img) !== '';
    });

    // Gerar novo ID
    $ultimoId = end($obras)['id'] ?? 0;
    $novoId = $ultimoId + 1;

    $novaObra = [
        'id' => $novoId,
        'titulo' => $titulo,
        'arquiteto' => $arquiteto,
        'ano' => $ano,
        'continente' => $continente,
        'descricao' => $descricao,
        'imagens' => array_values($imagens) // reorganiza índice
    ];

    $obras[] = $novaObra;

    // Reescrever o arquivo obras.php
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
    <title>Adicionar Obra</title>
    <link rel="stylesheet" href="formulario.css">
</head>
<body>
<div class="container">
    <h1>Adicionar Nova Obra</h1>
    <form action="adicionar.php" method="post">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" required>

        <label for="arquiteto">Arquiteto:</label>
        <input type="text" name="arquiteto" id="arquiteto" required>

        <label for="ano">Ano:</label>
        <input type="number" name="ano" id="ano" required>

        <label for="continente">Continente:</label>
        <select name="continente" id="continente" required>
            <option value="">Selecione</option>
            <option value="África">África</option>
            <option value="América">América</option>
            <option value="Ásia">Ásia</option>
            <option value="Europa">Europa</option>
            <option value="Oceania">Oceania</option>
        </select>

        <label for="descricao">Descrição / História / Curiosidades:</label>
        <textarea name="descricao" id="descricao" rows="4" required></textarea>

        <label for="imagem1">Imagem 1 (URL):</label>
        <input type="text" name="imagens[]" id="imagem1" required>

        <label for="imagem2">Imagem 2 (URL):</label>
        <input type="text" name="imagens[]" id="imagem2">

        <label for="imagem3">Imagem 3 (URL):</label>
        <input type="text" name="imagens[]" id="imagem3">

        <label for="imagem4">Imagem 4 (URL):</label>
        <input type="text" name="imagens[]" id="imagem4">

        <label for="imagem5">Imagem 5 (URL):</label>
        <input type="text" name="imagens[]" id="imagem5">

        <label for="imagem6">Imagem 6 (URL):</label>
        <input type="text" name="imagens[]" id="imagem6">


        <input type="submit" value="Adicionar Obra">
    </form>

    <a class="voltar" href="painel.php">← Voltar ao Painel</a>
</div>

</body>
</html>