<?php

include('conexao.php');
include('valida_usuario.php');

$email = isset($_POST['email']) ? $_POST['email'] : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';

$select = "SELECT * FROM login WHERE email = '$email' AND senha = '$senha'";

/*
POSTGRES
$query = pg_exec($conexao, $select);login
$dado = pg_fetch_row($query);
*/
$query = mysqli_query($conexao, $select);
$dado = mysqli_fetch_row($query);

if ($email == isset($dado[1]) && $senha == isset($dado[2])) {
	session_start();
	$_SESSION['id_usuario'] = $dado[0];
	header ("location: principal.php");
}
else {
	header ("location: index.php");
}

?>