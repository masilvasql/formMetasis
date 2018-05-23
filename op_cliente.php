<?php
	header('Content-Type: text/html; charset=utf-8');
	require("configuration.php");	
	 if($_POST["save"]){
		$codCli     = $_POST["idCliente"];
		$nomeClie = utf8_decode($_POST["nome"]);
		$telClie= $_POST["telefone"];
		$dataNasc   = $_POST["dataNasc"];
		$rendaClie   =  $_POST["renda"];
		$tipoPessoa =  utf8_decode($_POST["tipoPessoa"]);
		$emailCli = $_POST["email"];
		$cpfCli =  $_POST["cpf"];
		$enderecoCli = utf8_decode($_POST["endereco"]);
		$sexoCli =  $_POST["sexo"];
		$statusCli =  $_POST["status"];

		$number = str_replace(',','.',str_replace('.','',$rendaClie));

		$link = mysqli_connect("localhost", "root", "", "clientes");

		$sql = "INSERT INTO clientes (codigoCliente, nomeCliente, telCliente, dataNasCliente, rendaCliente, tipoCliente, emailCliente, cpfCliente, enderecoCliente, sexoCliente, statusCliente) VALUES ('$codCli', '$nomeClie', '$telClie', '$dataNasc', '$number','$tipoPessoa', '$emailCli', '$cpfCli', '$enderecoCli', '$sexoCli', '$statusCli')";
		mysqli_query($link, $sql);		
	}else{
		if($_POST["delete"]){
			$link = mysqli_connect("localhost", "root", "", "clientes");
			$codCli = $_POST["codCli"];
			$sql = "DELETE FROM clientes WHERE codigoCliente = " . $codCli;
			mysqli_query($link, $sql);
		}else{
			if($_POST["update"]){
				$codCli     = $_POST["idCliente"];
				$nomeClie = utf8_decode($_POST["nome"]);
				$telClie= $_POST["telefone"];
				$dataNasc   = $_POST["dataNasc"];
				$rendaClie   =  $_POST["renda"];
				$tipoPessoa =  utf8_decode($_POST["tipoPessoa"]);
				$emailCli = $_POST["email"];
				$cpfCli =  $_POST["cpf"];
				$enderecoCli = utf8_decode($_POST["endereco"]);
				$sexoCli =  $_POST["sexo"];
				$statusCli =  $_POST["status"];

				$number = str_replace(',','.',str_replace('.','',$rendaClie));

				$link = mysqli_connect("localhost", "root", "", "clientes");
				$sql = "UPDATE clientes SET nomeCliente = '$nomeClie', 
						telCliente = '$telClie',
						dataNasCliente = '$dataNasc',
						rendaCliente = '$number',
						tipoCliente = '$tipoPessoa',
						emailCliente = '$emailCli',
						cpfCliente = '$cpfCli',
						enderecoCliente ='$enderecoCli',
						sexoCliente = '$sexoCli',
						statusCliente = '$statusCli'
				WHERE codigoCliente = '$codCli'";
				mysqli_query($link, $sql);
			}

		}
	}
?>