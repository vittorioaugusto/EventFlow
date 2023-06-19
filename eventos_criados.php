<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos Criados</title>
    <link rel="stylesheet" href="assets/css/style2.css">
</head>
<body>
    <div class="cabecalho_eventos_criados">

        <div class="logo_eventos_criados">
        <a href="eventos.php"><img src="assets/imagens/logo_fundo_removido.png" alt="Logo EventFlow" title="Inicio" width="200"></a>
        </div>

        <?php
        // Incluir o arquivo de conexão com o banco de dados
        require_once "conexao.php";

        // Verificar se o usuário está logado
        session_start();
        if (!isset($_SESSION['idusuario'])) {
            header("location: login.php");
            exit();
        }

        // Obter informações do usuário logado
        $idusuario = $_SESSION['idusuario'];
        $query_usuario = "SELECT nome FROM usuario WHERE idusuario = $idusuario";
        $resultado_usuario = mysqli_query($conexao, $query_usuario);
        $row_usuario = mysqli_fetch_assoc($resultado_usuario);
        $nome_usuario = $row_usuario['nome'];
        ?>

        <nav class="botoes_eventos_criados">
            <a href="eventos.php"><label>Eventos</label></a>
            <a href="criar_eventos.php"><label>Criar Evento</label></a>
            <a href="carrinho.php"><label>Carrinho</label></a>
            <a href="perfil.php"><label>Perfil</label></a>
            <a href="EventFlow.php"><label>Logout</label></a>
        </nav>

        <center>
            <div class="nome_usuario_eventos">
                <h1 id="nome_eventos_criados">Eventos Criados:</h1>
            </div>
        </center>
        
        <div class="container_eventos_criados">
        
                <?php
                // Consultar os eventos criados pelo usuário
                $query_eventos_criados = "SELECT * FROM eventos WHERE idusuario = $idusuario";
                $resultado_eventos_criados = mysqli_query($conexao, $query_eventos_criados);

                if (mysqli_num_rows($resultado_eventos_criados) > 0) {
                    while ($dados_evento = mysqli_fetch_assoc($resultado_eventos_criados)) {
                        echo '<div class="caixa_eventos_criados"><a href="info_evento.php?id=' . $dados_evento["idevento"] . '" class="caixa_evento">';
                        echo '<div class="cartao">';
                        echo '<div class="cartao_esquerdo">';
                        echo '<span>' . $dados_evento["nome_evento"] . '</span>';
                        echo '<h1>' . $dados_evento["nome_evento"] . '</h1>';
                        echo '<h3>' . $dados_evento["descricao"] . '</h3>';
                        echo '</div>';
                        echo '</div>';
                        echo '</a></div>';
                    }
                } else {
                    echo '<p id="nome_nenhum_evento_encontrado">Nenhum evento encontrado.</p>';
                }
                ?>
            
        </div>
        
    </div>
</body>
</html>