<?php
	require("configuration.php");

	function abrirConexao(){
		$conexao = $mysqli_connect(SERVIDOR, USUARIO, SENHA, BANCO) or die (mysqli_connect_error());
		mysqli_set_charset($conexao, CHARSET) or die (mysqli_error($conexao));

		return $conexao;
	}
?>