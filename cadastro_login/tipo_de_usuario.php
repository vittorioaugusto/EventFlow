<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipo de Usuário</title>
    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

    <div class="container_usuario">
        <center>
            <div class="logo_usuario">
                <a href="../EventFlow.php"><img src="../assets/imagens/logo_fundo_removido.png" alt="Logo EventFlow" title="Página Inicial" width="300"></a>
            </div>
            <div class="nome_usuario">
                <h2>Selecione o Tipo de Usuário</h2>
                <hr>
            </div>

            <div class="control_usuario">

                <?php
                echo '<a href="cadastro_pessoal.php"><h1>Cadastro Pessoal</h1></a>';
                echo '<a href="cadastro_empresarial.php"><h1>Cadastro Empresarial</h1></a><br>';
                ?>

            </div>

            <div class="voltar_usuario">
                <?php
                echo '<a href="login.php"><h2>voltar</h2></a>';
                ?>
            </div>
        </center>
    </div>

</body>

</html>