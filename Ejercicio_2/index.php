<!DOCTYPE html5>
<html lang="es_ES">
	<head>
		<meta name="description" content="Actividad 2.1">
		<meta name="author" content="Rubén Bermejo Romero">
		<meta name="keywords" content="Actividad 2.1">
		<meta charset="UTF-8">
		<title>Actividad 2.1</title>
		<style>
    	    .error {
    		      color: red;
    		}
		</style>
	</head>

	<?php 
	function ValorPost($nombre, $valorPorDefecto='') {
	    if (isset ($_POST[$nombre])){
	        return $_POST[$nombre];
	    } else {
	        return $valorPorDefecto;
	    }
	}
	
	?>

	<body>
		<h1>Tabla operaciones aritméticas (Pantalla 1)</h1>
		<form action="ejercicio21log.php" method="POST">
    		<p>Operación a realizar:<select name="op">
    									<option value="nada"></option>
    									<option value="sumar">Sumar</option>
    									<option value="restar">Restar</option>
    									<option value="multip">Multiplicar</option>
    									<option value="dividi">Dividir</option>
    								</select>
    		</p>
    		<?php if (isset($errores['op'])){
    		    echo '<p class="error">'.$errores['op'].'</p>';
    		}?>
    		<p>Numero de la tabla: <input type="text" name="numeroTabla" value=<?php ValorPost("numeroTabla")?>></p>
    		<?php if (isset($errores['numeroTabla'])) {
    		    echo '<p class="error">'.$errores['numeroTabla'].'</p>';   
    		}?>
    		<input type="submit" name="enviar" value="Mostrar tabla"/>
		</form>
	</body>

</html>


