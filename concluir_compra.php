<?php
session_start();
if (!isset($_SESSION['idusuario'])) {
    header("location: login.php");
    exit();
}

require_once "conexao.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter o ID do usuário logado
    $idusuario = $_SESSION['idusuario'];
    
    // Obter o preço total do formulário
    $preco_total = $_POST['preco_total'];
    
    // Consultar os itens do carrinho
    $query_itens_carrinho = "SELECT c.*, COALESCE(il.valor, i.valor) AS preco_item, 
                            CASE WHEN il.iditem_loja IS NULL THEN e.nome_evento ELSE il.nome END AS nome_item
                            FROM carrinho c
                            LEFT JOIN iten_loja il ON c.iditem_loja = il.iditem_loja
                            LEFT JOIN ingresso i ON c.id_ingresso = i.id_ingresso
                            LEFT JOIN eventos e ON il.idevento = e.idevento OR (i.idevento = e.idevento AND il.iditem_loja IS NULL)
                            WHERE c.idusuario = $idusuario
                            AND (il.iditem_loja IS NOT NULL OR i.id_ingresso IS NOT NULL)";
    
    $resultado_itens_carrinho = mysqli_query($conexao, $query_itens_carrinho);
    
    if ($resultado_itens_carrinho) {
        // Criar um array para armazenar os dados da venda
        $dados_venda = array();
        
        while ($row_item = mysqli_fetch_assoc($resultado_itens_carrinho)) {
            $nome_item = $row_item['nome_item'];
            $preco_item = $row_item['preco_item'];
            
            // Adicionar os dados do item à venda
            $dados_venda[] = array(
                'nome_item' => $nome_item,
                'quantidade' => 1, // A quantidade pode ser ajustada conforme necessário
                'preco_unitario' => $preco_item
            );
        }
        
        // Inserir os dados da venda na tabela 'venda'
        foreach ($dados_venda as $dados) {
            $nome_item = $dados['nome_item'];
            $quantidade = $dados['quantidade'];
            $preco_unitario = $dados['preco_unitario'];
            
            $query_insert_venda = "INSERT INTO venda (nome_item, quantidade, preco_unitario)
                                   VALUES ('$nome_item', $quantidade, $preco_unitario)";
            
            mysqli_query($conexao, $query_insert_venda);
        }
        
        // Limpar o carrinho do usuário
        $query_limpar_carrinho = "DELETE FROM carrinho WHERE idusuario = $idusuario";
        mysqli_query($conexao, $query_limpar_carrinho);
        
        // Exibir os dados da compra na página
        echo "<h1>Conclusão da Compra</h1>";
        
        echo "<h2>Itens Comprados:</h2>";
        foreach ($dados_venda as $dados) {
            $nome_item = $dados['nome_item'];
            $quantidade = $dados['quantidade'];
            $preco_unitario = $dados['preco_unitario'];
            
            echo "<p>Item: $nome_item</p>";
            echo "<p>Quantidade: $quantidade</p>";
            echo "<p>Preço Unitário: R$ $preco_unitario</p>";
            echo "<hr>";
        }
        
        echo "<h2>Preço Total: R$ $preco_total</h2>";
        
        echo "<form action='processar_compra.php' method='POST'>";
        echo "<input type='hidden' name='preco_total' value='$preco_total'>";
        echo "<input type='submit' value='Concluir Compra'>";
        echo "</form>";
    } else {
        echo "<p>Erro na consulta do banco de dados.</p>";
    }
} else {
    header("location: carrinho.php");
    exit();
}
?>