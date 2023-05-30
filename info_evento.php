<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações do Evento</title>
    <link rel="stylesheet" href="assets/css/style2.css">
</head>
<body>
    <div class="container_info_evento">
        <div class="cabecalho_info_evento">
            <div class="logo_info_evento">
                <img src="assets/imagens/logo_fundo_removido.png" alt="Logo EventFlow">
            </div>

                <?php
                // Incluir o arquivo de conexão com o banco de dados
                require_once "conexao.php";


                // Função para verificar se o usuário é o criador do evento
                function verificarCriadorEvento($id_evento, $idusuario, $conexao) {
                    // Consultar o banco de dados para verificar se o usuário é o criador do evento
                    $query = "SELECT idevento FROM eventos WHERE idevento = $id_evento AND idusuario = $idusuario";
                    $resultado = mysqli_query($conexao, $query);

                    return (mysqli_num_rows($resultado) > 0);
                }

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

            <nav class="botoes_info_evento">
                <?php if ($tipo_usuario == 2): // Cadastro Empresarial ?>
                    <a href="criar_eventos.php"><label>Criar Eventos</label></a>
                    <a href="eventos_criados.php"><label>Eventos Criados</label></a>
                <?php else: // Cadastro Pessoal ?>
                    <a href="eventos.php"><label>Eventos</label></a>
                    <a href="meus_eventos.php"><label>Meus Eventos</label></a>
                <?php endif; ?>
                <a href="perfil.php"><label>Perfil</label></a>
                <a href="login.php"><label>Logout</label></a>
            </nav>

            <center>
 
            <div class="container_info_evento_2">
                <div class="info_evento">
                    
                        
                    
                    <?php
                    // Verificar se foi fornecido o parâmetro de ID do evento
                    if (isset($_GET['id'])) {
                        // Obter o ID do evento a partir do parâmetro da URL
                        $id_evento = $_GET['id'];

                        // Consultar o evento no banco de dados
                        $query_evento = "SELECT * FROM eventos WHERE idevento = $id_evento";
                        $resultado_evento = mysqli_query($conexao, $query_evento);
                        $dados_evento = mysqli_fetch_assoc($resultado_evento);
                        
                        if ($dados_evento) {
                            echo '<h1>' . $dados_evento['nome_evento'] . '</h1>';

                            // Formatando a data do evento para o padrão brasileiro
                            $data_evento = date('d/m/Y', strtotime($dados_evento['data_evento']));
                            echo '<p>Data do Evento: ' . $data_evento . '</p>';

                            echo '<h2>Ingressos:</h2>';

                            // Consultar os ingressos relacionados ao evento
                            $query_ingressos = "SELECT i.*, t.descricao AS tipo_ingresso FROM ingresso i INNER JOIN tipo_ingresso t ON i.id_tipoingresso = t.id_tipoingresso WHERE idevento = $id_evento";
                            $resultado_ingressos = mysqli_query($conexao, $query_ingressos);

                            if (mysqli_num_rows($resultado_ingressos) > 0) {
                                while ($dados_ingresso = mysqli_fetch_assoc($resultado_ingressos)) {
                                    echo '<p>';
                                    if ($dados_ingresso['tipo_ingresso'] == 'entrada inteira') {
                                        echo 'Tipo: Entrada Inteira<br>';
                                    } elseif ($dados_ingresso['tipo_ingresso'] == 'entrada estudante') {
                                        echo 'Tipo: Entrada Estudante<br>';
                                    }
                                    echo 'Preço: R$ ' . $dados_ingresso['valor'] . '<br>';
                                    echo 'Quantidade: ' . $dados_ingresso['quantidade'] . '<br>';
                                    echo '</p>';
                                }
                            } else {
                                echo '<p>Nenhum ingresso disponível para este evento.</p>';
                            }
                            
                            if ($tipo_usuario == 2 && verificarCriadorEvento($id_evento, $idusuario, $conexao)) { // Cadastro Empresarial
                                echo '<div class="editar_info_evento"><a href="editar_evento.php?id=' . $id_evento . '">Editar Evento</a></div>';
                            }

                            echo '<div class="editar_info_evento"><a href="eventos.php">Voltar para a lista de eventos</a></div>';
                        } else {
                            echo '<p>Evento não encontrado.</p>';
                        }
                    } else {
                        echo '<p>ID do evento não fornecido.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
        
    </center>
</body>
</html>