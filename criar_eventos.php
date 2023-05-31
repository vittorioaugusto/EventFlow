<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Evento</title>
    <link rel="stylesheet" href="assets/css/style2.css">
</head>
<body>
    <div class="cabecalho_criar_eventos">

        <div class="logo_criar_eventos">
            <img src="assets/imagens/logo_fundo_removido.png" alt="Logo EventFlow">
        </div>

        <nav class="botoes_criar_evento">
            <a href="eventos.php">Eventos</a>
            <a href="eventos_criados.php">Eventos Criados</a>
            <a href="perfil.php">Perfil</a>
            <a href="login.php">Logout</a>
        </nav>
        
        
        <div class="cabecalho_criar_eventos_2">
            <div class="caixa_criar_eventos">
            <center>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="informacoes_criar_eventos">
                    <h1 id="nome_criar_evento">Criar Evento</h1>
                        <label for="nome_evento">Nome do Evento:</label>
                        <input type="text" id="nome_evento" name="nome_evento" required><br><br>

                        <label for="endereco">Endereço:</label>
                        <input type="text" id="endereco" name="endereco" required><br><br>

                        <label for="descricao">Descrição:</label>
                        <textarea id="descricao" name="descricao" required></textarea><br><br>

                        <label for="data_inicio_evento">Data de Início do Evento:</label>
                        <input type="date" id="data_inicio_evento" name="data_inicio_evento" required><br><br>

                        <label for="data_final_evento">Data de Término do Evento:</label>
                        <input type="date" id="data_final_evento" name="data_final_evento" required><br><br>

                        <label for="horario_inicial">Horário de Início do Evento:</label>
                        <input type="time" id="horario_inicial" name="horario_inicial" required><br><br>

                        <label for="horario_final">Horário de Término do Evento:</label>
                        <input type="time" id="horario_final" name="horario_final" required><br><br>

                        <label for="quantidade_ingressos">Quantidade de Ingressos Disponíveis:</label>
                        <input type="number" id="quantidade_ingressos" name="quantidade_ingressos" required><br><br>

                        <label for="preco_inteira">Preço da Entrada Inteira:</label>
                        <input type="number" id="preco_inteira" name="preco_inteira" step="0.01" required><br><br>
                    </div>
                    
                    <div class="botao_criar_evento">
                        <button type="submit">Criar Evento</button>
                    </div>
                </form>
            
            </div>
        </div>
        </center>
    </div>
</body>
</html>