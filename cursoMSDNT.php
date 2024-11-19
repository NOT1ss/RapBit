<?php include_once('protect.php');

#$usuarioLogado = isset($_SESSION['usuario']); // true se logado, false caso contrário
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rap Bit | Curso</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        #btn-inscrever {
            position: relative;
            background-color: black;
            color: white;
            font-size: 16px;
            font-weight: bold;
            padding: 10px 40px;
            border: none; /* Removemos a borda padrão */
            border-radius: 25px; /* Deixa o botão arredondado */
            text-transform: uppercase;
            cursor: pointer;
            display: inline-block;
            overflow: hidden;
        }

        #btn-inscrever::before {
            content: '';
            position: absolute;
            top: -2px; /* Posiciona a borda fora do botão */
            left: -2px;
            right: -2px;
            bottom: -2px;
            border-radius: 28px; /* A borda deve ser levemente maior que o botão */
            border: 3px solid transparent; /* Borda inicial é transparente */
            background: linear-gradient(to right, #00ff00 50%, #ff00ff 50%);
            mask: 
                linear-gradient(black 0 0) padding-box, 
                linear-gradient(black 0 0);
            mask-composite: exclude;
            -webkit-mask: 
                linear-gradient(black 0 0) padding-box, 
                linear-gradient(black 0 0);
            -webkit-mask-composite: destination-out;
            pointer-events: none; /* Evita interação com a borda */
            z-index: 0;
        }

        #btn-inscrever a {
            color: white;
            text-decoration: none;
            position: relative;
            z-index: 1; /* Garante que o texto fique acima */
        }

        #btn-inscrever:hover {
            background-color: #222222;
        }

        #btn-inscrever:active {
            background-color: #222;
            transform: scale(0.98);
        }
        body.cursos .arrumarBtn {
            margin-left: 4%;
        }
    </style>
</head>
<body class="cursos">
    <!-- Cabeçalho com navegação -->
    <header class="navbar">
        <nav>
            <ul>
                <li><a href="home.html" >INÍCIO</a></li>
                <li><a href="cursos.php" class="active">CURSOS</a></li>
                <div class="logo">
                    <img src="imagens/logo.png" alt="Logo">
                </div>
                <li><a href="contato.html" >CONTATO</a></li>
                <li><a href="outros.php">OUTROS</a></li>
            </ul>
        </nav>
    </header>
    <main class="hero-section">
        <div class="escopoCursos">
            <div class="textosCursos">
                <br><br><br><br>
              <h1>Criação Inteligente: Conteúdos e Vídeos com ChatGPT e D-ID</h1>
            </div>
            <div class="imagemCursos">
                <img src="imagens/fundo-cidade-tec.png" alt="Imagem cidade futurística" />
            </div>
        </div>
        
        <div class="textosCursos2">
            <p style="text-align: justify;">Aprenda a criar conteúdos envolventes e vídeos dinâmicos com o poder das tecnologias de IA! Neste mini-curso, você explorará o potencial do ChatGPT para gerar textos criativos e informativos e descobrirá como transformar essas ideias em vídeos impressionantes utilizando a plataforma D-ID Creative Reality. Ideal para empreendedores, educadores e criadores de conteúdo que desejam inovar na comunicação digital.</p>
        </div>
       
        <div class="arrumarBtn">
            <form action="inscricao.php" method="post">
            <button 
                id="btn-inscrever" 
                name="idCurso" 
                value="3" 
                type="submit">
                Inscrever-se
            </button>
            </form>
            
        </div>
        <div class="textoProf">
            <p>Prefessor Felipe</p>
        </div>
        <br><br><br><br>
    </main>
</body>
</html>
