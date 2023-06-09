<?php
require_once "conexao.php";

session_start();

// Verifica se o usuário está logado e tem permissão de cadastro empresarial
if (!isUsuarioLogado() || !isCadastroEmpresarial()) {
    redirecionarParaLogin();
}

$errors = [];
$successMessage = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"]);
    $descricao = trim($_POST["descricao"]);
    $quantidade = intval($_POST["quantidade"]);
    $valor = floatval($_POST["valor"]);
    $idevento = intval($_POST["idevento"]);

    validarCamposFormulario($nome, $descricao, $quantidade, $valor, $idevento, $errors);

    if (empty($errors)) {
        // Verifica se o usuário logado é o criador do evento
        $idusuario = $_SESSION["idusuario"];
        if (isCriadorEvento($idusuario, $idevento, $conexao)) {
            cadastrarProduto($nome, $descricao, $quantidade, $valor, $idevento, $conexao, $successMessage, $errors);
        } else {
            $errors[] = "Você não tem permissão para cadastrar produtos para este evento.";
        }
    }
}

$eventos = obterListaEventos($conexao);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Produtos</title>
</head>
<body>
    <h1>Cadastro de Produtos</h1>

    <?php if (!empty($errors)) : ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($successMessage !== '') : ?>
        <div style="color: green;"><?php echo $successMessage; ?></div>
    <?php endif; ?>

    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="nome">Nome do Produto:</label><br>
        <input type="text" id="nome" name="nome" required><br>

        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao" required></textarea><br>

        <label for="quantidade">Quantidade:</label><br>
        <input type="number" id="quantidade" name="quantidade" required><br>

        <label for="valor">Valor:</label><br>
        <input type="text" id="valor" name="valor" required><br>

        <label for="idevento">Evento:</label><br>
        <select id="idevento" name="idevento" required>
            <option value="">Selecione um evento</option>
            <?php foreach ($eventos as $evento) : ?>
                <option value="<?php echo $evento["idevento"]; ?>"><?php echo $evento["nome_evento"]; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <input type="submit" value="Cadastrar Produto">
        <a href="info_produto.php"><label>Alterar Produtos</label></a>

    </form>
</body>
</html>

<?php

function isUsuarioLogado() {
    return isset($_SESSION["idusuario"]);
}

function isCadastroEmpresarial() {
    return $_SESSION["tipo_user"] == 2;
}

function redirecionarParaLogin() {
    header("Location: login.php");
    exit;
}

function isCriadorEvento($idusuario, $idevento, $conexao) {
    $sql = "SELECT COUNT(*) FROM eventos WHERE idevento = ? AND idusuario = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $idevento, $idusuario);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    return $count > 0;
}


function validarCamposFormulario($nome, $descricao, $quantidade, $valor, $idevento, &$errors) {
    if (empty($nome)) {
        $errors[] = "O campo 'Nome do Produto' é obrigatório.";
    }
    if (empty($descricao)) {
        $errors[] = "O campo 'Descrição' é obrigatório.";
    }
    if ($quantidade <= 0) {
        $errors[] = "A quantidade do produto deve ser um valor positivo.";
    }
    if ($valor <= 0) {
        $errors[] = "O valor do produto deve ser um valor positivo.";
    }
    if ($idevento <= 0) {
        $errors[] = "Selecione um evento válido.";
    }
}

function cadastrarProduto($nome, $descricao, $quantidade, $valor, $idevento, $conexao, &$successMessage, &$errors) {
    $sql = "INSERT INTO iten_loja (nome, descricao, quantidade, valor, idevento) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, "ssidi", $nome, $descricao, $quantidade, $valor, $idevento);

    if (mysqli_stmt_execute($stmt)) {
        $successMessage = "Produto cadastrado com sucesso!";
    } else {
        $errors[] = "Erro ao cadastrar produto: " . mysqli_error($conexao);
    }

    mysqli_stmt_close($stmt);
}

function obterListaEventos($conexao) {
    $sqlEventos = "SELECT idevento, nome_evento FROM eventos";
    $resultEventos = mysqli_query($conexao, $sqlEventos);
    return mysqli_fetch_all($resultEventos, MYSQLI_ASSOC);
}
?>