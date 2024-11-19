<?php
include_once('protect.php');
include_once('conexao.php');

// Obter o ID do professor
$idProfessor = $_SESSION['usuario']['ID_Usuario'];

// Quando o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['curso'])) {
    $idCurso = $_POST['curso'];
    
    // Consultar o banco de dados para obter o nome do curso
    $stmt = $mysqli->prepare("SELECT Nome_Curso FROM curso WHERE ID_Curso = ?");
    $stmt->bind_param("i", $idCurso);
    $stmt->execute();
    $stmt->bind_result($nomeCurso);
    $stmt->fetch();
    $stmt->close();
    // Buscar os alunos matriculados nesse curso
    $stmt = $mysqli->prepare("SELECT usuario.ID_Usuario, usuario.Nome, usuario.Email, usuario.Telefone, usuario.Data_Nascimento, inscricao.Data_Inscricao
    FROM inscricao
    JOIN aluno ON inscricao.ID_Aluno = aluno.ID_Aluno
    JOIN usuario ON aluno.ID_Usuario = usuario.ID_Usuario
    WHERE inscricao.ID_Curso = ?");
    $stmt->bind_param("i", $idCurso);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $alunos = [];

    while ($row = $resultado->fetch_assoc()) {
        $alunos[] = $row;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sessão Professor</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Estilos do conteúdo principal */
        .professor-container {
            background-color: #141414;
            color: white;
            font-family: Arial, sans-serif;
            padding: 20px;
            margin: 10% auto;
            max-width: 800px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.6);
            margin-top: 10%;
        }

        .professor-container h1 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 24px;
            color: #ffffff;
        }

        .professor-container h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 18px;
            color: #f1f1f1;
        }

        /* Estilo da lista de alunos */
        .alunos-lista {
            background-color: #1f1f1f;
            border-radius: 10px;
            padding: 10px;
        }

        .aluno {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #282828;
            border: 1px solid #333;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
            color: white;
        }

        .aluno strong {
            color: #00ff00;
        }

        .aluno:nth-child(even) {
            border-left: 5px solid #00ff00; /* Verde */
        }

        .aluno:nth-child(odd) {
            border-left: 5px solid #ff00ff; /* Rosa */
        }

        .detalhes-aluno {
            background-color: #1a1a1a;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            display: none; /* Inicialmente oculto */
        }

        /* Estilo do botão "Ver Mais" */
        .ver-mais-btn {
            padding: 8px 12px;
            background-color: #00ff00;
            border: none;
            border-radius: 5px;
            color: black;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .ver-mais-btn:hover {
            background-color: #ff00ff;
            color: white;
        }

        /* Estilo do formulário */
        .curso-selecao {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 100px;
            gap: 10px;
            height: 150px;
            background-color: black;
        }

        .curso-selecao label {
            font-size: 16px;
            color: white;
        }

        .curso-selecao select {
            padding: 8px;
            border: 1px solid #00ff00;
            border-radius: 5px;
            background-color: #1f1f1f;
            color: white;
            font-size: 14px;
        }

        .curso-selecao select:focus {
            outline: none;
            border-color: #ff00ff;
            box-shadow: 0 0 5px #ff00ff;
        }

        .curso-selecao button {
            padding: 8px 12px;
            background-color: #00ff00;
            border: none;
            border-radius: 5px;
            color: black;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .curso-selecao button:hover {
            background-color: #ff00ff;
            color: white;
        }

    </style>
    <script>
        function toggleDetails(id) {
            var details = document.getElementById(id);
            if (details.style.display === "none" || details.style.display === "") {
                details.style.display = "block";
            } else {
                details.style.display = "none";
            }
        }
    </script>
</head>
<body>
    <header class="navbar">
        <nav>
            <ul>
                <li><a href="home.html">INÍCIO</a></li>
                <li><a href="cursos.php" class="active">CURSOS</a></li>
                <div class="logo">
                    <img src="imagens/logo.png" alt="Logo">
                </div>
                <li><a href="contato.html">CONTATO</a></li>
                <li><a href="outros.php">OUTROS</a></li>
            </ul>
        </nav>
    </header>

    <main class="professor-container">
        <!-- Formulário para seleção de curso -->
        <form class="curso-selecao" method="POST">
            <label for="curso">Escolha o curso:</label>
            <select id="curso" name="curso">
                <option value="" disabled selected>Selecionar</option>
                <option value="3">Curso 1 - Criação Inteligente: Conteúdos e Vídeos com ChatGPT e D-ID</option>
                <option value="4">Curso 2 - Trabalhar com grandes volumes de dados utilizando IA</option>
            </select>
            <button type="submit">Selecionar</button>
        </form>

        <h1><?php echo isset($nomeCurso) && !empty($nomeCurso) ? htmlspecialchars($nomeCurso) : "Selecione um curso"; ?></h1>
        <h2>Alunos</h2>
        <section class="alunos-lista">
            <?php if (isset($alunos) && count($alunos) > 0): ?>
                <?php foreach ($alunos as $index => $aluno): ?>
                    <div class="aluno">
                        <p><strong><?php echo htmlspecialchars($aluno['Nome']); ?></strong></p>
                        <p>Inscrição: <?php echo date("d/m/Y", strtotime($aluno['Data_Inscricao'])); ?></p>
                        <button class="ver-mais-btn" onclick="toggleDetails('<?php echo 'detalhes-' . $aluno['ID_Usuario']; ?>')">Ver Mais</button>
                    </div>

                    <div class="detalhes-aluno" id="<?php echo 'detalhes-' . $aluno['ID_Usuario']; ?>">
                        <p><strong>Nome:</strong> <?php echo htmlspecialchars($aluno['Nome']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($aluno['Email']); ?></p>
                        <p><strong>Telefone:</strong> <?php echo htmlspecialchars($aluno['Telefone']); ?></p>
                        <p><strong>Data de Nascimento:</strong> <?php echo date("d/m/Y", strtotime($aluno['Data_Nascimento'])); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum aluno inscrito nesse curso.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
