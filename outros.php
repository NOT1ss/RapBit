<?php
include_once('protect.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rap Bit | Outros</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color: #000000;
            color: #fff;
            display: flex;
            justify-content: center; /* Centraliza a box horizontalmente */
            align-items: center; /* Centraliza a box verticalmente */
            height: 100vh; /* Faz a altura da tela ser 100% */
            margin-top: 80px; /* Ajusta a distância da box em relação à navbar fixa */
            text-align: center;
        }
        form{
            position: absolute;
            inset: 2px;
            background: #28292d;
            padding: 0 40px;
            border-radius: 8px;
            z-index: 2;
            display: flex;
            flex-direction: column;
        }
        body.boxInfo .box {
            width: 380px;
            height: 375px;  
        }

    </style>

</head>
<body class="boxInfo">
    
    <!-- Cabeçalho com navegação -->
    <header class="navbar">
        <nav>
            <ul>
                <li><a href="home.html" >INÍCIO</a></li>
                <li><a href="cursos.php">CURSOS</a></li>
                <div class="logo">
                    <img src="imagens/logo.png" alt="Logo">
                </div>
                <li><a href="contato.html" >CONTATO</a></li>
                <li><a href="outros.php" class="active">OUTROS</a></li>
            </ul>
        </nav>
    </header>

    <!-- Seção principal com imagem completa como fundo -->
    <main class="hero-section">
        <div class="box2cadastrar">
            <div class="container box">
                <form autocomplete="off" method="POST">
                    <h1>Outras Infos</h1>
                    
                    <p class="no-account">Já possui cadastro? <a href="entrar.php">Clique aqui!</a></p>
                    <p class="no-account">Não possui cadastro? <a href="cadastrarProfessor.php">Professor! </a>ou <a href="cadastrarAluno.php">Aluno!</a></p>
                    <p class="no-account">Saiba mais sobre o projeto! <a href="saiba.html">Clique Aqui!</a></p>
                    
                    <!-- Exibe o botão Deslogar apenas se o usuário estiver logado -->
                    <?php if ($usuario): ?>
                        <br><input type="submit" name="btn" value="Deslogar">
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submit = @$_REQUEST['btn'];
    if($submit){
        

        // Destroi a sessão
        session_unset(); // Remove todas as variáveis da sessão
        session_destroy(); // Destrói a sessão atual

        // Redireciona para a página de login ou inicial
        header("Location: entrar.php");
        exit; // Garante que o script pare aqui
    }
}
?>
