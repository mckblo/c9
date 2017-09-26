<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"></meta>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"></meta>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"></link>
<!--
	<link href="bootstrap/css/style.css" rel="stylesheet"></link>
-->
	<script src="bootstrap/js/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<title>By Matheus C. Miranda</title>
</head>
<body>
	<div id="header"></div>
	<br/>

	<!-- #main -->
	<div id="main" class="container-fluid">
		<div id="titulo" class="jumbotron">
			<center>
				<h1>Enquete</h1>
					<?php
						$IP = getenv("REMOTE_ADDR");
						$bd = pg_connect("host=elmer.db.elephantsql.com dbname=xsfyiuwk user=xsfyiuwk password=F8PrHFPyWBDdIIlOLiZfViZwG4Xy-6UZ");
						if (!$bd){
							echo ("<p>Erro no processamento do seu voto!</p><p>Não foi possível estabelecer uma conexão com o banco de dados.</p>");
							die();
						} else {
							$insert = "INSERT INTO enquete VALUES ('%s', '%s')";
							$insert = sprintf($insert, $_POST['serie'], $IP);
							$result = pg_query($bd, $insert);
							$qtd = pg_affected_rows($result);
							if ($qtd == 1) {
								echo ("<script>alert('Obrigado pelo seu voto!');window.location.href = 'index.html';</script>");
//								header('Location: index.html');
							} else {
								if (preg_match('/exists/i', pg_last_error()))
									echo ("<script>alert('Somente um voto por IP!!!');window.location.href = 'index.html';</script>");
								echo ("<script>alert('Falha na inclusão!!!');window.location.href = 'index.html';</script>");
								echo (pg_last_error());
								die();
							}
							pg_close($bd);
						}
					?>
			</center>
		</div>
	</div>
	<!-- /#main -->
	<div id="footer"></div>
</body>
</html>
