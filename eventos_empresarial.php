<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos Empresarial</title>
    <link rel="stylesheet" href="assets/css/principal_empresarial.css">

</head>
<body>
    <div class="cabecalho">
        <div class="logo_principal">
            <img src="assets/imagens/logo_fundo_removido.png" alt="Logo EventFlow">
        </div>
    
        <nav class="botoes">
            <a href="principal_empresarial.php"> <label>Inicio</label></a>
            <a href="eventos_empresarial.php"> <label>Criar Evento</label></a>
            <a href="perfil_empresarial.php"> <label>Perfil</label></a>       
        </nav>

        <div class="criar_evento">
            <?php
                echo '<a href="criar_evento.php">Criar Evento</a>';
            ?>
        </div>
    
        <div class="caixa">
    
            <div class="cartao">
                <div class="cartao_esquerdo">
                    <span>Evento de Games</span>
                    <h1>BGS - 2023</h1>
                    <h3>Venha fazer parte dessa aventura!</h3>
                    <a href="editar_evento_bgs.php">Editar Evento</a>
                </div>
                <div class="cartao_direito">
                    <img id="imagem" src="assets/imagens/evento_bgs.png" alt="Evento BGS">
                </div>
            </div>

            <!-- <div class="cartao2">
                <div class="cartao_esquerdo2">
                    <span>Evento de Basquete</span>
                    <h1>BasquetBol 2023</h1>
                    <h3>Venha fazer parte dessa aventura!</h3>
                    <a href="editar_evento_basquete.php">Editar Evento</a>
                </div>
                <div class="cartao_direito2">
                    <img id="imagem2" src="assets/imagens/evento_basquete.png" alt="Evento Basquete">
                </div>
            </div> -->
    
        </div>
    
    </div>

</body>
</html>