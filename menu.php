<?php 

session_start();

include('conexao.php');
include('valida_usuario.php');

$id_usuario = $_SESSION['id_usuario'];

$select =  "SELECT email FROM senha WHERE id_usuario = '$id_usuario'";

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

    <h1>Menu principal <?php echo $dado[0]; ?>!</h1>

    <nav>
    <button>Eventos</button><br>
    </nav>
</body>
</html>