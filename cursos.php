<?php include('protect.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rap Bit | Cursos</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="scrip/menu.js"></script>
    <style>
        .btn-inscrever {
            position: relative;
            background-color: #1F1F2B;
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

        .btn-inscrever::before {
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

        .btn-inscrever a {
            color: white;
            text-decoration: none;
            position: relative;
            z-index: 1; /* Garante que o texto fique acima */
        }

        .btn-inscrever:hover {
            background-color: #212121;
        }

        .btn-inscrever:active {
            background-color: #222;
            transform: scale(0.98);
        }
        h2{
            width: 400px;
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
              <h1 style="margin-top: 12%;">Desbloqueie o Futuro com Inteligência Artificial</h1>
              <p>Explore nossos cursos gratuitos e aprenda com especialistas para construir uma carreira promissora na era digital.</p>
            </div>
            <div class="imagemCursos">
                <img src="imagens/fundo-cidade-tec.png" alt="Imagem cidade futurística" />
            </div>
        </div>
        <div class="textosCursos2">
            <h1 style="font-size: 35px;">Nossos Cursos</h1>

            <div class="cursos-container">
                <!-- Curso 1 -->
                <div class="curso-box">
                    <h2>Criação Inteligente: Conteúdos e Vídeos com ChatGPT e D-ID</h2>
                    <div class="curso-conteudo">
                        <img src="imagens/gpt.png" alt="Logo GPT-4">
                        <img src="imagens/d-id-Xfundo.png" alt="Logo D-ID">
                    </div>
                    <p>Prof. Fefe Vulgo Felphes</p>
                    <button class="btn-inscrever" style="backgroud-color=black;"><a href="cursoMSDNT.php">Inscrever-se</a></button>
                </div>
            
                <!-- Curso 2 -->
                <div class="curso-box">
                    <h2>Trabalhar com grandes volumes de dados utilizando IA</h2>
                    <div class="curso-conteudo">
                        <img src="imagens/gpt.png" alt="Logo GPT-4">
                    </div>
                    <p>Prof. Nelso</p>
                    <button class="btn-inscrever"><a href="cursoTCGVD.php">Inscrever-se</a></button>
                </div>
            </div>
        </div>
        <br><br><br><br>
        
        <script src="scrip/menu.js"></script>
    </main>
    
</body>
</html>


