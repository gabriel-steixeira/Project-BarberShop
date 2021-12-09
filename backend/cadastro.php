<?php
include_once "conectar.php";

try {
    $nome = filter_var($_POST['nome']);
    $sobrenome = filter_var($_POST['sobrenome']);
    $email = filter_var($_POST['email']);
    $telefone = filter_var($_POST['telefone']);
    $senha = filter_var($_POST['senha']);

    $verificar = $conectar->prepare("SELECT email from cliente where email = :email");
    $verificar->bindParam(':email', $email);
    $verificar->execute();
    $linha = $verificar->rowCount();
    if ($linha > 0) {
        echo "<script>alert('Já existe uma conta com esse email, por favor utilize um email diferente!')
        location.href=' ../frontend/cadastro.html'</script>";
    } else {
        $insert = $conectar->prepare("INSERT INTO cliente (nome, sobrenome, email, telefone, senha) VALUES (:nome, :sobrenome, :email, :telefone, :senha)");
        $insert->bindParam(':nome', $nome);
        $insert->bindParam(':sobrenome', $sobrenome);
        $insert->bindParam(':email', $email);
        $insert->bindParam(':telefone', $telefone);
        $insert->bindParam(':senha', $senha);
        $insert->execute();
        $linha = $insert->rowCount();
        echo "<script>alert('Cadastro realizado com sucesso!')
        location.href=' ../frontend/areaCliente.html'</script>";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
