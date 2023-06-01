<?php

session_start();

include('conexao.php');

$idusuario = $_SESSION['idusuario'];

$email = isset($_POST['email']) ? $_POST['email'] : '';
$senha = isset($_POST['nova_senha']) ? $_POST['nova_senha'] : '';

$update = "UPDATE login SET senha = '$senha' WHERE idusuario = '$idusuario'";
$resultado = mysqli_query($conexao, $query);

if (mysqli_num_rows($resultado) == 1) {
    $row = mysqli_fetch_assoc($resultado);
    $tipo_user = $row['tipo_user'];

    // Verificar o tipo de usuário e redirecionar para a página correta
    if ($tipo_user == 1 && $email == '') {
        // Atualizar a senha no banco de dados
        $update = "UPDATE login SET senha = '$senha' WHERE idusuario = '$idusuario'";
        $query = mysqli_query($conexao, $update);

        if ($query) {
            header("Location: login.php");
            exit();
        } else {
            echo "Ocorreu um erro ao atualizar a senha. Por favor, tente novamente.";
        }
    } elseif ($tipo_user == 2 && $email == '') {
        // Atualizar a senha no banco de dados
        $update = "UPDATE login SET senha = '$senha' WHERE idusuario = '$idusuario'";
        $query = mysqli_query($conexao, $update);

        if ($query) {
            header("Location: login.php");
            exit();
        } else {
            echo "Ocorreu um erro ao atualizar a senha. Por favor, tente novamente.";
        }
    }
} else {
    // Caso o login seja inválido, redirecionar para a página de login novamente com uma mensagem de erro
    $_SESSION['login_erro'] = "Email ou senha inválidos";
    header("Location: login.php");
    exit();
}

?>