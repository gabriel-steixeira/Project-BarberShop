<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../src/css/reset.css">
    <link rel="stylesheet" href="../src/css/style.css">
    <link rel="stylesheet" href="https://use.typekit.net/dlb0xbo.css">
    <link rel="shortcut icon" type="image/png" href="../src/img/icon-pag.ico">
    <title>CGT - Agendamentos</title>
</head>

<body>
    <div id="image-initial">
        <header>
            <div class="caixa">
                <h1><img id="logo" src="../src/img/logo-branco.png"></h1>

                <nav>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="areaCliente.html">Área do cliente</a></li>
                        <li><a href="contato.html">Contato</a></li>
                    </ul>
                </nav>
            </div>
        </header>
    </div>
    <div id="principal-agendamentos">
        <h1>Agendamentos</h1>
        <?php 
            include("../backend/conectar.php");
            $nome = $_COOKIE['nome'];
            $id_cliente = $_COOKIE['id_cliente'];
        ?>
        <h2>Seja bem-vindo <?php echo "${nome}"; ?>!</h2>
        <?php
        try {
                $agendamentos = "SELECT * FROM cliente INNER JOIN agendamento ON cliente.nome = agendamento.nome WHERE id_cliente=:id_cliente";
                $query = $conectar->prepare($agendamentos);
                $query->bindParam(':id_cliente', $id_cliente);
                $query->execute();
                $contagem = $query->rowCount();
                if($contagem > 0){
                    echo "Seus agendamentos: <br><br>";
                    echo "<table class='tabelas' border='1px'><tr><td>Serviço</td><td>Data agendada</td><td>Hora agendada</td></tr>";
                    while($linha = $query->fetch()) {
                        print_r("<tr><td>$linha[nome_servico]</td><td>$linha[data_agendamento]</td><td>$linha[hora_agendamento]</td><td><a href='../frontend/editarAgendamento.php'>Editar</a></td><td><a href='../backend/excluirAgendamento.php' onclick='return confirm('Tem certeza que deseja deletar este agendamento?')'>Excluir</a></td></tr>");   
                        
                    }
                    echo "</table><br>";
                    echo "<br>" . $contagem . " Agendamentos<br><br>";
                }
                else{
                    echo "Não foram encontrados registros de agendamentos.<br><br>";
                } 
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
        ?>
        <br>
        <a class="links-button" href="../frontend/visualizarServicos.php">Realizar agendamentos</a>
        <a class="links-button" href="../frontend/areaCliente.html">Sair</a>
    </div>
    <footer>
        <img id="logo-footer" src="../src/img/logo.png">
        <p id="copyright">&copy; Copyright CGT Barbearia - 2021</p>
    </footer>
</body>

</html>