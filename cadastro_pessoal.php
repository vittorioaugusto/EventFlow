<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Pessoal</title>
    <link rel="stylesheet" href="assets/css/style.css">
    
</head>
<body>
    
    <div class="container_pessoal">
        <div class="voltar_pessoal">
            <?php
            echo '<a href="login.php"><img src="assets/imagens/seta-voltar.png"></a>';
            ?>
        </div>
        <center>

            <div class="nome_pessoal">
                <h2>Usuário pessoal</h2>
            </div>
        
        <form class="form_pessoal" id="form" action="autenticar.php" method="POST">

            <div class="form_control_pessoal">

                <input type="text" placeholder="Nome" name="nome" required><br>
                <input type="number" placeholder="Telefone" name="telefone" required><br>
                <input type="number" placeholder="CPF" name="cpf_cnpj" required><br>
                <input type="email" placeholder="Email" name="email" required><br>
                <input type="password" placeholder="Senha" name="senha" required><br>
                <input type="hidden" name="tipo_user" value="1">
                
            </div>

            <button type="submit" name="enviar" value="Entrar">Concluir</button>
        </form>
        </center>
    </div>
  
</body>
</html>