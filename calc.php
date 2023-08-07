<html>
<head>
	<meta charset="utf-8">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="grafico/highcharts.js"></script>
	<script src="grafico/series-label.js"></script>
	<script src="grafico/exporting.js"></script>
	<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css"> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="javascript" type="text/javascript">
	<style>
	.editado
	{
		background-color: #FFFAD7;
	}
	.editado-letras
	{
		font-size: 25px;
	}
	.editado-2
	{
		background-color: #D9FFD7;
	}
</style>
</head>
<body>
	<div class="container">
		<center>
			<?php
			$armazena_moda = 0;
			$h = 0;
			$k = 0;
			$r = 0;
			$fac = 0;
			$total_fac = 0;
			$variancia =0;
			$media = 0;
			$total_xi = 0;
			$total_fi = 0;
			$total_variancia = 0;
			$desvio = 0;
			$opcao_desvio = $_POST['op'];
			$fr = 0;
			$fr_discreta = 0;
			$soma_fr_discreta = 0;

			$_valores = ($_POST['contact_list']); 

			$converte_array = explode(",",$_valores); 		

			$quantidade = count($converte_array);

			echo "<div class='editado-2'>";

			echo "<div class='editado-letras'>Distribuição discreta</div><br>";

			echo "Rol em ordem crescente: <br><div class='editado-2'>";

			//ordenação do vetor
			sort($converte_array);
			foreach ($converte_array as $key => $val) {
				echo $val." ";
			}
			echo "<br></div>";

			//soma todos os valores do vetor
			$soma = array_sum($converte_array);

			//conta a quantidade de elementos de um vetor
			$quantidade = count($converte_array);

			$media = $soma/$quantidade;

			echo "<br>Média: ". number_format($media,2,",",".")."<br><br>";

			//faz o calculo da mediana 
			if($quantidade % 2 == 0)
			{
				$auxiliar = (int)$quantidade / 2;

				$mediana = ($converte_array[$auxiliar - 1] + $converte_array[$auxiliar])/2;
				echo "Mediana: ". number_format($mediana, 2, ",","."). "<br><br>";
			}
			else
			{
				$auxiliar = (int)$quantidade / 2;
				$mediana = $converte_array[$auxiliar];
				echo "Mediana: ".$mediana. "<br><br>";
			}		

			//processo da moda

			//conta todos os valores do vetor
			$count = array_count_values($converte_array);

			$values = array_keys($count, max($count)); 

			$contadora = count($values);

			//se a contadora (quantidade de moda que existe) for igual a quantidade de numeros (amostra), quer dizer que nenhum é moda
			if($quantidade == $contadora)
			{
				echo "Moda: <br>";
				echo "Não tem moda.";
			}
			else
			{
				echo "Moda: <br>";

				while(($contadora) > 0)
				{
					echo $values[$contadora - 1]. "   ";
					$contadora--;
				}
				echo "<br>";
				echo "<br>";
			}

			
			?>
			<table class="table table-bordered table">
				<thead>
					<tr>
						<th style="background-color: #65AEE8; color: white;">XI</th>
						<th style="background-color: #65AEE8; color: white;">FI</th>
						<th style="background-color: #65AEE8; color: white;">FAC</th>
						<th style="background-color: #65AEE8; color: white;">FR</th>
						<th style="background-color: #65AEE8; color: white;">VARIÂNCIA</th>
					</tr>
				</thead>
				<tfoot>
					<?php

			$contagem = array_count_values($converte_array);  //pega a quantidade de vezes que um determinado numero/string, enfim, se repete
			
			foreach($contagem AS $numero => $vezes) {
				if($vezes >= 1) 
				{
					$variancia = (($numero - $media)*(($numero - $media)))*$vezes;
					$total_xi += $numero;
					$total_fi += $vezes;
					$total_variancia += $variancia;
					$fac = $fac + $vezes;
					$total_fac += $fac;
					$fr_discreta = $vezes / count($converte_array);
					$soma_fr_discreta += $fr_discreta;
					?>
					<tr>
						<td><?= $numero;?></td>
						<td><?= $vezes;?></td>
						<td><?= $fac?></td>
						<td><?= number_format($fr_discreta *= 100)." %";?></td>
						<td><?= number_format($variancia, 2, ',', '.');?></td>
					</tr>
					<?php
				}
			}
			?>
			<tr>
				<td style="background-color: #65AEE8; color: white";>&Sigma; <?= $total_xi;?></td>
				<td style="background-color: #65AEE8; color: white";>&Sigma; <?= $total_fi;?></td>
				<td style="background-color: #65AEE8; color: white";>&Sigma; <?= $total_fac;?></td>
				<td style="background-color: #65AEE8; color: white";>&Sigma; <?= number_format($soma_fr_discreta * 100). " %";?></td>
				<td style="background-color: #65AEE8; color: white";>&Sigma; <?= number_format($total_variancia, 2, ',', '.');?></td>
			</tr>
		</tfoot>
	</table>
	<br>
	<br>

	<?php
	if($total_fi == 1)
	{
		echo "Desvio padrão é 0";
	}
	else
	{
		if($opcao_desvio == 1)
		{
						//calculo variancia amostral
			$total_variancia = $total_variancia/($total_fi - 1);
		}
		else
		{
						//calculo variancia populacional
			$total_variancia = $total_variancia/$total_fi;
		}
	}
	$desvio = sqrt($total_variancia);

	echo "Variância: ". number_format($total_variancia, '2', ',', '.') . "<br>";
	echo "Desvio padrão: ".number_format($desvio, 2, ',', '.');
	echo "</div>";
	echo "<br><br>";
    		//fazer processo da tabela com frequencia discreta (com intervalos)

    		//formulas

    		//amplitude total
    		//R = Xmáx - Xmin

    		//classes (número de linhas)
    		//K = raiz de n, onde n é a quantidade de numeros

    		//amplitude das classes (intervalo)
    		//h = R/K

	echo "<div class='editado'>";

	$_valores = ($_POST['contact_list']); 

	$converte_array = explode(",",$_valores);

	$quantidade = count($converte_array);

	echo "<div class='editado-letras'>Distribuição contínua</div><br>";

	echo "Rol em ordem crescente: <br>";

			//ordenação do vetor
	sort($converte_array);
	foreach ($converte_array as $key => $val) {
		echo $val."  ";
	}
	echo "<br>";
	$r = $converte_array[$quantidade - 1] - $converte_array[0];

	$k = sqrt($quantidade);
	$k_2 = sqrt($quantidade);

	$h = $r / $k;

	$inteiro_h = intval($h);
	$inteiro_k = intval($k);


			//arrendondando para maior (se casas decimais > 0.5) ou para menor (se casas decimais < 0.5)
	if(($k - $inteiro_k) >= 0.05)
	{
		$k = $inteiro_k + 1;
	}
	else
	{
		$k = $inteiro_k;
	}

			//arrendondando para maior (se casas decimais > 0.5) ou para menor (se casas decimais < 0.5)
	if(($h - $inteiro_h) >= 0.5)
	{
		$h = $inteiro_h + 1;
	}
	else
	{
		$h = $inteiro_h;
	}

	echo "<br>Informações relacionadas a tabela <br><br>";

	echo "A classe (quantidade de linhas) é: ". $k."<br>";
	echo "Amplitude total (R - Xmáx - Xmin): ". $r. "<br>";
	echo "Amplitude das classes (intervalo): ". $h. "<br><br>";

	?>
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th style="background-color: #65AEE8; color: white";>Classes</th>
				<th style="background-color: #65AEE8; color: white";>FI</th>
				<th style="background-color: #65AEE8; color: white";>XI</th>
				<th style="background-color: #65AEE8; color: white";>XI * FI</th>
				<th style="background-color: #65AEE8; color: white";>FAC</th>
				<th style="background-color: #65AEE8; color: white";>FR</th>
				<th style="background-color: #65AEE8; color: white";>Variância</th>
			</tr>
		</thead>
		<tfoot>
			<?php
			$ajudante = $converte_array[0];
			$var_aux = 0;
			$xi_fi = 0;
			$media_classes = 0;
			$xi = 0;
			$contadora = 0;

			while($k_2 > 0)
			{
				$var_aux = $ajudante + $h;
				if($var_aux == $converte_array[$quantidade - 1])
				{
					$var_aux++;
				}
				$xi = ($ajudante + $var_aux)/2;
				while($quantidade > 0)
				{
					if(($converte_array[$quantidade - 1] >= $ajudante)&&(($converte_array[$quantidade - 1] < $var_aux))){
						$contadora++;
					}
					$quantidade--;
				}
				$quantidade = count($converte_array);
				$ajudante = $var_aux;
				$xi_fi += $xi * $contadora;
				$contadora = 0;
				$media_classes = $xi_fi / $quantidade;
				$k_2--;
			}


			echo "A média é: ".number_format($media_classes, '2', ',', '.')."<br><br>";

				//preenchendo a tabela

			$r = $converte_array[$quantidade - 1] - $converte_array[0];

			$k = sqrt($quantidade);

			$h = $r / $k;

			$inteiro_h = intval($h);
			$inteiro_k = intval($k);


				//arrendondando para maior (se casas decimais > 0.5) ou para menor (se casas decimais < 0.5)
			if(($k - $inteiro_k) >= 0.05)
			{
				$k = $inteiro_k + 1;
			}
			else
			{
				$k = $inteiro_k;
			}

				//arrendondando para maior (se casas decimais > 0.5) ou para menor (se casas decimais < 0.5)
			if(($h - $inteiro_h) >= 0.5)
			{
				$h = $inteiro_h + 1;
			}
			else
			{
				$h = $inteiro_h;
			}


			$quantidade = count($converte_array);
			$ajudante = $converte_array[0];
			$quant_no_intervalo = 0;
			$var_aux = 0;
			$cont_num = 0;
			$k_aux = $k;
			$contadora = 0;
			$fac_classes = 0;
			$xi_classes = 0;
			$xi_fi = 0;
			$variancia_classe = 0;
			$soma_xi = 0;
			$soma_xi_fi = 0;
			$soma_xi_classe = 0;
			$soma_fi = 0;
			$soma_fac = 0;
			$fr_classes = 0;
			$total_fr = 0;
			$soma_variancia = 0;
			$fac_classes_anterior = 0;
			$termo_2 = 0;
			$ajuda_quant = $quantidade;
				$contagem = array_count_values($converte_array);  //pega a quantidade de vezes que um determinado numero/string, enfim, se repete
				$mediana_classes = 0;
				while($k > 0)
				{	  		
					?>
					<tr>
						<td>
							<?php	
							$var_aux = $ajudante + $h;
							if($var_aux == $converte_array[$quantidade - 1])
							{
								$var_aux++;
							}
							echo $ajudante." |--------- ". $var_aux;
							$xi_classes = ($ajudante + $var_aux)/2;
							$soma_xi += $xi_classes;
							?>
						</td>
						<?php
						while($quantidade > 0)
						{
							if(($converte_array[$quantidade - 1] >= $ajudante)&&(($converte_array[$quantidade - 1] < $var_aux)))
							{
								$contadora++;
							}
							$quantidade--;
						}
						?>
						<td>
							<?php
							echo $contadora;
							$fac_classes += $contadora;
							$soma_fac += $fac_classes;
							$soma_fi += $contadora;
							$xi_fi = $xi_classes * $contadora;
							$soma_xi_fi += $xi_fi;
							$quantidade = count($converte_array);
							$fr_classes = $contadora / $quantidade;
							$variancia_classe = (($xi_classes - $media_classes)*($xi_classes - $media_classes))*$contadora;
							$soma_variancia += $variancia_classe;
							$total_fr += $fr_classes;

							//só executa uma vez
							if($ajuda_quant == $quantidade){
								if($quantidade % 2 == 0)
								{
									//caso seja par
									$termo = $quantidade  / 2;
									if($termo <= $fac_classes_anterior)
									{
										$ajudante *= 1;
										$mediana_classes = $ajudante + ((($termo - $fac_classes_anterior) * $h) / $contadora);
									}
								}
							}
							$contadora = 0;
							?>
						</td>
						<td>
							<?=
							$xi_classes;
							?>
						</td>
						<td>
							<?=
							$xi_fi;
							?>
						</td>
						<td>
							<?=
							$fac_classes;
							?>
						</td>
						<td>
							<?php
							$fr_classes = number_format($fr_classes, "4", ".", ",") * 100;
							echo $fr_classes." %";
							?>
						</td>
						<td>
							<?=
							$variancia_classe = number_format($variancia_classe, "2", ",", ".")
							?>
						</td>
					</tr>
					<?php
					$ajudante = $var_aux; 
					$fac_classes_anterior = $fac_classes;
					$k--;	
				}
				$total_fr *= 100;

				?>
				<tr>
					<!--Rodapé da tabela-->
					<td style="background-color: #65AEE8; color: white";>&Sigma;</td>
					<td style="background-color: #65AEE8; color: white";><?= $soma_fi;?></td>
					<td style="background-color: #65AEE8; color: white";><?= $soma_xi;?></td>
					<td style="background-color: #65AEE8; color: white";><?= $soma_xi_fi;?></td>
					<td style="background-color: #65AEE8; color: white";><?= $soma_fac;?></td>
					<td style="background-color: #65AEE8; color: white";><?= $total_fr. " %";?></td>
					<td style="background-color: #65AEE8; color: white";><?= number_format($soma_variancia, '2', ',', '.');?></td>
				</tr>
			</tfoot>
		</table>
		<?php 
			//variancia e desvio padrão
		if($total_fi == 1)
		{
			echo "Desvio padrão é 0";
		}
		else
		{
			if($opcao_desvio == 1)
			{
						//calculo variancia amostral
				$soma_variancia = $soma_variancia/($total_fi - 1);
			}
			else
			{
						//calculo variancia populacional
				$soma_variancia = $soma_variancia/$total_fi;
			}
		}

		echo "Mediana: 0 <br>";

		echo "Variância: ". number_format($soma_variancia, '2', ',','.'). "<br>";
		$desvio = sqrt($soma_variancia);

		echo "Desvio padrão: " . number_format($desvio, '2', ',', '.'). "<br><br>";

		//echo "</div>";
		?>

		<p data-toggle="tooltip" title="Gera Gráfico">
			<button type="button" title="Gerar gráfico" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Gerar gráfico</button>
		</p>

		<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div id="grafico"></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					</div>
				</div>

			</div>
		</div>

		

		<a href="calculadora.html">
			<button class="btn btn-default">Voltar</button>
		</a>
	</div>
</div>
</center> 

<script type="text/javascript">

	var data = [[161.2, 51.6], [167.5, 59.0], [159.5, 49.2], [157.0, 63.0], [155.8, 53.6],
	[170.0, 59.0], [159.1, 47.6], [166.0, 69.8], [176.2, 66.8], [160.2, 75.2],
	[172.5, 55.2], [170.9, 54.2], [172.9, 62.5], [153.4, 42.0], [160.0, 50.0],
	[147.2, 49.8], [168.2, 49.2], [175.0, 73.2], [157.0, 47.8], [167.6, 68.8],
	[159.5, 50.6], [175.0, 82.5], [166.8, 57.2], [176.5, 87.8], [170.2, 72.8],
	[174.0, 54.5], [173.0, 59.8], [179.9, 67.3], [170.5, 67.8], [160.0, 47.0],
	[154.4, 46.2], [162.0, 55.0], [176.5, 83.0], [160.0, 54.4], [152.0, 45.8],
	[162.1, 53.6], [170.0, 73.2], [160.2, 52.1], [161.3, 67.9], [166.4, 56.6],
	[168.9, 62.3], [163.8, 58.5], [167.6, 54.5], [160.0, 50.2], [161.3, 60.3],
	[167.6, 58.3], [165.1, 56.2], [160.0, 50.2], [170.0, 72.9], [157.5, 59.8],
	[167.6, 61.0], [160.7, 69.1], [163.2, 55.9], [152.4, 46.5], [157.5, 54.3],
	[168.3, 54.8], [180.3, 60.7], [165.5, 60.0], [165.0, 62.0], [164.5, 60.3],
	[156.0, 52.7], [160.0, 74.3], [163.0, 62.0], [165.7, 73.1], [161.0, 80.0],
	[162.0, 54.7], [166.0, 53.2], [174.0, 75.7], [172.7, 61.1], [167.6, 55.7],
	[151.1, 48.7], [164.5, 52.3], [163.5, 50.0], [152.0, 59.3], [169.0, 62.5],
	[164.0, 55.7], [161.2, 54.8], [155.0, 45.9], [170.0, 70.6], [176.2, 67.2],
	[170.0, 69.4], [162.5, 58.2], [170.3, 64.8], [164.1, 71.6], [169.5, 52.8],
	[163.2, 59.8], [154.5, 49.0], [159.8, 50.0], [173.2, 69.2], [170.0, 55.9],
	[161.4, 63.4], [169.0, 58.2], [166.2, 58.6], [159.4, 45.7], [162.5, 52.2],
	[159.0, 48.6], [162.8, 57.8], [159.0, 55.6], [179.8, 66.8], [162.9, 59.4],
	[161.0, 53.6], [151.1, 73.2], [168.2, 53.4], [168.9, 69.0], [173.2, 58.4],
	[171.8, 56.2], [178.0, 70.6], [164.3, 59.8], [163.0, 72.0], [168.5, 65.2],
	[166.8, 56.6], [172.7, 105.2], [163.5, 51.8], [169.4, 63.4], [167.8, 59.0],
	[159.5, 47.6], [167.6, 63.0], [161.2, 55.2], [160.0, 45.0], [163.2, 54.0],
	[162.2, 50.2], [161.3, 60.2], [149.5, 44.8], [157.5, 58.8], [163.2, 56.4],
	[172.7, 62.0], [155.0, 49.2], [156.5, 67.2], [164.0, 53.8], [160.9, 54.4],
	[162.8, 58.0], [167.0, 59.8], [160.0, 54.8], [160.0, 43.2], [168.9, 60.5],
	[158.2, 46.4], [156.0, 64.4], [160.0, 48.8], [167.1, 62.2], [158.0, 55.5],
	[167.6, 57.8], [156.0, 54.6], [162.1, 59.2], [173.4, 52.7], [159.8, 53.2],
	[170.5, 64.5], [159.2, 51.8], [157.5, 56.0], [161.3, 63.6], [162.6, 63.2],
	[160.0, 59.5], [168.9, 56.8], [165.1, 64.1], [162.6, 50.0], [165.1, 72.3],
	[166.4, 55.0], [160.0, 55.9], [152.4, 60.4], [170.2, 69.1], [162.6, 84.5],
	[170.2, 55.9], [158.8, 55.5], [172.7, 69.5], [167.6, 76.4], [162.6, 61.4],
	[167.6, 65.9], [156.2, 58.6], [175.2, 66.8], [172.1, 56.6], [162.6, 58.6],
	[160.0, 55.9], [165.1, 59.1], [182.9, 81.8], [166.4, 70.7], [165.1, 56.8],
	[177.8, 60.0], [165.1, 58.2], [175.3, 72.7], [154.9, 54.1], [158.8, 49.1],
	[172.7, 75.9], [168.9, 55.0], [161.3, 57.3], [167.6, 55.0], [165.1, 65.5],
	[175.3, 65.5], [157.5, 48.6], [163.8, 58.6], [167.6, 63.6], [165.1, 55.2],
	[165.1, 62.7], [168.9, 56.6], [162.6, 53.9], [164.5, 63.2], [176.5, 73.6],
	[168.9, 62.0], [175.3, 63.6], [159.4, 53.2], [160.0, 53.4], [170.2, 55.0],
	[162.6, 70.5], [167.6, 54.5], [162.6, 54.5], [160.7, 55.9], [160.0, 59.0],
	[157.5, 63.6], [162.6, 54.5], [152.4, 47.3], [170.2, 67.7], [165.1, 80.9],
	[172.7, 70.5], [165.1, 60.9], [170.2, 63.6], [170.2, 54.5], [170.2, 59.1],
	[161.3, 70.5], [167.6, 52.7], [167.6, 62.7], [165.1, 86.3], [162.6, 66.4],
	[152.4, 67.3], [168.9, 63.0], [170.2, 73.6], [175.2, 62.3], [175.2, 57.7],
	[160.0, 55.4], [165.1, 104.1], [174.0, 55.5], [170.2, 77.3], [160.0, 80.5],
	[167.6, 64.5], [167.6, 72.3], [167.6, 61.4], [154.9, 58.2], [162.6, 81.8],
	[175.3, 63.6], [171.4, 53.4], [157.5, 54.5], [165.1, 53.6], [160.0, 60.0],
	[174.0, 73.6], [162.6, 61.4], [174.0, 55.5], [162.6, 63.6], [161.3, 60.9],
	[156.2, 60.0], [149.9, 46.8], [169.5, 57.3], [160.0, 64.1], [175.3, 63.6],
	[169.5, 67.3], [160.0, 75.5], [172.7, 68.2], [162.6, 61.4], [157.5, 76.8],
	[176.5, 71.8], [164.4, 55.5], [160.7, 48.6], [174.0, 66.4], [163.8, 67.3]];
	function histogram(data, step) {
		var histo = {},
		x,
		i,
		arr = [];

			    // Group down
			    for (i = 0; i < data.length; i++) {
			    	x = Math.floor(data[i][0] / step) * step;
			    	if (!histo[x]) {
			    		histo[x] = 0;
			    	}
			    	histo[x]++;
			    }

			    // Make the histo group into an array
			    for (x in histo) {
			    	if (histo.hasOwnProperty((x))) {
			    		arr.push([parseFloat(x), histo[x]]);
			    	}
			    }

			    // Finally, sort the array
			    arr.sort(function (a, b) {
			    	return a[0] - b[0];
			    });

			    return arr;
			}

			Highcharts.chart('grafico', {
				chart: {
					type: 'column'
				},
				title: {
					text: 'Histograma'
				},
				xAxis: {
					gridLineWidth: 1
				},
				yAxis: [{
					title: {
						text: 'FI'
					}
				}, {
					opposite: true,
					title: {
						text: ''
					}
				}],
				series: [{
					name: 'Histograma',
					type: 'column',
					data: histogram(data, 10),
					pointPadding: 0,
					groupPadding: 0,
					pointPlacement: 'between'
				}, {
					name: 'Dispersão',
					type: 'scatter',
					data: data,
					yAxis: 1,
					marker: {
						radius: 1.5
					}
				}]
			});	

			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip({trigger:"hover"});   
			});
			

		</script>
	</body>
	</html>