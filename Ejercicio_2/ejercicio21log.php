<!DOCTYPE html5>
<html lang="es_ES">
	<head>
		<meta name="description" content="Actividad 2.1">
		<meta name="author" content="Rubén Bermejo Romero">
		<meta name="keywords" content="Actividad 2.1">
		<meta charset="UTF-8">
		<title>Actividad 2.1</title>
	</head>

<?php

    $errores = [];

    if (!$_POST){
        
     include "index.php";
     
    } else {
        
        if (empty($_POST['numeroTabla'])) {
            $errores['numeroTabla'] = "No se ha especificado un número.";
        } else if (!preg_match("/[0-9]+/", $_POST['numeroTabla'])){
            $errores['numeroTabla'] = "No se ha especificado un número.";
        } else if ($_POST['numeroTabla'] < 15 || $_POST['numeroTabla'] > 20){
            $errores['numeroTabla'] = "Solo se pueden generar tablas en el rango entre 15 y 20.";
        }
        
        if($_POST['op'] == "nada") {    
            $errores['op'] = "Especifique una operación.";
        }
        
        if ($errores) {
            include "index.php";
        } else {
            switch ($_POST['op']){
                case "sumar":
                    echo "<h1>Operación a realizar: suma</h1>";
                    for ($i = 0; $i <= 10; $i++) {
                        echo "<p>".$_POST['numeroTabla']." + ".$i." = ".($i+(int)$_POST['numeroTabla']);
                    }
                    break;
                case "restar":
                    echo "<h1>Operación a realizar: resta</h1>";
                    for ($i = 0; $i <= 10; $i++) {
                        echo "<p>".$_POST['numeroTabla']." - ".$i." = ".($i-(int)$_POST['numeroTabla']);
                    }
                    break;
                case "multip":
                    echo "<h1>Operación a realizar: multiplicación</h1>";
                    for ($i = 0; $i <= 10; $i++) {
                        echo "<p>".$_POST['numeroTabla']." x ".$i." = ".($i*(int)$_POST['numeroTabla']);
                    }
                    break;
                case "dividi":
                    echo "<h1>Operación a realizar: dividir</h1>";
                    for ($i = 0; $i <= 10; $i++) {
                        echo "<p>".$_POST['numeroTabla']." / ".$i." = ".($i/(int)$_POST['numeroTabla']);
                    }
                    break;  
            }
            echo '<br><a href="index.php">Volver a crear una tabla</a>';   
            
        }
    }
   
   

?>
</html>