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
    <div id="principal-servicos">
        <h1>Editar agendamentos</h1>
        <?php 
            include("../backend/conectar.php");
            $nome = $_COOKIE['nome'];
            $id_cliente = $_COOKIE['id_cliente'];
        try {
            $servicos = "SELECT * FROM servicos";
            $query = $conectar->prepare($servicos);
            $query->bindParam(':nome', $nome, PDO::PARAM_STR);
            $query->execute();
            $contagem = $query->rowCount();
            if ($contagem > 0) {
                echo "<p>Servicos disponíveis para agendamento: </p><br><section>";
                echo "<table class='tabelas' border='1px'><tr><td>Nome do serviço</td><td>Preço</td></tr>";
                while ($linha = $query->fetch()) {
                    print_r("<tr><td>$linha[nome_servico]</td><td>$linha[preco]</td></tr>");
                }
                echo "</table><br>";
            } else {
                echo "Não foram encontrados serviços disponíveis.<br><br>";
            }
        } 
        catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
        }
        ?>
        <form action="../backend/editarAgendamento.php" method="post">
            Serviço: <select name="nome_servico" required > 
                <?php 
                $servico = $conectar->prepare("SELECT * FROM servico");  
                $query->execute();
                $contagem = $query->rowCount();
                if($contagem > 0){ 
                    foreach ($query as $ser) { 
                ?> 
                    <option value="<?php echo $ser['nome_servico'];
                    ?>" ><?php echo $ser['nome_servico'];?></option> 
                <?php } 
                } ?> </select><br><br>
            Data agendada: <input type="date" name="data_agendamento" required /><br><br>
            Hora agendada (aberto das 10:00 às 14:00): <input id="input-horario" type="time" name="hora_agendamento" min="10:00" max="14:00" required /><span class="validacao"></span><br><br>
            <input type="submit" value="Realizar agendamento" name="submit" />
        </form>
        </section>
        <br><br>
        <a class="back-button" href="../frontend/visualizarAgendamentos.php">Voltar</a>
    </div>
    <footer>
        <img id="logo-footer" src="../src/img/logo.png">
        <p id="copyright">&copy; Copyright CGT Barbearia - 2021</p>
    </footer>
</body>

</html>

           
