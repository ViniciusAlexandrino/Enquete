<!DOCTYPE html>
<html>
<head>
    <title>Enquete</title>
</head>
<body>
    <h2>Enquete: Qual é a sua cor favorita?</h2>

    <form method="post">
        <input type="radio" id="azul" name="cor" value="azul" required>
        <label for="azul">Azul</label><br>
        <input type="radio" id="vermelho" name="cor" value="vermelho">
        <label for="vermelho">Vermelho</label><br>
        <input type="radio" id="verde" name="cor" value="verde">
        <label for="verde">Verde</label><br><br>
        <button type="submit" name="votar">Votar</button>
    </form>

    <?php
    // Função para salvar o voto do usuário
    function salvarVoto($cor) {
        // Abre ou cria o arquivo de votos
        $arquivo = fopen('votos.txt', 'a');
        // Adiciona o voto ao arquivo
        fwrite($arquivo, "$cor\n");
        // Fecha o arquivo
        fclose($arquivo);
    }

    // Função para contar os votos de cada opção
    function contarVotos() {
        // Verifica se o arquivo de votos existe
        if (file_exists('votos.txt')) {
            // Lê os votos do arquivo
            $votos = file('votos.txt', FILE_IGNORE_NEW_LINES);
            // Conta os votos de cada cor
            $contagem = array_count_values($votos);
            return $contagem;
        } else {
            return array();
        }
    }

    // Verifica se o formulário de votar foi submetido
    if (isset($_POST['votar'])) {
        $corVotada = $_POST['cor'];
        salvarVoto($corVotada);
    }

    // Exibe os resultados da votação
    $resultados = contarVotos();
    if (!empty($resultados)) {
        echo "<h3>Resultados:</h3>";
        echo "<ul>";
        foreach ($resultados as $cor => $votos) {
            echo "<li>$cor: $votos voto(s)</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Ainda não houve votos.</p>";
    }
    ?>
</body>
</html>
