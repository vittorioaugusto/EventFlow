<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Empresarial</title>
    <link rel="stylesheet" href="assets/css/principal_empresarial.css">
</head>
<body>
<div class="cabecalho">
        <div class="logo_principal">
            <img src="assets/imagens/logo_fundo_removido.png" alt="Logo EventFlow">
        </div>
    
        <nav class="botoes">
            <a href="eventos.php"> <label>Eventos</label></a>
            <a href="perfil.php"> <label>Perfil</label></a>
            <a href="login.php"> <label>Logout</label></a>
            
            <?php
            // Verificar se o usuário é empresarial para exibir o botão de subir evento
            if ($tipo_usuario == 2) {
                echo '<a href="criar_evento.php"> <label>Criar Evento</label></a>';
            }
            ?>
        </nav>

        <center>

		
			
	    </center>




</body>
</html>