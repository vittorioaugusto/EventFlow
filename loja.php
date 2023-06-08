<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja</title>
    <link rel="stylesheet" href="assets/css/style2.css">
</head>
<body>
    <div class="cabecalho_loja">

        <div class="logo_loja">
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


        <nav class="botoes_loja">
            <?php if ($tipo_usuario == 1): ?>
                <a href="eventos.php"><label>Eventos</label></a>
                <a href="meus_eventos.php"><label>Meus Eventos</label></a>
                <a href="carrinho.php"><label>Carrinho</label></a>
                <a href="perfil.php"><label>Perfil</label></a>
                <a href="EventFlow.php"><label>Logout</label></a>
            <?php elseif ($tipo_usuario == 2): ?>
                <a href="eventos.php"><label>Eventos</label></a>
                <a href="perfil.php"><label>Perfil</label></a>
                <a href="eventos_criados.php"><label>Eventos Criados</label></a>
                <a href="carrinho.php"><label>Carrinho</label></a>
                <a href="criar_eventos.php"><label>Criar Evento</label></a>
                <a href="EventFlow.php"><label>Logout</label></a>
            <?php endif; ?>
        </nav>


        <div class="container_loja">
            <div class="caixa_loja">
                <h1 id="nome_loja">Loja</h1>

                <?php
                // Consultar os produtos na loja
                $consulta = "SELECT * FROM iten_loja";
                $resultado = mysqli_query($conexao, $consulta);

                // Verificar se existem produtos cadastrados
                if (mysqli_num_rows($resultado) > 0) {
                    // Exibir os produtos
                    while ($row = mysqli_fetch_assoc($resultado)) {
                        echo '<div class="produto">';
                        echo '<h2>' . $row["nome_produto"] . '</h2>';
                        echo '<p>' . $row["descricao"] . '</p>';
                        echo '<p>R$' . $row["preco"] . '</p>';
                        echo '<button class="adicionar_carrinho">Adicionar ao Carrinho</button>';
                        echo '</div>';
                    }
                } else {
                    echo '<p id="nome_nenhum_produto_encontrado">Nenhum produto encontrado.</p>';
                }

                // Fechar a conexão com o banco de dados
                mysqli_close($conexao);
                ?>
            </div>
        
        </div>
    </div>
</body>
</html>

<div></div>