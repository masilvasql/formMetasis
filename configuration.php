<?php
	define('SERVIDOR','localhost');
	define('USUARIO','root');
	define('SENHA','');
	define('BANCO','clientes');
	define('CHARSET','utf8');

	$conexao = mysqli_connect(SERVIDOR, USUARIO, SENHA, BANCO) or die (mysqli_connect_error());
	mysql_query("SET NAMES 'utf8'");
	mysql_query('SET character_set_connection=utf8');
	mysql_query('SET character_set_client=utf8');
	mysql_query('SET character_set_results=utf8');
	mysqli_set_charset($conexao, CHARSET) or die (mysqli_error($conexao));
?>






