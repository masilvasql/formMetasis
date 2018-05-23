<div  style="overflow: auto; width: auto; height: 400px; border:solid 2px">
	<table class="table table-striped table-bordered table-condensed table-hover">
		<tr>
			<td class="success" align="center">Código</td>
			<td class="success" align="center">Nome</td>
			<td colspan="2" class ="success" align="center">Ações</td>
		</tr>					
		<?php
			include_once("configuration.php");
			$query = mysqli_query($conexao,"SELECT * FROM clientes");
			while($resultado = mysqli_fetch_array($query)){   
		?>
			<tr class="info">
				<td id ="codCli"> <?php echo $resultado["codigoCliente"]  ?></td>
				<td id ="nomeCli"> <?php echo $resultado["nomeCliente"]  ?></td>
				<td id ="telCliente" hidden> <?php echo $resultado["telCliente"]  ?></td>
				<td id ="dataNasc" hidden> <?php echo $resultado["dataNasCliente"]  ?></td>
				<td id ="rendaCli" hidden> <?php echo $resultado["rendaCliente"]  ?></td>
				<td id ="tipoPessoa" hidden> <?php echo $resultado["tipoCliente"]  ?></td>
				<td id ="emailCli" hidden> <?php echo $resultado["emailCliente"]  ?></td>
				<td id ="cpfCli" hidden> <?php echo $resultado["cpfCliente"]  ?></td>
				<td id ="enderecoCli" hidden> <?php echo $resultado["enderecoCliente"]  ?></td>
				<td id ="sexoCli" hidden> <?php echo $resultado["sexoCliente"]  ?></td>
				<td id ="statusCli" hidden> <?php echo $resultado["statusCliente"]  ?></td>
				<td align ="center"><button class="btn btn-primary editar" id="editar" onclick="editar()"> <i  class="fa fa-edit" value = "editar" ></i></button></td>
				<td align ="center"><button id ="deletar" value="deletar" onclick="deleta()" class="deleta btn btn-danger" > <i  class="deleta fa fa-trash" ></i> </button></td>			
			</tr>
		<?php } ?>
	</table>
</div>
<br>
<button type="button" class="btn btn-success btn-lg ">Voltar página Inicial</button>
<br>
<br>
<br>