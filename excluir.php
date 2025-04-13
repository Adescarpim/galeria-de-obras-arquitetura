<?php
session_start();
if (!isset($_SESSION['logado'])) {
    header('Location: admin.php');
    exit;
}

include 'obras.php';

$id = $_GET['id'] ?? null;
$novaLista = [];

// Filtrar obras, removendo a com o ID
foreach ($obras as $obra) {
    if ($obra['id'] != $id) {
        $novaLista[] = $obra;
    }
}

// Reescrever obras.php
$conteudo = "<?php\n\$obras = " . var_export($novaLista, true) . ";\n?>";
file_put_contents('obras.php', $conteudo);

header('Location: painel.php');
exit;