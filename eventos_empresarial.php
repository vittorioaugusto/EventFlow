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
                    
                </div>
                <div class="cartao_direito">
                    <a href="editar_evento_bgs.php">Editar Evento</a>
                </div>
            </div>

        </div>
    
    </div>

</body>
</html>