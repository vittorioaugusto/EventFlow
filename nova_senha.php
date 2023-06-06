<?php

session_start();

include('conexao.php');

$idusuario = $_SESSION['idusuario'];

$email = isset($_POST['email']) ? $_POST['email'] : '';
$senha = isset($_POST['nova_senha']) ? $_POST['nova_senha'] : '';

$update = "UPDATE login SET senha = '$senha' WHERE idusuario = '$idusuario'";
$query = mysqli_query($conexao, $update);

header('Location: login.php');

?>

<?php
include('conexao.php');

$idusuario = $_SESSION['idusuario'];

$email = isset($_POST['email']) ? $_POST['email'] : '';
$senha = isset($_POST['nova_senha']) ? $_POST['nova_senha'] : '';

$resultado_verificar_usuario = mysqli_query($conexao, $query);

    if (mysqli_num_rows($resultado_verificar_usuario) > 0) { 
        $update = "UPDATE login SET senha = '$senha' WHERE idusuario = '$idusuario'";
        $query = mysqli_query($conexao, $update);

        if(!$query){
            die("Erro na consulta: " . mysqli_error($conexao));
        }else{
            header("location: login.php");
        }
    } else {
        echo "<script>window.alert('Email e ou senhas inválidos')</script>";
        echo "<script>window.location.href='confirmar_dados.php'</script>";
    }

?>