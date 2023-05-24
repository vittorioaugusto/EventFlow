<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Evento</title>
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
            <form class="form_criar_evento" action="autenticar.php" method="POST">
                <h1 id="crie_seu_evento">Crie seu Evento!</h1>

                <div>
                    <input type="text" placeholder="Nome" name="nome" required><br>
                    <input type="text" placeholder="Descrição" name="descrição" required><br>
                    <input type="text" placeholder="Local" name="local" required><br>
                    <input type="date" placeholder="Data" name="data" required><br>
                    <input type="time" placeholder="Hora" name="hora" required><br>
                    <input type="number" placeholder="Ingresso" name="ingresso" required><br>
                </div>

            
            </form>
        </center>
        

    </div>

</body>
</html>