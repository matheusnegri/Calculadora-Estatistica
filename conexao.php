<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "estatistica";

	// Conexão do banco
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Verificando Conexão
	if ($conn->connect_error) {
		die("Conexão com o banco falhou: " . $conn->connect_error);
	} 
?>