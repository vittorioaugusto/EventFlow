<?php
// Inclua o arquivo de conexão com o banco de dados
require_once 'conexao.php';

// Inicie a sessão
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['idusuario'])) {
    // Redirecione para a página de login ou exiba uma mensagem de erro
    header('Location: login.php');
    exit();
}

// Obtenha a ID do usuário logado
$idUsuario = $_SESSION['idusuario'];

// Query para obter as compras do usuário logado na tabela 'venda'
$query = "SELECT * FROM venda WHERE idusuario = $idUsuario";

// Executa a query
$resultado = mysqli_query($conexao, $query);

// Verifique se a consulta retornou resultados
if (mysqli_num_rows($resultado) > 0) {
    // Loop pelos resultados e exibição dos itens comprados
    while ($row = mysqli_fetch_assoc($resultado)) {
        echo "Item comprado: " . $row['nome_item'] . "<br>";
        echo "Quantidade: " . $row['quantidade'] . "<br>";
        echo "Preço unitário: " . $row['preco_unitario'] . "<br>";
        echo "<br>";
    }
} else {
    echo "Nenhum item comprado encontrado.";
}

// Feche a conexão com o banco de dados
mysqli_close($conexao);
?>