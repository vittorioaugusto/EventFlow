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
            <img src="assets/imagens/logo_fundo_removido.png" alt="Logo EventFlow" width="200">
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
                    <a href="historico_ingressos.php"><label>Meus Ingressos</label></a>
                    <a href="carrinho.php"><label>Carrinho</label></a>
                    <a href="EventFlow.php"><button class="Btn">
                    <div class="sign"><svg viewBox="0 0 512 512">
                    <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg></div>
                    <div class="text">Logout</div></button></a>
                <?php } elseif ($tipo_usuario == 2) { ?>
                    <a href="perfil.php"><label>Perfil</label></a>
                    <a href="eventos_criados.php"><label>Eventos Criados</label></a>
                    <a href="criar_eventos.php"><label>Criar Evento</label></a>
                    <a href="carrinho.php">Carrinho</a>
                    <a href="EventFlow.php"><button class="Btn">
                    <div class="sign"><svg viewBox="0 0 512 512">
                    <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path></svg></div>
                    <div class="text">Logout</div></button></a>
                <?php } ?>
            </nav>
            
                <center>
                <div class="nome_usuario_eventos">
                    <h1>Bem-vindo(a) ao EventFlow, <?php echo $nome_usuario; ?>!</h1> 
                </div>
                <h1 id="todos_os_eventos">Todos os Eventos</h1>
                </center>

            <div class="container_eventos_2">
           
                        <?php
                            // Consultar os eventos no banco de dados
                            $consulta = "SELECT * FROM eventos";
                            $resultado = mysqli_query($conexao, $consulta);

                            // Verificar se existem eventos cadastrados
                            if (mysqli_num_rows($resultado) > 0) {
                                // Exibir os eventos
                                while ($row = mysqli_fetch_assoc($resultado)) {
                                    // Obter a data de início e fim do evento
                                    echo '<div class="caixa_eventos"><a href="info_evento.php?id=' . $row["idevento"] . '" class="caixa_evento">';
                                    $dataInicio = date("d/m", strtotime($row["data_inicio_evento"]));
                                    $dataFim = date("d/m", strtotime($row["data_final_evento"]));
                                    echo '<div class="cartao">';
                                    echo '<div class="cartao_esquerdo">';
                                    echo '<span>' . $dataInicio . ' - ' . $dataFim . '</span>';
                                    echo '<h1>' . $row["nome_evento"] . '</h1>';
                                    echo '<h3>' . $row["palavra_chave"] . '</h3>';
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
    </div>
   
</body>
</html>