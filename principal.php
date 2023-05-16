<?php 

session_start();

include('conexao.php');
include('valida_usuario.php');

$id_usuario = $_SESSION['id_usuario'];

$select =  "SELECT email FROM senha WHERE tipo_usuario IN ('comum', 'empresarial')";

$query = mysqli_query($conexao, $select);
$dado = mysqli_fetch_row($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    
</head>
<body>

    <div>
        <img src="imagens/logo_fundo_removido.png" alt="Logo EventFlow">
    </div>

    <nav>
        <label>Pesquisar</label> <input type="search">
        <label>Eventos</label>        
    </nav>
</body>
</html>