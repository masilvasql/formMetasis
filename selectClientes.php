<?php
	
    //Conectando ao banco de dados
    $con = new mysqli("localhost", "root", "", "clientes");
    if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
    //Consultando banco de dados
    $qryLista = mysqli_query($con, "SELECT * FROM clientes");    
    while($resultado = mysqli_fetch_assoc($qryLista)){
        $vetor[] = array_map('utf8_encode', $resultado); 
    }    
?>