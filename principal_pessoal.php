<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Principal | Usuário Pessoal</title>
    <link rel="stylesheet" href="assets/css/principal_pessoal.css">

</head>
<body>
    <div class="cabecalho">
        <div class="logo_principal">
            <img src="assets/imagens/logo_fundo_removido.png" alt="Logo EventFlow">
        </div>
    
        <nav class="botoes">
            <a href="principal_pessoal.php"> <label>Eventos</label></a>
            <a href="eventos_pessoal.php"> <label>Meus Eventos</label></a>
            <a href="perfil_pessoal.php"> <label>Perfil</label></a>       
        </nav>

        <div class="evento_destaque">
            <h1>Evento em destaque no EventFlow</h1>
        </div>

        <div class="caixa_evento">
            <img id="imagem_caixa" src="assets/imagens/evento_bgs.png" alt="Evento BGS">
            <h1 id="caixa_nome">Brasil Game Show</h1>
            <div class="caixa_botao">
                <?php
                    echo '<a href="evento_bgs.php">Ver Detalhes</a>';
                ?>
            </div>
        </div>

        <h1 id="todos_os_eventos">Todos os Eventos</h1>
        
        <div class="cartao">
                <div class="cartao_esquerdo">
                    <span>Evento de Games</span>
                    <h1>BGS - 2023</h1>
                    <h3>Venha fazer parte dessa aventura!</h3>
                    <a href="evento_bgs.php">Clique aqui para saber mais!</a>
                </div>
                <div class="cartao_direito">
                    <img id="imagem" src="assets/imagens/evento_bgs.png" alt="Evento BGS">
                </div>
            </div>

            
    </div>   
</body>
</html>