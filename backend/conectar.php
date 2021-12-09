<?php
	try {
		$conectar = new PDO("mysql:host=localhost;port=3306;dbname=bd_barberShopCGT;", "root", "");
		
	} catch (PDOException $e) {
		echo "Falha na conexão com o banco de dados: " . $e->getMessage();
		
	}
?>