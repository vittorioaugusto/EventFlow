<?php
include 'conexao.php';

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processar os dados do formulário de pagamento aqui

    // Obter os produtos do carrinho
    $query_produtos = "SELECT i.nome, i.valor, ci.quantidade FROM iten_loja i
                       INNER JOIN carrinho_ingresso ci ON ci.id_ingresso = i.iditem_loja
                       INNER JOIN carrinho c ON c.idcarrinho = ci.idcarrinho";
    $result_produtos = mysqli_query($conexao, $query_produtos);

    // Calcular o valor total da compra
    $valor_total = 0;
    while ($row_produto = mysqli_fetch_assoc($result_produtos)) {
        $valor_produto = $row_produto['valor'];
        $quantidade = $row_produto['quantidade'];
        $valor_total += ($valor_produto * $quantidade);
    }

    // Processar o método de pagamento selecionado
    if (isset($_POST['metodo_pagamento'])) {
        $metodo_pagamento = $_POST['metodo_pagamento'];

        // Processar os dados do pagamento conforme o método escolhido (PIX, cartão de crédito, etc.)
        if ($metodo_pagamento == 'pix') {
            // Processar o pagamento PIX

            // Exibir a chave PIX
            $chave_pix = "1234567890"; // Substitua com a chave PIX correta
            echo "Chave PIX: $chave_pix<br>";
        } elseif ($metodo_pagamento == 'cartao') {
            // Processar o pagamento com cartão de crédito

            // Obter os dados do cartão de crédito do formulário
            $numero_cartao = $_POST['numero_cartao'];
            $nome_titular = $_POST['nome_titular'];
            $cvv = $_POST['cvv'];
            $data_validade = $_POST['data_validade'];

            // Processar os dados do cartão de crédito e finalizar a compra
            // ...

            // Limpar os produtos do carrinho e exibir a mensagem de compra concluída
            $query_limpar_carrinho = "DELETE FROM carrinho_ingresso";
            mysqli_query($conexao, $query_limpar_carrinho);

            echo "Compra concluída. Obrigado!";
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tela de Pagamento</title>
    <script>
    function exibirFormularioCartao() {
        var metodoPagamento = document.querySelector('input[name="metodo_pagamento"]:checked').value;
        var formularioCartao = document.getElementById('formulario_cartao');
        var chavePix = document.getElementById('chave_pix');

        if (metodoPagamento === 'cartao') {
            formularioCartao.style.display = 'block';
            chavePix.style.display = 'none';
        } else {
            formularioCartao.style.display = 'none';
            chavePix.style.display = 'block';
        }
    }
</script>


</head>
<body>
    <h1>Tela de Pagamento</h1>

    <h2>Itens do Carrinho:</h2>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Valor</th>
                <th>Quantidade</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Exibir os produtos do carrinho
            $result_produtos = mysqli_query($conexao, $query_produtos);
            while ($row_produto = mysqli_fetch_assoc($result_produtos)) {
                echo "<tr>";
                echo "<td>" . $row_produto['nome'] . "</td>";
                echo "<td>" . $row_produto['valor'] . "</td>";
                echo "<td>" . $row_produto['quantidade'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <h2>Valor Total: <?php echo $valor_total; ?></h2>

    <h2>Opções de Pagamento:</h2>
<form method="POST" action="">
    <input type="radio" name="metodo_pagamento" value="pix" onclick="exibirFormularioCartao()"> PIX<br>
    <input type="radio" name="metodo_pagamento" value="cartao" onclick="exibirFormularioCartao()"> Cartão de Crédito<br>

    <div id="formulario_cartao" style="display: none;">
        <h3>Dados do Cartão de Crédito:</h3>
        <label>Número do Cartão:</label>
        <input type="text" name="numero_cartao"><br>
        <label>Nome do Titular:</label>
        <input type="text" name="nome_titular"><br>
        <label>CVV:</label>
        <input type="text" name="cvv"><br>
        <label>Data de Validade:</label>
        <input type="text" name="data_validade"><br>
    </div>

    <div id="chave_pix" style="display: none;">
        <h3>Chave PIX:</h3>
        <p>1234567890</p>
    </div>

    <br>
    <input type="submit" name="submit" value="Finalizar Compra"><br>
    <a href="carrinho.php">Voltar ao Carrinho</a>
</form>
</body>
</html>