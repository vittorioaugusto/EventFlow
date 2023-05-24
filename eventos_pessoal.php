<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos</title>
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
        

        <h1 id="todos_os_eventos2">Meus Eventos</h1>

        <div class="cartao2">
                <div class="cartao_esquerdo2">
                    <span>Evento de Games</span>
                    <h1>BGS - 2023</h1>
                    <h3>Venha fazer parte dessa aventura!</h3>
                    <div class="caixa_botao2">
                        <?php
                            echo '<a href="evento_bgs.php">Ver Evento</a>';
                        ?>
                    </div>
                    
                </div>
                <div class="cartao_direito2">
                    <img id="imagem2" src="assets/imagens/evento_bgs.png" alt="Evento BGS">
                </div>
            </div>

    </div>
</body>
</html>