<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <form class="form_login" action="autenticar.php" method="POST">

        <div class="logo_login">
            <img src="imagens/logo_fundo_removido.png" alt="Logo EventFlow">
        </div>
        <div class="login">
            <input type="text" placeholder="Email" name="email" required><br>
            <input type="password" placeholder="Senha" name="senha" required><br>
        </div>
        <div class="entrar_login">
            <button type="submit" name="enviar" value="Entrar"><h1>Entrar</h1></button><br>
        </div>
        <div class="senha_e_conta">
            <a href="esqueci_senha.html"><h2>Esqueci a senha</h2></a>
            <a href="tipo_de_usuario.html"><h2>Criar Conta</h2></a>
        </div>
        
    </form>
</body>
</html>