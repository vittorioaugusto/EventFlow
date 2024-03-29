<?php
include('../SQL/conexao.php');

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
    <link rel="stylesheet" href="../assets/css/style2.css">
</head>

<body>
    <div class="container_perfil">
        <div class="cabecalho">

            <div class="logo_perfil">
                <a href="../eventos/eventos.php"><img src="../assets/imagens/logo_fundo_removido.png" alt="Logo EventFlow" title="Início" width="200"></a>
            </div>

            <nav class="botoes_perfil">
                <?php if ($tipoUsuario == 1) { ?>
                    <a href="eventos.php"><label>Eventos</label></a>
                    <a href="eventos_criados.php"><label>Meus Ingressos</label></a>
                    <a href="../carrinho/carrinho.php">
                        <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/slkvcfos.json" trigger="hover" colors="primary:white,secondary:white" style="width:65px;height:65px;top:5px;">
                        </lord-icon>
                    </a>
                    <a href="EventFlow.php">
                        <button class="Btn">
                            <div class="sign"><svg viewBox="0 0 512 512">
                                    <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                                </svg></div>
                            <div class="text">Logout</div>
                        </button>
                    </a>
                <?php } elseif ($tipoUsuario == 2) { ?>
                    <a href="eventos.php"><label>Eventos</label></a>
                    <a href="eventos_criados.php"><label>Eventos Criados</label></a>
                    <a href="criar_eventos.php"><label>Criar Evento</label></a>
                    <a href="../carrinho/carrinho.php">
                        <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                        <lord-icon src="https://cdn.lordicon.com/slkvcfos.json" trigger="hover" colors="primary:white,secondary:white" style="width:65px;height:65px;top:5px;">
                        </lord-icon>
                    </a>
                    <a href="../EventFlow.php"><button class="Btn">
                            <div class="sign"><svg viewBox="0 0 512 512">
                                    <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                                </svg></div>
                            <div class="text">Logout</div>
                        </button></a>
                <?php } ?>
            </nav>

            <center>
                <div class="container_perfil_2">
                    <div class="informacoes_perfil">
                        <h2 id="nome_informacoes_do_perfil">Informações do Perfil</h2>
                        <hr>

                        <div class="dados_perfil">
                            <label>Nome: </label>
                            <span><?php echo $nomeUsuario; ?></span><br>
                            <label>
                                <?php
                                if ($tipoUsuario == 1) {
                                    echo "CPF:";
                                } elseif ($tipoUsuario == 2) {
                                    echo "CNPJ:";
                                }
                                ?>
                            </label>
                            <span><?php echo $cpfCnpjUsuario; ?></span><br>

                            <label>Telefone: </label>
                            <span><?php echo $telefoneUsuario; ?></span><br>

                            <label>Email: </label>
                            <span><?php echo $emailUsuario; ?></span><br>

                            <?php if ($tipoUsuario == 2) { ?>
                                <label>Empresa: </label>
                                <span><?php echo $empresaUsuario; ?></span>
                            <?php } ?>

                            <div class="editar_informações">
                                <a href="editar_perfil.php">Editar Informações</a>
                                <a href="historico.php">Histórico</a><br>
                            </div>

                        </div>
                    </div>
                </div>

        </div>
        </center>

</body>

</html>