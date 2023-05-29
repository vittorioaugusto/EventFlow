<!-- <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/css/style.css">
    
</head>
<body>
    <center>
        <form class="form_login" action="autenticar.php" method="POST">

            <div class="logo_login">
                <img src="assets/imagens/logo_fundo_removido.png" alt="Logo EventFlow">
            </div>
            <div class="login">
                <input type="email" placeholder="Email" name="email" required><br>
                <input type="password" placeholder="Senha" name="senha" required><br>
            </div>
            <div class="entrar_login">
                <button type="submit" name="enviar" value="Entrar"><h1>Entrar</h1></button><br>
            </div>
            <div class="senha_e_conta">
                
            </div>
            
        </form>
    </center>
    
    
</body>
</html> -->

<?php
session_start();
?>

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
    
    <div class="container_login">
        <center>
            <div class="logo_login">
                <img src="assets/imagens/logo_fundo_removido.png" alt="Logo EventFlow">
            </div>
            <div class="nome_login">
                <h2>Login</h2>
            </div>
        </center>
            
        <form class="form_login" id="form" action="autenticar.php" method="POST">

            <div class="form-control">

                <input type="email" id="email" placeholder="Email" name="email" required>
                <i class="img-success" ><img src="assets/imagens/success-icon.svg" alt=""></i>
                <i class="img-error" ><img src="assets/imagens/error-icon.svg" alt=""></i>

                <small>Error Message</small>

            </div>

            <div class="form-control">

                <input type="password"  id="password" placeholder="Senha" name="senha" required>
                <i class="img-success" ><img src="assets/imagens/success-icon.svg" alt=""></i>
                <i class="img-error" ><img src="assets/imagens/error-icon.svg" alt=""></i>

                <small>Error Message</small>

            </div>

            <button type="submit">Entrar</button>
            <div class="form-control">
                <?php
                    if (isset($_SESSION['login_erro'])) {
                        echo '<p class="erro">' . $_SESSION['login_erro'] . '</p>';
                        unset($_SESSION['login_erro']);
                    }
                    echo '<a href="esqueci_senha.php"><h2>Esqueci a senha</h2></a>';
                    echo '<a href="tipo_de_usuario.php"><h2>Criar Conta</h2></a>';
                ?>
            </div>
        </form>
        
    </div>

    <script src="assets/js/index.js"></script>
    
</body>
</html>