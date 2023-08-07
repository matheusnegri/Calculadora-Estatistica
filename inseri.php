<html>

<head>
	<title>Aviso!</title>
	<link href="css/bootstrap.css" rel="stylesheet">
	<meta charset="utf-8">
	<style>
	.edit-sucess
	{
		text-align: center;
		background: green; 
		color: white;
	}
	.edit-danger
	{
		text-align: center;
		background: red; 
		color: white;
	}
	</style>
</head>
<body>
<?php
				$nome = $_GET['nome'];
				$email = $_GET['email'];
				$mensagem = $_GET['mensagem'];

				include("conexao.php");

				$sql = "INSERT INTO usuarios (nomeUsuario, emailUsuario, mensagemUsuario) VALUES ('$nome', '$email', '$mensagem')";


				if(!mysqli_query($conn, $sql))
				{ 
					?>
					<p class="edit-danger">Sua mensagem não foi enviada! <br> Preencha todos os campos e tente novamente!
					</p>
				<?php 
				} 
				else { ?> 
					<p class="edit-sucess"> <?= $nome?>, sua mensagem foi enviada com sucesso!
					</p>
				<?php
					}			
				?>
	<center>
		<a href="index.html">
			<button class="btn btn-default">Voltar</button>
		</a>
	</center>
</body>
</html>