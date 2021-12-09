<?php
include_once "conectar.php";
try {
	$nome = $_COOKIE['nome'];

	$delete = "DELETE FROM agendamento where nome=:nome";
	$query = $conectar->prepare($delete);
	$query->bindParam(':nome', $nome);
	$query->execute();
	$linha = $query->rowCount();
	if ($linha > 0) {
		echo "<script>alert('Agendamento excluído com sucesso!');
		location.href='../frontend/visualizarAgendamentos.php';</script>";
	} else {
		echo "<script>alert('Falha ao excluir agendamento, tente novamente!');
		location.href='../frontend/visualizarAgendamentos.php';</script>";
	}
} catch (PDOException $e) {
	echo "Erro: " . $e->getMessage();
}
