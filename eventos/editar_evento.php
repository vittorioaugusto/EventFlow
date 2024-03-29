<!DOCTYPE html>
<html>

<head>
    <title>Editar Evento</title>
    <link rel="stylesheet" href="assets/css/style2.css">
</head>

<body>
    <div class="cabecalho_editar_evento">

        <div class="logo_editar_evento">
            <a href="eventos.php"><img src="assets/imagens/logo_fundo_removido.png" alt="Logo EventFlow" title="Início" width="200"></a>
        </div>

        <nav class="botoes_editar_evento">
            <a href="eventos.php">Eventos</a>
            <a href="eventos_criados.php">Eventos Criados</a>
            <a href="carrinho.php">
                <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                <lord-icon src="https://cdn.lordicon.com/slkvcfos.json" trigger="hover" colors="primary:white,secondary:white" style="width:65px;height:65px;top:5px;">
                </lord-icon>
            </a>
            <a href="perfil.php">
                <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                <lord-icon src="https://cdn.lordicon.com/dxjqoygy.json" trigger="hover" colors="primary:white,secondary:white" style="width:65px;height:65px;top:5px;">
                </lord-icon>
            </a>
            <a href="EventFlow.php"><button class="Btn">
                    <div class="sign"><svg viewBox="0 0 512 512">
                            <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                        </svg></div>
                    <div class="text">Logout</div>
                </button></a>
        </nav>

        <?php
        // Incluir o arquivo de conexão com o banco de dados
        require_once "../SQL/conexao.php";

        // Verificar se o ID do evento foi fornecido via GET
        if (isset($_GET['id'])) {
            $idEvento = $_GET['id'];

            // Verificar se o formulário foi enviado
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Obter os dados do formulário para atualizar o evento
                $nomeEvento = $_POST['nome_evento'];
                $endereco = $_POST['endereco'];
                $descricao = $_POST['descricao'];
                $dataInicioEvento = $_POST['data_inicio_evento'];
                $dataFinalEvento = $_POST['data_final_evento'];
                $horarioInicial = $_POST['horario_inicial'];
                $horarioFinal = $_POST['horario_final'];

                // Atualizar os dados do evento no banco de dados
                $queryAtualizarEvento = "UPDATE eventos SET nome_evento = ?, endereco = ?, descricao = ?, data_inicio_evento = ?, data_final_evento = ?, horario_inicial = ?, horario_final = ? WHERE idevento = ?";
                $stmtAtualizarEvento = $conexao->prepare($queryAtualizarEvento);
                $stmtAtualizarEvento->bind_param('sssssisi', $nomeEvento, $endereco, $descricao, $dataInicioEvento, $dataFinalEvento, $horarioInicial, $horarioFinal, $idEvento);
                $resultadoAtualizarEvento = $stmtAtualizarEvento->execute();

                // Verificar se a atualização do evento foi bem-sucedida
                if ($resultadoAtualizarEvento) {
                    // Redirecionar para a página de eventos após a atualização bem-sucedida
                    header('Location: eventos.php');
                    exit();
                } else {
                    // Exibir mensagem de erro caso a atualização do evento tenha falhado
                    echo 'Erro ao atualizar o evento.';
                }

                // Obter os dados dos ingressos para atualizar
                $quantidades = $_POST['quantidade'];
                $valores = $_POST['valor'];

                // Atualizar os ingressos do evento no banco de dados
                $queryAtualizarIngressos = "UPDATE ingresso SET quantidade = ?, valor = ? WHERE id_ingresso = ? AND idevento = ?";
                $stmtAtualizarIngressos = $conexao->prepare($queryAtualizarIngressos);

                foreach ($quantidades as $indice => $quantidade) {
                    $valor = $valores[$indice];
                    $idIngresso = $indice + 1; // Supondo que os IDs dos ingressos começam em 1

                    $stmtAtualizarIngressos->bind_param('ddii', $quantidade, $valor, $idIngresso, $idEvento);
                    $resultadoAtualizarIngressos = $stmtAtualizarIngressos->execute();

                    // Verificar se a atualização do ingresso foi bem-sucedida
                    if (!$resultadoAtualizarIngressos) {
                        // Exibir mensagem de erro caso a atualização do ingresso tenha falhado
                        echo 'Erro ao atualizar os ingressos.';
                        break; // Sair do loop em caso de erro
                    }
                }
            }

            // Obter os dados do evento do banco de dados
            $queryObterEvento = "SELECT * FROM eventos WHERE idevento = ?";
            $stmtObterEvento = $conexao->prepare($queryObterEvento);
            $stmtObterEvento->bind_param('i', $idEvento);
            $stmtObterEvento->execute();
            $resultadoObterEvento = $stmtObterEvento->get_result();

            // Verificar se o evento foi encontrado
            if ($resultadoObterEvento && $resultadoObterEvento->num_rows > 0) {
                $evento = $resultadoObterEvento->fetch_assoc();
            } else {
                // Redirecionar para a página de eventos se o evento não for encontrado
                header('Location: eventos.php');
                exit();
            }

            // Obter os dados dos ingressos do evento do banco de dados
            $queryObterIngressos = "SELECT * FROM ingresso WHERE idevento = ?";
            $stmtObterIngressos = $conexao->prepare($queryObterIngressos);
            $stmtObterIngressos->bind_param('i', $idEvento);
            $stmtObterIngressos->execute();
            $resultadoObterIngressos = $stmtObterIngressos->get_result();

            // Verificar se existem ingressos para o evento
            if ($resultadoObterIngressos && $resultadoObterIngressos->num_rows > 0) {
                $ingressos = $resultadoObterIngressos->fetch_all(MYSQLI_ASSOC);
            } else {
                $ingressos = array();
            }
        } else {
            // Redirecionar para a página de eventos se o ID do evento não for fornecido
            header('Location: eventos.php');
            exit();
        }
        ?>

        <div class="cabecalho_editar_evento_2">
            <div class="caixa_editar_evento">

                <form method="POST">
                    <div class="informacoes_editar_evento">
                        <center>
                            <h1>Editar Evento</h1>
                            <hr>
                        </center>
                        <label for="nome_evento">Nome do Evento:</label>
                        <input type="text" id="nome_evento" name="nome_evento" value="<?php echo $evento['nome_evento']; ?>">

                        <label for="endereco">Endereço:</label>
                        <input type="text" id="endereco" name="endereco" value="<?php echo $evento['endereco']; ?>"><br>

                        <label for="descricao">Descrição:</label><br>
                        <textarea id="descricao" name="descricao" style="resize: none"><?php echo $evento['descricao']; ?></textarea><br>

                        <label for="data_inicio_evento">Data de Início do Evento:</label>
                        <input type="date" id="data_inicio_evento" name="data_inicio_evento" value="<?php echo $evento['data_inicio_evento']; ?>">

                        <label for="data_final_evento">Data de Término do Evento:</label>
                        <input type="date" id="data_final_evento" name="data_final_evento" value="<?php echo $evento['data_final_evento']; ?>"><br>

                        <label for="horario_inicial">Horário de Início:</label>
                        <input type="time" id="horario_inicial" name="horario_inicial" value="<?php echo $evento['horario_inicial']; ?>">

                        <label for="horario_final">Horário de Término:</label>
                        <input type="time" id="horario_final" name="horario_final" value="<?php echo $evento['horario_final']; ?>"><br>

                        <h2>Ingressos</h2>
                        <?php foreach ($ingressos as $ingresso) : ?>
                            <label for="quantidade_<?php echo $ingresso['id_ingresso']; ?>">Quantidade:</label>
                            <input type="number" id="quantidade_<?php echo $ingresso['id_ingresso']; ?>" name="quantidade[<?php echo $ingresso['id_ingresso']; ?>]" value="<?php echo $ingresso['quantidade']; ?>"><br>
                            <label for="valor_<?php echo $ingresso['id_ingresso']; ?>">Valor:</label>
                            <input type="text" id="valor_<?php echo $ingresso['id_ingresso']; ?>" name="valor[<?php echo $ingresso['id_ingresso']; ?>]" value="<?php echo $ingresso['valor']; ?>">
                            <label for="valor_estudante_<?php echo $ingresso['id_ingresso']; ?>">Valor Estudante:</label>
                            <input type="text" id="valor_estudante_<?php echo $ingresso['id_ingresso']; ?>" name="valor_estudante[<?php echo $ingresso['id_ingresso']; ?>]" value="<?php echo $ingresso['valor'] / 2; ?>" readonly><br>
                        <?php endforeach; ?>
                    </div>

                    <div class="atualizar_editar_evento">
                        <button type="submit" value="Atualizar">Atualizar</button>
                        <?php
                        echo '<a href="info_evento.php?id="><button>Voltar</button></a>';
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>