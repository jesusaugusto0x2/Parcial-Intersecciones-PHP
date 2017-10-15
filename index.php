<?php session_start(); ?>

<?php 
	function inicializarData($fil, $col){
		$_SESSION['matrizLogica'] = null;

		for ($i=0; $i < $fil; $i++) { 
			for($j=0; $j < $col; $j++){
				$_SESSION['matrizLogica'][$i][$j] = 0;
			}
		}

		//coordenadas a usar
		$_SESSION['prim_fil'] = 0;
		$_SESSION['prim_col'] = 0;
		$_SESSION['sec_fil'] = 0;
		$_SESSION['sec_col'] = 0;
		
		$_SESSION['color_sel'] = 'blanco';

		$_SESSION['turno_actual'] = -1;
		$_SESSION['val_color'] = 1;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Intersecciones - Inicio</title>
	</head>
	<body>

		<h1>¡Intersecciones MLG!</h1>

		<h2>Ingresa tus datos ;)</h2>

		<form id='form_datos' method="post" accept-charset="utf-8">
			Ingrese su nombre: <br>
			<input type="text" name="nom_jugador"> <br><br>

			Ingrese N filas: <br>
			<input type="text" name="filas_mat"> <br><br>

			Ingrese N columnas: <br>
			<input type="text" name="colum_mat"> <br><br>

			<input type="submit" name="boton_enviar" value="¡Enviar Datos!">

			<?php

				if(isset($_POST['boton_enviar'])){
					if(isset($_POST['nom_jugador'])){
						$_SESSION['nom_jugador'] = $_POST['nom_jugador'];
					}

					if(isset($_POST['filas_mat']) && isset($_POST['colum_mat'])){
						if(($_POST['filas_mat'] > 4 && $_POST['filas_mat'] < 21) && ($_POST['colum_mat'] > 4 && $_POST['colum_mat'] < 21)){
							$_SESSION['filas_mat'] = $_POST['filas_mat'];
							$_SESSION['colum_mat'] = $_POST['colum_mat'];


							inicializarData($_SESSION['filas_mat'], $_SESSION['colum_mat']);

							header("Location: juego.php");
						}
					}
				}

			?>
		</form>

	</body>
</html>