<?php
include_once "conectar.php";
try {
	$nome = $_COOKIE['nome'];
	$nome_servico = $_POST['nome_servico'];
	$data_agendamento = $_POST['data_agendamento'];
	$hora_agendamento = $_POST['hora_agendamento'];

	$verificar = $conectar->prepare("SELECT data_agendamento, hora_agendamento from agendamento where data_agendamento = :data_agendamento and hora_agendamento = :hora_agendamento");
    $verificar->bindParam(':data_agendamento', $data_agendamento);
    $verificar->bindParam(':hora_agendamento', $hora_agendamento);
    $verificar->execute();
    $linha = $verificar->rowCount();
    if ($linha > 0) {
        echo "<script>alert('Já existe um agendamento nesse horário, por favor escolha outro horário.')
			location.href='../frontend/visualizarServicos.php';</script>";
    } else {
		$insert = $conectar->prepare("INSERT INTO agendamento (nome, nome_servico, data_agendamento, hora_agendamento) VALUES (:nome, :nome_servico, :data_agendamento, :hora_agendamento)"); //ver as colunas
		$insert->bindParam(':nome', $nome);
		$insert->bindParam(':nome_servico', $nome_servico);
		$insert->bindParam(':data_agendamento', $data_agendamento);
		$insert->bindParam(':hora_agendamento', $hora_agendamento);
		$insert->execute();
		$linha = $insert->rowCount();
		if (!$linha > 0) {
			echo "<script>alert('Erro ao realizar o agendamento, favor tentar novamente!');
				location.href='../frontend/visualizarServicos.php';</script>";
		} else {
			echo "<script>alert('Agendamento realizado com sucesso!');
				location.href='../frontend/visualizarAgendamentos.php';</script>";
		}
	}
} catch (PDOException $e) {
	echo "Erro: " . $e->getMessage();
}
