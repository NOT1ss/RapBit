<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rap Bit | Entrar</title>
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
<body class="entrar">
    
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
        <div class="container box">
            <form id="formulario" autocomplete="off" method="POST">
                <h1>Entrar</h1>
                <div class="inputBox">
                        <input type="email" name="email" required>
                        <span>Email</span>
                        <i></i>
                </div>
                <div class="inputBox">
                    <input type="password" name="senha" required>
                    <span>Senha</span>
                    <i></i>
                </div>
                <input type="submit" name="btn" value="Login">
                <p class="no-account">Não possui cadastro? <a href="cadastrarProfessor.php">Professor! </a>ou <a href="cadastrarAluno.php">Aluno!</a></p>
            </form>
        </div>
        
    </main>
</body>
</html>

<?php
include_once('conexao.php');

$submit = @$_REQUEST['btn'];
$email = @$_REQUEST['email'];
$senha = @$_REQUEST['senha'];

if($submit){
  if(isset($_POST['email']) || isset($_POST['senha'])){
    if(strlen($_POST['email']) == 0){
      echo "<script>
      alert('E-mail não colocado!');
      </script>";
    }else if(strlen($_POST['senha']) == 0 ){
      echo "<script>
      alert('Senha não colocada!');
      </script>";
    }else{
      $email = $mysqli->real_escape_string($_POST['email']);
      $senha = $mysqli->real_escape_string($_POST['senha']);

      $sql_code = "SELECT * FROM usuario WHERE Email = '$email' AND Senha = '$senha'";
      $sql_query = $mysqli->query($sql_code) or die("Falha no código SQL: ". $mysqli->error);
      $quantidade = $sql_query->num_rows;

      if($quantidade == 1){
        $usuario = $sql_query->fetch_assoc();
        
        if(!isset($_SESSION)){
          session_start();
        }

        $_SESSION['usuario'] = $usuario;

        // Verificar o tipo de usuário e redirecionar
        if ($usuario['Tipo'] == 1) {
          // Se for professor
          $stmtVerificaProfessor = $mysqli->prepare("SELECT ID_Professor FROM professor WHERE ID_Usuario = ?");
          $stmtVerificaProfessor->bind_param("i", $usuario['ID_Usuario']);
          $stmtVerificaProfessor->execute();
          $resultadoProfessor = $stmtVerificaProfessor->get_result();

          if ($resultadoProfessor->num_rows > 0) {
            // Se o professor existir, redireciona para a página de professor
            header("Location: professor_extrato.php");
          } else {
            // Caso não exista no banco, exibe um erro
            echo "<script>alert('Professor não cadastrado!'); window.location.href = 'entrar.php';</script>";
          }
        } else {
          // Se for aluno
          header("Location: cursos.php");
        }
      }else{
        echo "<script>
        alert('E-mail ou Senha incorretos!');
        </script>";
      }
    }
  }  
}
?>
