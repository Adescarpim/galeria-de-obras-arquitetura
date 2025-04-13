<?php
session_start();

$usuario = $_POST['usuario'] ?? '';
$senha = $_POST['senha'] ?? '';

if ($usuario === 'admin' && $senha === 'ads123') {
    $_SESSION['logado'] = true;
    header('Location: painel.php');
    exit;
} else {
    header('Location: admin.php?erro=1');
    exit;
}
?>