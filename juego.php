<?php session_start(); ?>

<?php
	echo '¡Juego de Combinación de Colores! <br>';
	echo 'Filas: '.$_SESSION['filas_mat'].' Columnas: '.$_SESSION['colum_mat'].' <br>Nombre Jugador: '.$_SESSION['nom_jugador'].'<br>';

	if(!isset($_POST['color_sec'])){
		$_POST['color_sec'] = 'Blanco';
	}

	//color	
	$_SESSION['color_sel'] = $_POST['color_sec'];	

	//valor del color
	if($_SESSION['color_sel'] == 'Amarillo'){
		$_SESSION['val_color'] = 1;
	}else if($_SESSION['color_sel'] == 'Azul'){
		$_SESSION['val_color'] = 2;
	}else if($_SESSION['color_sel'] == 'Rojo'){
		$_SESSION['val_color'] = 3;
	}
	
	if(!isset($_POST['turn_hid'])){
		$_POST['turn_hid'] = -1;
	}

	//seleccionador de turnos, false=prim, true=sec
	$_SESSION['turno_actual'] = $_POST['turn_hid'];	

	//creo variables post para las coordenadas
	if(!isset($_POST['col_hid']) && !isset($_POST['fil_hid'])){
		$_POST['col_hid'] = 0;
		$_POST['fil_hid'] = 0;
	}

	//aplico coordenadas segun turno y mando a rellenar matriz
	if($_SESSION['turno_actual'] == 0){
		$_SESSION['prim_fil'] = $_POST['fil_hid'];
		$_SESSION['prim_col'] = $_POST['col_hid'];
	}else if($_SESSION["turno_actual"] != 0 && $_SESSION['turno_actual'] != -1){
		$_SESSION['sec_fil'] = $_POST['fil_hid'];
		$_SESSION['sec_col'] = $_POST['col_hid'];

		rellenarMatriz($_SESSION['prim_fil'], $_SESSION['prim_col'], $_SESSION['sec_fil'], $_SESSION['sec_col']);
	}

	echo 'Color seleccionado: '.$_SESSION['color_sel'].'<br>';
	//echo 'Valor Turno: '.$_SESSION['turno_actual'].' Valor del Color sel: '.$_SESSION['val_color'].'<br>';

	//echo 'prim_fil: '.$_SESSION['prim_fil'].'  prim_col: '.$_SESSION['prim_col'].'<br>';
	//echo 'sec_fil: '.$_SESSION['sec_fil'].'  sec_col: '.$_SESSION['sec_col'].'<br>';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href=" estilos.css">
		<title>Intersecciones - Juego</title>
	</head>
	<body>
		
		<div id="div_tablero">			
			<form id="form_tablero" method="post">
				<table>
					<?php 
						echo "<input type='hidden' id='fil_act' name='fil_hid'>";
						echo "<input type='hidden' id='col_act' name='col_hid'>";

						echo "<input type='hidden' id='turno' name='turn_hid' value='".$_SESSION['turno_actual']."'>";

						for($i = 0; $i < $_SESSION['filas_mat']; $i++){
							echo '<tr>';
							for($j = 0; $j < $_SESSION['colum_mat']; $j++){
								echo "<td class='casilla' data-color='".$_SESSION['matrizLogica'][$i][$j]."' onclick='setear(".$i.",".$j.")'></td>";								
							}
						}
					?>	
				</table>
				
			</form>
		</div>
		
		<div id="div_colores">
			<form id="form_colores" method="post">
				<input type="radio" name="color_sec" value="Amarillo" onclick="verColor(this)"> Amarillo <br><br>
				<input type="radio" name="color_sec" value="Azul" onclick="verColor(this)">Azul <br><br>
				<input type="radio" name="color_sec" value="Rojo" onclick="verColor(this)">Rojo
			</form>
		</div>

		<script type="text/javascript" src="jquery-script.js"></script>
		<script type="text/javascript" src="script.js"></script>
	</body>
</html>

<?php
	function imprimirMatriz(){
		echo '<br><br><br<br><br><br<br><br><br<br><br><br<br><br><br<br><br><br<br><br><br<br>';
		if(isset($_SESSION['matrizLogica'])){
			for($i = 0; $i < $_SESSION['filas_mat']; $i++){
				echo '<br>';
				for($j = 0; $j < $_SESSION['colum_mat']; $j++){
					echo ' '.$_SESSION['matrizLogica'][$i][$j];
				}
			}
		}
	}

	function rellenarMatriz($prim_fil, $prim_col, $sec_fil, $sec_col){
		$aux_fil;
		$aux_col;

		if($prim_fil > $sec_fil){
			$aux_fil = $sec_fil;
			$sec_fil = $prim_fil;
			$prim_fil = $aux_fil;
		}

		if($prim_col > $sec_col){
			$aux_col = $sec_col;
			$sec_col = $prim_col;
			$prim_col = $aux_col;
		}

		//echo '<br> filas de '.$prim_fil.' hasta: '.$sec_fil.'';
		//echo '<br> columnas de '.$prim_col.' hasta: '.$sec_col.'<br><br>';

		for($i = $prim_fil; $i <= $sec_fil; $i++){
			for($j = $prim_col; $j <= $sec_col; $j++){

				$sw = $_SESSION['matrizLogica'][$i][$j] + $_SESSION['val_color'];

				if($sw < 9){					
					/*if($sw == 1){
						$_SESSION['matrizLogica'][$i][$j] = 1;
					}else if($sw == 2){
						$_SESSION['matrizLogica'][$i][$j] = 2;
					}else if($sw == 3 && $_SESSION['matrizLogica'][$i][$j] == 0){
						$_SESSION['matrizLogica'][$i][$j] = 3;						
					}else if($sw == 3 && $_SESSION['matrizLogica'][$i][$j] != 0){
						$_SESSION['matrizLogica'][$i][$j] = 4; //verde
					}else if($sw == 4){ //naranja
						$_SESSION['matrizLogica'][$i][$j] = 6;
					}else if($sw == 5){ //naranja
						$_SESSION['matrizLogica'][$i][$j] = 5;
					}else if($sw == 7){ //naranja
						$_SESSION['matrizLogica'][$i][$j] = 7;
					}else if($sw == 8){ //naranja
						$_SESSION['matrizLogica'][$i][$j] = 8;
					}*/

					if($sw == 3 && $_SESSION['matrizLogica'][$i][$j] == 0){
						$_SESSION['matrizLogica'][$i][$j] = 3;	
					}else if($sw == 3 && $_SESSION['matrizLogica'][$i][$j] != 0){
						$_SESSION['matrizLogica'][$i][$j] = 4; //verde
					}else if($sw == 4){ //naranja
						$_SESSION['matrizLogica'][$i][$j] = 6;
					}else{
						$_SESSION['matrizLogica'][$i][$j] = $sw;
					}
				}				
			}
		}

		$_SESSION['prim_fil'] = 0;
		$_SESSION['prim_col'] = 0;
		$_SESSION['sec_fil'] = 0;
		$_SESSION['sec_col'] = 0;
	}

	imprimirMatriz();
?>