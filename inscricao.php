<?php
include_once('conexao.php');
include_once('protect.php'); // Asegura que o usuário está logado

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    echo "<script>alert('Você precisa estar logado para se inscrever.');
            window.location.href = 'login.php';</script>";
    exit;
}

// Obter o ID do usuário da sessão
$usuario = $_SESSION['usuario']; // ID do usuário que está logado

// Mapear o ID_Usuario para o ID_Aluno
$stmtMapeiaAluno = $mysqli->prepare("SELECT ID_Aluno FROM aluno WHERE ID_Usuario = ?");
$stmtMapeiaAluno->bind_param("i", $usuario['ID_Usuario']); // Usei a chave correta do array $_SESSION['usuario']
$stmtMapeiaAluno->execute();
$resultadoMapeia = $stmtMapeiaAluno->get_result();

if ($resultadoMapeia->num_rows > 0) {
    $aluno = $resultadoMapeia->fetch_assoc();
    $idAluno = $aluno['ID_Aluno'];
} else {
    echo "<script>alert('Usuário não registrado como aluno. Cadastre-se primeiro.');
            window.location.href = 'cadastrarAluno.php';</script>";
    exit;
}
$stmtMapeiaAluno->close();

// Obter o ID do curso enviado pelo formulário
$idCurso = $_POST['idCurso'] ?? null;

if (!$idCurso) {
    echo "<script>alert('ID do curso não fornecido.');
            window.location.href = 'cursos.php';</script>";
    exit;
}

// Verificar se o aluno já está inscrito no curso
$stmtVerificaInscricao = $mysqli->prepare("SELECT ID_Inscricao FROM inscricao WHERE ID_Aluno = ? AND ID_Curso = ?");
$stmtVerificaInscricao->bind_param("ii", $idAluno, $idCurso);
$stmtVerificaInscricao->execute();
$resultadoInscricao = $stmtVerificaInscricao->get_result();

if ($resultadoInscricao->num_rows > 0) {
    echo "<script>alert('Você já está inscrito neste curso!');
            window.location.href = 'cursos.php';</script>";
    exit;
}
$stmtVerificaInscricao->close();

// Inserir a inscrição no banco de dados
$stmtInsereInscricao = $mysqli->prepare("INSERT INTO inscricao (ID_Aluno, ID_Curso) VALUES (?, ?)");
$stmtInsereInscricao->bind_param("ii", $idAluno, $idCurso);
$stmtInsereInscricao->execute();

if ($stmtInsereInscricao->affected_rows > 0) {
    echo "<script>alert('Inscrição realizada com sucesso!');
            window.location.href = 'cursos.php';</script>";
} else {
    echo "<script>alert('Erro ao realizar a inscrição. Tente novamente.');
            window.location.href = 'curso_detalhes.php?idCurso=$idCurso';</script>";
}
$stmtInsereInscricao->close();
?>




