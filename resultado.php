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
				<p>Qual é a melhor série da atualidade?</p>
				<p>RESULTADOS</p>
				<table class="table table-striped" cellspacing="0" cellpadding="0">
					<?php
						$nome = array('0' => 'Black Mirror', '1' => 'Demolidor', '2' => 'Game of Thrones', '3' => 'Stranger Things', '4' => 'The Walking Dead', '5' => 'Vikings', '6' => 'Outros');
						$bd = pg_connect("host=elmer.db.elephantsql.com dbname=xsfyiuwk user=xsfyiuwk password=F8PrHFPyWBDdIIlOLiZfViZwG4Xy-6UZ");
						if (!$bd){
							echo ("<p>Não foi possível estabelecer uma conexão com o banco de dados.</p>");
							die();
						} else {
							$select = "SELECT * FROM enquete";
							$result = pg_query($bd, $select);
							$qtd = pg_num_rows($result);
							for ($i = 0; $i < 7; $i++) $total[$i] = 0;
							while ($linha = pg_fetch_array($result)) {
								$total[$linha['serie'] - 1]++;
							}
						}
						echo ("
							<thead>
								<tr>
									<th>Nome do Seriado</th>
									<th>Quantidade de Votos</th>
									<th>Percentual</th>
								</tr>
							</thead>
							<tbody>
						");
						for ($i = 0; $i < 7; $i++) {
							echo ("
								<tr>
									<td>" . $nome[$i] . "</td>
									<td>" . $total[$i] . "</td>
									<td>" . number_format(($total[$i] / $qtd * 100) , 2, ",", ".") . "%</td>
								</tr>
							</tbody>
							");
						}
						pg_close($bd);
					?>
				</table>
				<a href="index.html" class="btn btn-default btn-lg">Voltar</a>
			</center>
		</div>
	</div>
	<!-- /#main -->
	<div id="footer"></div>
</body>
</html>
