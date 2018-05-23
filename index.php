<?php
	include_once("configuration.php");
?>


<!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title> Cadastro de Clientes </title>
		<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="lib/css/themes/default.rtl.css">
		<link rel="stylesheet" href="lib/css/alertify.min.css">
		<script src="lib/jquery.maskedinput-master/lib/jquery-1.8.3.min.js"></script>
		<script src="lib/alertify.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
	
	<script language="javascript"> // Máscara de Moeda 
		String.prototype.reverse = function(){
		  return this.split('').reverse().join(''); 
		};
		function mascaraMoeda(campo,evento){
		  var tecla = (!evento) ? window.event.keyCode : evento.which;
		  var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
		  var resultado  = "";
		  var mascara = "##.###.###,##".reverse();
		  for (var x=0, y=0; x<mascara.length && y<valor.length;) {
		    if (mascara.charAt(x) != '#') {
		      resultado += mascara.charAt(x);
		      x++;
		    } else {
		      resultado += valor.charAt(y);
		      y++;
		      x++;
		    }
		  }
		  campo.value = resultado.reverse();
		}
	</script>

	<script> // Máscara de CPF e CNPJ
		$(document).ready(function(){
			$('#select').change(function(){
				var opt = $("#select option:selected").val();
				var mask = "";
				if(opt == "Jurídica"){
		    		$('#cpf').mask('99.999.999/9999-99');
		    		$("#cpf").attr("placeholder", "Digite o CNPJ").placeholder();
				}else{
					if(opt=="Física"){
						$('#cpf').mask('999.999.999-99');	
						$("#cpf").attr("placeholder", "Digite o CPF").placeholder();
						editCNPJouCPF.style.display = 'none';
					}else{
						if(opt==""){
							$("#cpf").attr("placeholder","Selecione uma opção à cima").placeholder();
						}
					}
				}
			});
			$('#telefone').mask('(99)9.9999-9999');	
		});
	</script>

	<script language="javascript"> // validação de campos + passagem de parâmetros para INSERT e UPDATE
	    function valida() {
	    	var statusCli;
	    	if(document.getElementById("statusCliente").checked==false){
	    		statusCli = document.getElementById("statusCliente").value="Inativo";
	    	}else{
	    		statusCli = document.getElementById("statusCliente").value="Ativo";
	    	}
	    	var statusCli;
	    	if(document.getElementById("statusCliente").checked==false){
	    		statusCli = document.getElementById("statusCliente").value="Inativo";
	    	}else{
	    		statusCli = document.getElementById("statusCliente").value="Ativo";
	    	}


	        var comboNome = document.getElementById("select");
	        var CpfCnpj = $("#cpf").val();
	        var sexoCliente;
	        if(document.getElementById("radioMasc").checked==true){
	        	sexoCliente = "Masculino"
	        }
	        if(document.getElementById("radioFem").checked==true){
	        	sexoCliente = "Feminino"
	        }
	        if(document.getElementById("radioOut").checked==true){
	        		sexoCliente = "Outro"	
	        }
	        if (comboNome.options[comboNome.selectedIndex].value == "" ){
				alertify.set('notifier','position', 'top-right');
	        	alertify.error('Selecione um tipo de cliente antes de prosseguir');
	        }else{
	        	if(CpfCnpj == ""){
	        		alertify.set('notifier','position', 'top-right');
	        		alertify.error('Digite o CPF ou CNPJ antes de prosseguir');
	        	}else{
	        		var btn = document.getElementById("btnSalvar").value;
	        		if(btn.trim()=="Salvar"){
	        			$(".save").submit(function(e){
			            	e.preventDefault();
			              	$.post("./op_cliente.php", {
			                	save: "true",
			                   	idCliente: $(this).find("[name=idCliente]").val(),
			                   	nome: $(this).find("[name=nome]").val(), 
			                   	telefone: $(this).find("[name=telefone]").val(),
			                   	dataNasc: $(this).find("[name=dataNasc]").val(),
			                   	renda: $(this).find("[name=renda]").val(),
			                   	tipoPessoa: $(this).find("[name=tipoPessoa]").val(),
			                   	cpf:$(this).find("[name=cpf]").val(),
			                   	email:$(this).find("[name=email]").val(),
			                   	endereco: $(this).find("[name=endereco]").val(),
			                   	sexo:sexoCliente,
			                   	status:statusCli
			               	})
			               	.done(function() {
			                  clientes();
			               })
			     		});	
	        		}else{
	        			if(confirm('Deseja Editar Este Registro?')){
	        				$(".save").submit(function(e){
			            	e.preventDefault();
			              	$.post("./op_cliente.php", {
			                	update: "true",
			                   	idCliente: $(this).find("[name=idCliente]").val(),
			                   	nome: $(this).find("[name=nome]").val(), 
			                   	telefone: $(this).find("[name=telefone]").val(),
			                   	dataNasc: $(this).find("[name=dataNasc]").val(),
			                   	renda: $(this).find("[name=renda]").val(),
			                   	tipoPessoa: $(this).find("[name=tipoPessoa]").val(),
			                   	cpf:$(this).find("[name=cpf]").val(),
			                   	email:$(this).find("[name=email]").val(),
			                   	endereco: $(this).find("[name=endereco]").val(),
			                   	sexo:sexoCliente,
			                   	status:statusCli
			               	})
			               	.done(function() {
			       				clientes();
			       				limpaCampos();
			               })
			     		});	
			     			alertify.success('Registro Editado Com Sucesso!');
	        			}
	        		}
	        	}
	    	}
	    } 
	</script>

	<script> // Passagem de parâmetros para DELETE
		function deleta(){
	    	if (confirm('Deseja realmente deletar este registro?')) {
	    		$(document).on("click",".deleta", function(){
	            	let tr = $(this).parent().parent();
	             	$.post("./op_cliente.php", {
	              		delete: "true",
	              		codCli: tr.find("td#codCli").text()
	          	  	})
	          	   		.done(function() {
	                    	clientes();
	               		})
	    			})
						alertify.success('O Registro Foi Deletado');
			} else {
						alertify.warning('O Registro Não Foi deletado');
				}
			}

	</script>

	<script>
		function alertaDelete(){
			
		}
	</script>


	<script>
		function editar(){
			
			 $(document).on( "click",".editar", function(){
			 	  document.getElementById("nome").focus;
			 	  document.getElementById("btnSalvar").value="Editar";
			 	  document.getElementById("cod").setAttribute('disabled','enabled');
	              let tr = $(this).parent().parent();
	              $("input[name='idCliente']").val(tr.find("td#codCli").text().trim());
	              $("input[name='nome']").val(tr.find("td#nomeCli").text().trim());
	              $("input[name='telefone']").val(tr.find("td#telCliente").text().trim());
	              $("input[name='dataNasc']").val(tr.find("td#dataNasc").text().trim());
	              $("input[name='renda']").val(tr.find("td#rendaCli").text().trim());
	              $("select[name='tipoPessoa']").val(tr.find("td#tipoPessoa").text().trim());
	              $("input[name='cpf']").val(tr.find("td#cpfCli").text().trim());
	              $("input[name='email']").val(tr.find("td#emailCli").text().trim());
	              $("input[name='endereco']").val(tr.find("td#enderecoCli").text().trim());
	              let trSexo = $(this).parent().parent();
	              trSexo.find("td#sexoCli").text()
	              
	              if(trSexo.find("td#sexoCli").text() == " Masculino"){
	              	document.getElementById("radioMasc").checked=true;		
	              }else{
	              	if(trSexo.find("td#sexoCli").text() == " Feminino"){
	              		document.getElementById("radioFem").checked=true;
	              	}else{
	              		if(trSexo.find("td#sexoCli").text() == " Outro"){
	              			document.getElementById("radioOut").checked=true;
	              		}
	              	}
	              }
	      		  let trStatus = $(this).parent().parent();
	         	  trStatus.find("td#statusCli").text()
	              if(trStatus.find("td#statusCli").text().trim() == "Ativo"){
	              	document.getElementById("statusCliente").click();
	              }	
	        });
		}
	</script>

	<script>
		function clientes() {
	 		$.ajax({
	   		type: "POST",
	   		url: "table.php",
	   		data: {},
	   success: function(data) {
	     $('#contenTable').html(data);
	   }
	 });
	}
	</script>

	<script>
		$( document ).ready(function() {
	    	clientes();
	});
	</script>
	<script>
		function limpaCampos(){
			$('#form')[0].reset();
			$('#cod').prop('disabled', false);
			document.getElementById("btnSalvar").value="Salvar";
		}
	</script>
		<div class="container">
			<h1>Cadastro de Clientes</h1>
			<form class="save" class="form-horizontal" method= "POST" id="form"> 
			<div>
				<input type="text" class="form-control" class="name" id="cod" name="idCliente"  placeholder="Informe o Código"  required>
				<br>
				<input type="text" class="form-control" class="name" id="nome" name ="nome" placeholder = "Informe o nome" required>
				<br>
				<input type="text" class="form-control" class="name" id= "telefone" name ="telefone" placeholder = "Informe o telefone">
				<br>
				<input type="date" class="form-control" class="name" id= "nascimento" name="dataNasc" placeholder = "Informe a Data de Nascimento">
				<br>
				<input type="text" class="form-control" class="name" id= "renda" name="renda" placeholder = "Informe a Renda"  onKeyUp="mascaraMoeda(this, event)">
				<br>
				<div class="combo">
					<select class="form-control" class="name" id = "select" onchange name="tipoPessoa" required>
					 	<option value = "">Tipo Pessoa</option>
					  	<option value = "Física">Física</option>
					  	<option value = "Jurídica">Jurídica</option>
					</select>
				</div>
				<br>
				<input type="text" class="form-control" class="name" id= "cpf" name="cpf" placeholder = "Selecione uma opção à cima"   style="display:block;">	
				<br>
				<input type="email" class="form-control" class="name" id= "email" name ="email" placeholder = "Informe o email">
				<br>
				
				<input type="text" class="form-control" class="name" id= "endereco" name="endereco" placeholder = "Informe o endereço">	
				<br>
				 <fieldset class="fieldSet">
	  				<legend class="legend">Sexo</legend>
	  				<input type="radio" name="sexo" class="name" id="radioMasc" value="Masculino" required>Masculino
					<br>
					<input type="radio" name="sexo" class="name" id="radioFem" value="Feminino" >Feminino
					<br>
					<input type="radio" name="sexo" class="name" id="radioOut" value="Outro" >Outro
	  			 </fieldset>
				<br>
				<input type="checkbox" value="Ativo" class="name" name="status" id="statusCliente">Ativo
				<br>
				<br>
				<input type="submit" class="btn btn-primary btn-lg btn-block" value = "Salvar" onclick="valida()" id="btnSalvar">
			</div>
			<br>	
			</form>
			<div id="contenTable">
	    		<!-- Aqui a tabela é mostrada à partir do arquivo table.php  -->
			</div>
			
			<script src="lib/jquery/jquery.min.js"></script>
			<script src="lib/bootstrap/js/bootstrap.min.js"></script>
			<script src="lib/jquery.maskedinput-master/dist/jquery.maskedinput.min.js"></script>
		</div>
	</body>
</html>
