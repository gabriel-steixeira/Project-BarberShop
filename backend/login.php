<?php

    include("conectar.php"); //verificar nome do arquivo

    $nome = filter_var($_POST['nome']);   //verificar a variavel la no login.html
    $email = filter_var($_POST['email']);   
    $senha = filter_var($_POST['senha']);
    setcookie('nome', $nome, time()+3600, "/");

    try {
        $select = $conectar->prepare("SELECT * FROM cliente WHERE nome=:nome and email=:email and senha=:senha");
        $select->bindParam(':nome', $nome);
        $select->bindParam(':email', $email);
        $select->bindParam(':senha', $senha);
		$select->execute();	
        $linha = $select->fetch();
        $id_cliente = $linha['id_cliente'];
        setcookie('id_cliente', $id_cliente, time()+3600, "/");
		$contagem = $select->rowCount();
		if(!$contagem > 0){
			echo "<script>alert('Email ou senha incorretos, tente novamente!')
            location.href=' ../frontend/areaCliente.html'</script>";
		}
		else{
			echo "<script>alert('Login realizado com sucesso!')
            location.href=' ../frontend/visualizarAgendamentos.php'</script>";
		}
    } 
    catch(PDOException $e) {
		echo "Erro: " . $e->getMessage();
	}

    
    //ideia: fazer uma sessao para o nick do usuario e chamar na outra pag
?>