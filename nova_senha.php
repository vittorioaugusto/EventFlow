<?php

session_start();

include('conexao.php');
include('valida_usuario.php');

$id_usuario = $_SESSION['id_usuario'];

$senha = isset($_POST['nova_senha']) ? $_POST['nova_senha'] : '';

$update = "UPDATE login SET senha = '$senha' WHERE id_usuario= 'id_usuario'";
$query = mysqli_query($conexao, $update);

header('Location: principal.php');

?>