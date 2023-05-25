<?php
include 'conexao.php';

session_start();
if (!isset($_SESSION['idusuario'])) {
    header('Location: login.php');
    exit();
}

$idUsuario = $_SESSION['idusuario'];

$query = "SELECT u.nome, u.cpf_cnpj, u.telefone, l.email, tu.id_funcao, u.empresa FROM usuario u
          INNER JOIN tipo_usuario tu ON u.tipo_user = tu.id_funcao
          INNER JOIN login l ON u.idusuario = l.idusuario
          WHERE u.idusuario = ?";
$stmt = $conexao->prepare($query);
$stmt->bind_param('i', $idUsuario);
$stmt->execute();
$resultado = $stmt->get_result();
$dadosUsuario = $resultado->fetch_assoc();

if (!$dadosUsuario) {
    header('Location: login.php');
    exit();
}

$nomeUsuario = $dadosUsuario['nome'];
$tipoUsuario = $dadosUsuario['id_funcao'];
$cpfCnpjUsuario = $dadosUsuario['cpf_cnpj'];
$telefoneUsuario = $dadosUsuario['telefone'];
$emailUsuario = $dadosUsuario['email'];
$empresaUsuario = $dadosUsuario['empresa'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Perfil</title>
    <link rel="stylesheet" href="assets/css/style2.css">
</head>
<body>
    <div class="container_perfil">
        <div class="cabecalho">

        <div class="logo_perfil">
            <img src="assets/imagens/logo_fundo_removido.png" alt="Logo EventFlow">
        </div>
            
            <nav class="botoes_perfil">
            <?php if ($tipoUsuario == 1) { ?>
                    <a href="eventos.php"><label>Eventos</label></a>
                    <a href="meus_eventos.php"><label>Meus Eventos</label></a>
                    <a href="carrinho.php"><label>Carrinho</label></a>
                    <a href="login.php"><label>Logout</label></a>
                <?php } elseif ($tipoUsuario == 2) { ?>
                    <a href="eventos.php"><label>Eventos</label></a>
                    <a href="eventos_criados.php"><label>Eventos Criados</label></a>
                    <a href="criar_eventos.php"><label>Criar Evento</label></a>
                    <a href="login.php"><label>Logout</label></a>
                <?php } ?>
            </nav>
        </div>

        <center>
        <div class="container_perfil_2">
            <div class="informacoes_perfil">
                <h2 class="nome_informações_do_perfil">Informações do Perfil</h2>
            
                <div class="nome_perfil">
                    <label>Nome:</label>
                    <span><?php echo $nomeUsuario; ?></span>
                </div>

                <div class="cnpj_cpf_perfil">
                    <label>
                        <?php
                        if ($tipoUsuario == 1) {
                            echo "CPF:";
                        } elseif ($tipoUsuario == 2) {
                            echo "CNPJ:";
                        }
                        ?>
                    </label>
                    <span><?php echo $cpfCnpjUsuario; ?></span>
                </div>

                <div class="telefone_perfil">
                    <label>Telefone:</label>
                    <span><?php echo $telefoneUsuario; ?></span>
                </div>

                <div class="email_perfil">
                    <label>Email:</label>
                    <span><?php echo $emailUsuario; ?></span>
                </div>
                
                <?php if ($tipoUsuario == 2) { ?>
                <div class="empresa_perfil">
                    <label>Empresa:</label>
                    <span><?php echo $empresaUsuario; ?></span>
                </div>
                <?php } ?>
                
                <div class="editar_informações">
                    <a href="editar_perfil.php">Editar Informações</a>
                </div>

            </div>
        </div>
        
    </div>            
        </center>
        
</body>
</html>