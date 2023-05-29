<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/css/style.css">
    
</head>
<body>
    
    <div class="container_senha">
            <div class="voltar_senha">
                <?php
                    echo '<a href="login.php"><img src="assets/imagens/seta-voltar.png"></a>';
                ?>
            </div>
        <center>
            <div class="logo_senha">
                <img src="assets/imagens/logo_fundo_removido.png" alt="Logo EventFlow">
            </div>
            <div class="nome_senha">
                <h2>Redefinir Senha</h2>
            </div>
        </center>
            
        <form class="form_senha" id="form" action="autenticar.php" method="POST">

            <div class="form_control_senha">

                <input type="email" id="email" placeholder="Email" name="email" required>
                <i class="img-success" ><img src="assets/imagens/success-icon.svg" alt=""></i>
                <i class="img-error" ><img src="assets/imagens/error-icon.svg" alt=""></i>

                <small>Error Message</small>

            </div>

            <div class="form_control_senha">

                <input type="password" id="password" placeholder="Nova Senha" name="nova_senha" required>
                <i class="img-success" ><img src="assets/imagens/success-icon.svg" alt=""></i>
                <i class="img-error" ><img src="assets/imagens/error-icon.svg" alt=""></i>

                <small>Error Message</small>

            </div>

            <button type="submit">Concluir</button>
            
        </form>
        
    </div>

    <script src="assets/js/index.js"></script>
    
</body>
</html>