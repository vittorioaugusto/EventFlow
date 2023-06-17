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

    // Inserir os dados da venda na tabela 'venda'
    $query_insert_venda = "INSERT INTO venda (nome_item, quantidade, preco_unitario)
                           SELECT CASE WHEN il.iditem_loja IS NULL THEN e.nome_evento ELSE il.nome END AS nome_item,
                           1 AS quantidade,
                           COALESCE(il.valor, i.valor) AS preco_unitario
                           FROM carrinho c
                           LEFT JOIN iten_loja il ON c.iditem_loja = il.iditem_loja
                           LEFT JOIN ingresso i ON c.id_ingresso = i.id_ingresso
                           LEFT JOIN eventos e ON il.idevento = e.idevento OR (i.idevento = e.idevento AND il.iditem_loja IS NULL)
                           WHERE c.idusuario = $idusuario
                           AND (il.iditem_loja IS NOT NULL OR i.id_ingresso IS NOT NULL)";

    mysqli_query($conexao, $query_insert_venda);

    // Limpar o carrinho do usuário
    $query_limpar_carrinho = "DELETE FROM carrinho WHERE idusuario = $idusuario";
    mysqli_query($conexao, $query_limpar_carrinho);

    // Obter o nome do usuário logado
    $query_nome_usuario = "SELECT nome FROM usuario WHERE idusuario = $idusuario";
    $resultado_nome_usuario = mysqli_query($conexao, $query_nome_usuario);

    if ($resultado_nome_usuario && mysqli_num_rows($resultado_nome_usuario) > 0) {
        $row_nome_usuario = mysqli_fetch_assoc($resultado_nome_usuario);
        $nome_usuario = $row_nome_usuario['nome'];

        // Obter o nome do evento
        $query_nome_evento = "SELECT e.nome_evento
                              FROM carrinho c
                              LEFT JOIN iten_loja il ON c.iditem_loja = il.iditem_loja
                              LEFT JOIN ingresso i ON c.id_ingresso = i.id_ingresso
                              LEFT JOIN eventos e ON il.idevento = e.idevento OR (i.idevento = e.idevento AND il.iditem_loja IS NULL)
                              WHERE c.idusuario = $idusuario
                              AND (il.iditem_loja IS NOT NULL OR i.id_ingresso IS NOT NULL)
                              LIMIT 1";

        $resultado_nome_evento = mysqli_query($conexao, $query_nome_evento);

        if ($resultado_nome_evento && mysqli_num_rows($resultado_nome_evento) > 0) {
            $row_nome_evento = mysqli_fetch_assoc($resultado_nome_evento);
            $nome_evento = $row_nome_evento['nome_evento'];

            // Gerar o ingresso aleatório
            $ingresso = gerarIngresso();

            // Obter o email do usuário logado
            $query_email_usuario = "SELECT email FROM login WHERE idusuario = $idusuario";
            $resultado_email_usuario = mysqli_query($conexao, $query_email_usuario);

            if ($resultado_email_usuario && mysqli_num_rows($resultado_email_usuario) > 0) {
                $row_email_usuario = mysqli_fetch_assoc($resultado_email_usuario);
                $email_usuario = $row_email_usuario['email'];

                // Enviar o email para o usuário
                $assunto = "Detalhes da Compra";
                $mensagem = "Olá $nome_usuario, obrigado por comprar o ingresso do evento '$nome_evento'. Aqui está o seu ingresso: $ingresso. Aproveite o evento!";

                // Use a biblioteca de envio de e-mails de sua preferência aqui
                // Certifique-se de configurar corretamente as credenciais e as configurações do servidor de e-mail

                if (mail($email_usuario, $assunto, $mensagem)) {
                    echo "E-mail enviado com sucesso para $email_usuario";
                } else {
                    echo "Falha ao enviar o e-mail para $email_usuario";
                }
            } else {
                echo "Não foi possível obter o e-mail do usuário";
            }

            // Exibir mensagem de sucesso
            echo "<h1>Compra Concluída</h1>";
            echo "<p>Obrigado por sua compra!</p>";
            echo "<p>Preço Total: R$ $preco_total</p>";
        } else {
            echo "Não foi possível obter o nome do evento";
        }
    } else {
        echo "Não foi possível obter o nome do usuário";
    }
} else {
    header("location: carrinho.php");
    exit();
}

// Função para gerar um ingresso aleatório
function gerarIngresso() {
    $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $ingresso = '';

    for ($i = 0; $i < 10; $i++) {
        $ingresso .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }

    return $ingresso;
}
?>