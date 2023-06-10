<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Carrinho</title>
    <link rel="stylesheet" href="assets/css/style2.css">
</head>
<body>
    <div class="cabecalho_carrinho">

            <div class="logo_carrinho">
                <img src="assets/imagens/logo_fundo_removido.png" alt="Logo EventFlow">
            </div>

            <nav class="botoes_carrinho">
                <a href="eventos.php"><label>Eventos</label></a>
                <a href="eventos_criados.php"><label>Meus Eventos</label></a>
                <a href="carrinho.php"><label>Carrinho</label></a>
                <a href="perfil.php"><label>Perfil</label></a>
                <a href="login.php"><label>Logout</label></a>
            </nav>

            <center>
                <div class="nome_carrinho">
                    <h1>Carrinho</h1>
                </div>
            </center>


            <?php
            session_start();

            // Incluir o arquivo de conexão com o banco de dados
            include 'conexao.php';

            // Armazenar o ID do carrinho em uma variável de sessão
            $_SESSION['idcarrinho'] = mysqli_insert_id($conexao);

            // Verificar se foi enviado o ID do item da loja
            if (isset($_POST['iditem_loja'])) {
                // Obter o ID do item da loja selecionado
                $iditem_loja = $_POST['iditem_loja'];

                // Verificar se o carrinho já existe para o usuário
                $query_verificar_carrinho = "SELECT * FROM carrinho WHERE idusuario = 1"; 
                // Substitua o valor 1 pelo ID do usuário atual
                $result_verificar_carrinho = mysqli_query($conexao, $query_verificar_carrinho);

                if (mysqli_num_rows($result_verificar_carrinho) > 0) {
                    // Carrinho já existe, obter o ID do carrinho
                    $row_carrinho = mysqli_fetch_assoc($result_verificar_carrinho);
                    $idcarrinho = $row_carrinho['idcarrinho'];
                } else {
                    // Carrinho não existe, criar um novo carrinho
                    $query_criar_carrinho = "INSERT INTO carrinho (idusuario) VALUES (1)"; 
                    // Substitua o valor 1 pelo ID do usuário atual
                    mysqli_query($conexao, $query_criar_carrinho);

                    // Obter o ID do carrinho recém-criado
                    $idcarrinho = mysqli_insert_id($conexao);
                }

                // Verificar se o item já está no carrinho
                $query_verificar_item = "SELECT * FROM carrinho_ingresso WHERE idcarrinho = $idcarrinho AND id_ingresso = $iditem_loja";
                $result_verificar_item = mysqli_query($conexao, $query_verificar_item);

                if (mysqli_num_rows($result_verificar_item) > 0) {
                    // O item já está no carrinho, atualizar a quantidade
                    $row_item = mysqli_fetch_assoc($result_verificar_item);
                    $quantidade = $row_item['quantidade'] + 1;
                    $query_update = "UPDATE carrinho_ingresso SET quantidade = $quantidade WHERE idcarrinho = $idcarrinho AND id_ingresso = $iditem_loja";
                    mysqli_query($conexao, $query_update);
                } else {
                    // O item não está no carrinho, inserir com quantidade 1
                    $query_insert = "INSERT INTO carrinho_ingresso (idcarrinho, id_ingresso, quantidade) VALUES ($idcarrinho, $iditem_loja, 1)";
                    mysqli_query($conexao, $query_insert);
                }
            }

            // Verificar se foi enviado o ID do item para remover do carrinho
            if (isset($_POST['remover_item'])) {
                $iditem_loja_remover = $_POST['remover_item'];

                // Remover o item do carrinho
                $query_delete = "DELETE FROM carrinho_ingresso WHERE id_ingresso = $iditem_loja_remover";
                mysqli_query($conexao, $query_delete);
            }

            // Consultar os itens do carrinho
            $query_carrinho = "SELECT iten_loja.*, carrinho_ingresso.quantidade FROM iten_loja INNER JOIN carrinho_ingresso ON iten_loja.iditem_loja = carrinho_ingresso.id_ingresso";
            $result_carrinho = mysqli_query($conexao, $query_carrinho);

            echo '<div class="container_carrinho">';
            // Verificar se há itens no carrinho
            if (mysqli_num_rows($result_carrinho) > 0) {
                // Exibir os itens do carrinho
                $total_valor = 0;
                
                echo '<div class="conteudo_carrinho">';
                echo'<div class="informacoes_carrinho">';
                echo'<table>';
                echo '<tr><th>Nome</th><th>Descrição</th><th>Quantidade</th><th>Valor</th><th>Ação</th></tr>';
                while ($row_carrinho = mysqli_fetch_assoc($result_carrinho)) {
                    echo '<tr>';
                    echo '<td>' . $row_carrinho['nome'] . '</td>';
                    echo '<td>' . $row_carrinho['descricao'] . '</td>';
                    echo '<td>';
                    echo '<form action="" method="POST">';
                    echo'<div class="dados_carrinho">';
                    echo '<input type="hidden" name="iditem_loja" value="' . $row_carrinho['iditem_loja'] . '">';
                    echo '<input type="number" name="quantidade" value="' . $row_carrinho['quantidade'] . '">';
                    echo '<button type="submit" value="Atualizar">Atualizar</button>';
                    echo '</form>';
                    echo '</td>';
                    echo '<td>' . $row_carrinho['valor'] . '</td>';
                    echo '<td>';
                    echo '<form action="" method="POST">';
                    echo'<div class="dados_carrinho">';
                    echo '<input type="hidden" name="remover_item" value="' . $row_carrinho['iditem_loja'] . '">';
                    echo '<button type="submit" value="Remover">Remover</button>';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr></div>';
                    echo'</div>';
                    // Calcular o valor total da compra
                    $total_valor += $row_carrinho['valor'] * $row_carrinho['quantidade'];
                    
                }
                echo '</table><hr>';

                // Exibir o valor total da compra
                echo '<p>Total: R$ ' . $total_valor . '</p>';
                echo'</div>';
                
                // Botão de finalizar compra
                echo '<form class="form_carrinho" action="tela_pagamento.php" method="POST">';
                echo'<div class="botao_carrino">';
                echo '<input type="hidden" name="total_valor" value="' . $total_valor . '">';
                echo '<button type="submit" value="Finalizar Compra">Finalizar Compra</button><br>';
                echo '</form>';
                // Botão para voltar à loja
                echo '<button><a href="loja.php">Continuar Comprando</a></button>';
                echo'</div>';
                echo'</div>';
                
    
            } else {
                echo'<center>';
                echo'<div class="botao_carrino">';
                echo '<p id="nome_o_carrinho_esta_vazio">O carrinho está vazio.</p>';
                // Botão para voltar à loja
                echo '<button><a href="loja.php">Continuar Comprando</a></button>';
                echo'</div>';
                echo'</center>';
            }
            
            // Fechar a conexão com o banco de dados
            mysqli_close($conexao);
            
            ?>

    </div>
</body>
</html>