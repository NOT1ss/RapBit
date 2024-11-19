<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rap Bit | Cadastrar Professor</title>
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

}
    </style>

</head>
<body class="cadastrarProfessor">
    
    <!-- Cabeçalho com navegação -->
    <header class="navbar">
        <nav>
            <ul>
                <li><a href="home.html" class="active">INÍCIO</a></li>
                <li><a href="cursos.php">CURSOS</a></li>
                <div class="logo">
                    <img src="imagens/logo.png" alt="Logo">
                </div>
                <li><a href="contato.html" >CONTATO</a></li>
                <li><a href="outros.php">OUTROS</a></li>
            </ul>                
        </nav>
    </header>

    <!-- Seção principal com imagem completa como fundo -->
    <main class="hero-section">
        <div class="box2cadastrar">
        <div class="container box">
            <form id="formulario" autocomplete="off" method="POST">
                <h1>Cadastrar Prof.</h1>
                <div class="inputBox">
                    <input type="text" name="nome" required>
                    <span>Nome</span>
                    <i></i>
                </div>
                <div class="inputBox">
                    <input type="email" name="email" required>
                    <span>Email</span>
                    <i></i>
                </div>
                <div class="inputBox">
                    <input type="tel" name="telefone" required>
                    <span>Telefone</span>
                    <i></i>
                </div>
                <div class="inputBox">
                    <input type="date" name="data" required>
                    <span>Data de Nascimento</span>
                    <i></i>
                </div>
                <div class="inputBox">
                    <input type="password" name="senha" required>
                    <span>Senha</span>
                    <i></i>
                </div>
                <input type="submit" name="btn" value="Login">
                <p class="no-account">Já possui cadastro? <a href="entrar.php">Clique aqui!</a></p>
            </form>
        </div>
    </div>
    </main>
</body>
</html>

<?php
include_once ('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? null;
    $email = $_POST['email'] ?? null;
    $senha = $_POST['senha'] ?? null;
    $telefone = $_POST['telefone'] ?? null;
    $dataNasc = $_POST['data'] ?? null;
    $tipo = true; // 'aluno' ou 'professor'

    // Verificar se o email já existe
    $stmt = $mysqli->prepare("SELECT * FROM usuario WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Erro: Este email já está cadastrado!');</script>";
    } else {
        // Inserir o novo registro
        $stmt = $mysqli->prepare("INSERT INTO usuario (Nome, Email, Senha, Telefone, Data_Nascimento, Tipo) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $nome, $email, $senha, $telefone, $dataNasc, $tipo);

        if ($stmt->execute()) {
            $id_usuario = $mysqli->insert_id;
             // Inserir na tabela específica (aluno ou professor)
            $stmtProfessor = $mysqli->prepare("INSERT INTO professor (ID_Usuario) VALUES (?)");
            $stmtProfessor->bind_param("i", $id_usuario);
            $stmtProfessor->execute();
            echo "<script>alert('Usuário cadastrado com sucesso!');
            setTimeout(function() {
                    window.location.href = 'entrar.php';
                }, 2000); // 2000 ms = 2 segundos;</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar!');</script>";
            echo  $mysqli->error;
        }
    }
        // Confirmar a transação
        $mysqli->commit();
        // Finalizar conexão e limpar recursos
        $stmt->close();
        if (isset($stmtProfessor)) {
            $stmtProfessor->close();
        }
        $mysqli->close();
        
}
?>