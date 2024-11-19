<?php
// Inicia a sessão, caso ainda não tenha sido iniciada
if (!isset($_SESSION)) {
    session_start();
}

// Verifica o nome do script atual
$paginaAtual = basename($_SERVER['SCRIPT_NAME']);

// Verifica se o usuário está autenticado
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario']['ID_Usuario'])) {
    // Permite acesso sem redirecionamento nas páginas "outros.php" e "cursos.php"
    if (!in_array($paginaAtual, ['outros.php', 'cursos.php', 'cursoMSDNT.php', 'cursoTCGVD.php'])) {
        // Redireciona para a página de login se o usuário não estiver logado
        header("Location: entrar.php");
        exit;
    }
}

// Recupera o ID do usuário logado e armazena na variável $usuario
$usuario = $_SESSION['usuario']['ID_Usuario'] ?? null;
?>
