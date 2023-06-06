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
            
            <div class="logo_eventos">
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
        $query_usuario = "SELECT nome, tipo_user FROM usuario WHERE idusuario = $idusuario";
        $resultado_usuario = mysqli_query($conexao, $query_usuario);
        $row_usuario = mysqli_fetch_assoc($resultado_usuario);
        $nome_usuario = $row_usuario['nome'];
        $tipo_usuario = $row_usuario['tipo_user'];
        ?>
            
            <nav class="botoes_eventos">
                <?php if ($tipo_usuario == 1) { ?>
                    <a href="perfil.php"><label>Perfil</label></a>
                    <a href="meus_eventos.php"><label>Meus Eventos</label></a>
                    <a href="carrinho.php"><label>Carrinho</label></a>
                    <a href="login.php"><label>Logout</label></a>
                <?php } elseif ($tipo_usuario == 2) { ?>
                    <a href="perfil.php"><label>Perfil</label></a>
                    <a href="eventos_criados.php"><label>Eventos Criados</label></a>
                    <a href="criar_eventos.php"><label>Criar Evento</label></a>
                    <a href="carrinho.php">Carrinho</a>
                    <a href="login.php"><label>Logout</label></a>
                <?php } ?>
            </nav>
            
            <div class="container_eventos_2">
            <center>
                <div id="nome_usuario_eventos">
                    <h1>Bem-vindo(a) ao EventFlow, <?php echo $nome_usuario; ?>!</h1>  
                </div>

                <h1 id="todos_os_eventos">Todos os Eventos</h1>
                    <div class="caixa_eventos">
                        <?php
                            // Consultar os eventos no banco de dados
                            $consulta = "SELECT * FROM eventos";
                            $resultado = mysqli_query($conexao, $consulta);

                            // Verificar se existem eventos cadastrados
                            if (mysqli_num_rows($resultado) > 0) {
                                // Exibir os eventos
                                while ($row = mysqli_fetch_assoc($resultado)) {
                                    echo '<div class="informacoes_eventos"><a href="info_evento.php?id=' . $row["idevento"] . '" class="caixa_evento">';
                                    echo '<div class="cartao">';
                                    echo '<div class="cartao_esquerdo">';
                                    echo '<span>' . $row["nome_evento"] . '</span>';
                                    echo '<h1>' . $row["nome_evento"] . '</h1>';
                                    echo '<h3>' . $row["descricao"] . '</h3>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</a></div>';
                                }
                            } else {
                                echo '<p id="nome_nenhum_evento_encontrado">Nenhum evento encontrado.</p>';
                            }

                            // Fechar a conexão com o banco de dados
                            mysqli_close($conexao);
                            ?>
                           
                    </div>
                </center> 
            </div>
                   
    </div>
   
</body>
</html>
