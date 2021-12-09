<?php
include_once "conectar.php";
try {
	$nome = $_COOKIE['nome'];
	$nome_servico = filter_var($_POST['nome_servico']);
	$data_agendamento = filter_var($_POST['data_agendamento']);
	$hora_agendamento = filter_var($_POST['hora_agendamento']);

	$update = "UPDATE agendamento SET nome_servico=:nome_servico, data_agendamento=:data_agendamento, hora_agendamento=:hora_agendamento where nome=:nome";
	$query = $conectar->prepare($update);
	$query->bindParam(':nome', $nome);
	$query->bindParam(':nome_servico', $nome_servico);
	$query->bindParam(':data_agendamento', $data_agendamento);
	$query->bindParam(':hora_agendamento', $hora_agendamento);
	$query->execute();
	$linha = $query->rowCount();
	if (!$linha > 0) {
		echo "<script>alert('Erro ao editar, tente novamente!');
		location.href=' ../frontend/editarAgendamento.php.html'</script>";
	} else {
		echo "<script>alert('Editado com sucesso!');
		location.href=' ../frontend/visualizarAgendamentos.php'</script>";
	}
} catch (PDOException $e) {
	echo "Erro: " . $e->getMessage();
}
