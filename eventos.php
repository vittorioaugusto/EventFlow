<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos</title>
    <link rel="stylesheet" href="assets/css/style2.css">
</head>
<body>
    <div class="cabecalho_eventos">
        
        <div class="logo_principal">
            <img src="assets/imagens/logo_fundo_removido.png" alt="Logo EventFlow">
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

        // Verificar o tipo de usuário
        $query_tipo_usuario = "SELECT tipo_user FROM usuario WHERE idusuario = $idusuario";
        $resultado_tipo_usuario = mysqli_query($conexao, $query_tipo_usuario);
        $row_tipo_usuario = mysqli_fetch_assoc($resultado_tipo_usuario);
        $tipo_usuario = $row_tipo_usuario['tipo_user'];
        ?>

        <nav class="botoes_eventos">
            <a href="eventos.php"> <label>Eventos</label></a>
            <?php
            // Verificar se o usuário é empresarial para exibir o botão de subir evento
            if ($tipo_usuario == 2) {
                echo '<a href="criar_eventos.php"><label>Criar Evento</label></a>';
            }
            ?>
            <a href="perfil.php"> <label>Perfil</label></a>
            <a href="login.php"> <label>Logout</label></a>
        </nav>

        <center>
        <div class="nome_usuario_eventos">
            <h2>Bem-vindo(a), <?php echo $nome_usuario; ?></h2>
        </div>

        <div class="caixa_eventos">
        
            <h1 id="todos_os_eventos">Todos os Eventos</h1>

            <?php
            // Consultar os eventos no banco de dados
            $consulta = "SELECT * FROM eventos";
            $resultado = mysqli_query($conexao, $consulta);

            // Verificar se existem eventos cadastrados
            if (mysqli_num_rows($resultado) > 0) {
                // Exibir os eventos
                while ($row = mysqli_fetch_assoc($resultado)) {
                    echo '<a href="info_evento.php?id=' . $row["id_evento"] . '" class="caixa_evento">';
                    echo '<div class="cartao">';
                    echo '<div class="cartao_esquerdo">';
                    echo '<span>' . $row["nome_evento"] . '</span>';
                    echo '<h1>' . $row["nome_evento"] . '</h1>';
                    echo '<h3>' . $row["descricao"] . '</h3>';
                    echo '<a href="evento.php?id=' . $row["idevento"] . '">Clique aqui para saber mais!</a>';
                    echo '</div>';
                    echo '<div class="cartao_direito">';
                    echo '<img id="imagem" src="' . $row["imagem"] . '" alt="Evento">';
                    echo '</div>';
                    echo '</div>';
                    echo '</a>';
                }
            } else {
                echo '<p>Nenhum evento encontrado.</p>';
            }

            // Fechar a conexão com o banco de dados
            mysqli_close($conexao);
            ?>

        </div>
    </div>
        </center>
        

    
</body>
</html>
