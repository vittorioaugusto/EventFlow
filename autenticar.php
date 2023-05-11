<?php

include('conexao.php');
include('valida_usuario.php');

$email = isset($_POST['email']) ? $_POST['email'] : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';

$select = "SELECT email, senha FROM email
			WHERE email = '$email' AND senha = '$senha'";
/*
POSTGRES
$query = pg_exec($conexao, $select);
$dado = pg_fetch_row($query);
*/
$query = mysqli_query($conexao, $select);
$dado = mysqli_fetch_row($query);

if ($email == isset($dado[1]) && $senha == isset($dado[2])) {
	session_start();
	$_SESSION['email'] = $dado[0];
	header ("location: menu.php");
}
else {
	header ("location: login.php");
}

?>