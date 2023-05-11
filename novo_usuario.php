<?php

session_start();

include('conexao.php');
include('valida_usuario.php');

$id_usuario = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';

$insert = "INSERT INTO login (id_usuario, login, senha)
			VALUES ('$id_usuario', '$email', '$senha')";
$query = mysqli_query($conexao, $insert);

header('Location: principal.php');

?>