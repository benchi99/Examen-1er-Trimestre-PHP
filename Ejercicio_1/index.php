<!DOCTYPE html5>
<html lang="es_ES">
	<head>
		<meta name="description" content="descripción de la web">
		<meta name="author" content="Rubén Bermejo Romero">
		<meta name="keywords" content="palabras clave">
		<meta charset="UTF-8">
		<title>Ejercicio 1</title>
		<link rel="icon" type="image/png" href="favicon.png">
		<style>
			body {
				text-align: center;
			}
			.error {
			    color: red;
		    }
		</style>
	</head>

	<body>
	
	<?php 
	function ValorPost($nombre, $valorPorDefecto='') {
	    if (isset ($_POST[$nombre])){
	        return $_POST[$nombre];
	    } else {
	        return $valorPorDefecto;
	    }
	}
	?>
		
		<h1>Datos empleado</h1>
		<form action="ejercicio1_logica.php" method="POST">
			<table align="center">
				<tr>
					<td>Nombre: </td>
					<td><input type="text" name="nombre" value=<?=ValorPost("nombre")?>></td>
					<?php if (isset($errores['nombre'])) {
					    echo '<td class="error">'.$errores['nombre'].'</td>';
					}?>
				</tr>

				<tr>
					<td>Apellidos: </td>
					<td><input type="text" name="apellidos" value=<?=ValorPost("apellidos")?>></td>
					<?php if (isset($errores['apellidos'])) {
					    echo '<td class="error">'.$errores['apellidos'].'</td>';
					}?>
				</tr>

				<tr>
					<td>Fecha de nacimiento: </td>
					<td><input type="text" name="fechanac" value=<?=ValorPost("fechanac")?>></td>
					<?php if (isset($errores['fechanac'])) {
					    echo '<td class="error">'.$errores['fechanac'].'</td>';
					}?>
				</tr>

				<tr>
					<td>Sueldo: </td>
					<td><input type="text" name="sueldo" value=<?=ValorPost("sueldo")?>></td>
					<?php if (isset($errores['sueldo'])) {
					    echo '<td class="error">'.$errores['sueldo'].'</td>';
					}?>
				</tr>

				<tr>
					<td>Categoría: </td>
					<td>
						<select name="cat">
							<option value="Peon">Peón</option>
							<option value="Oficial">Oficial</option>
							<option value="JefeDepartamento">Jefe de Departamento</option>
							<option value="Director">Director</option>
						</select>
					</td>
					<?php if (isset($errores['cat'])) {
					    echo '<td class="error">'.$errores['cat'].'</td>';
					}?>
				</tr>

				<tr>
					<td>Sexo: </td>
					<td>
						<input type="radio" name="sexo" value="Hombre"/>Hombre<br>
						<input type="radio" name="sexo" value="Mujer"/>Mujer
					</td>
					<?php if (isset($errores['sexo'])) {
					    echo '<td class="error">'.$errores['sexo'].'</td>';
					}?>
				</tr>

				<tr>
					<td colspan="2">Aficiones: </td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="checkbox" name="aficion[]" value="Deporte">Deporte
						<input type="checkbox" name="aficion[]" value="Lectura">Lectura
						<input type="checkbox" name="aficion[]" value="Musica">Música
						<input type="checkbox" name="aficion[]" value="Cine">Cine
						<input type="checkbox" name="aficion[]" value="Idiomas">Idiomas
					</td>
					<?php if (isset($errores['aficion'])) {
						echo '<td class="error">'.$errores['aficion'].'</td>';
					}?>
				</tr>
			</table>
			<br>
			<input type="submit" name="enviar" value="Guardar datos">
		</form>
	</body>

</html>