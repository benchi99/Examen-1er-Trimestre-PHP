<!DOCTYPE html5>
<html lang="es_ES">
    <head>
        <meta name="description" content="Añadir contacto a la agenda, confirmación.">
        <meta name="author" content="Rubén Bermejo Romero">
        <meta name="keywords" content="Contactos Agenda Examen">
        <meta charset="UTF-8">
        <title>Agenda - Ejercicio 4</title>
        <style>
            .error {
                color: red;
            }
        </style>
    </head>

    <body>
        <h1>Agenda</h1>
        <?php

            $errores = [];

            function ValorPost($nombre, $valorPorDefecto='') {
                if (isset ($_POST[$nombre])){
                    return $_POST[$nombre];
                } else {
                    return $valorPorDefecto;
                }
            }

            function validaFecha($fecha, $formato = 'd-m-Y') {
                $d = DateTime::createFromFormat($formato, $fecha);
                return $d && $d->format($formato) == $fecha;
            }

            /**
             * Función que te convierte una fecha al formato deseado.
             * 
             * @param fecha La fecha a convertir
             * @param formatoAConvertir Formato en el que se devolverá la fecha.
             * 
             */
            

            function convierteFechaA($fecha, $formatoAConvertir){
                $d = new DateTime($fecha);
                return $d -> format($formatoAConvertir);
            }

            function mostrarFormulario($errores){
                ?>
                <form action="index.php" method="POST">
                    <table>
                        <input type="hidden" name="paso" value="1"/>
                        <tr>
                            <td>Nombre: </td>
                            <td><input type="text" name="nombre" value=<?=ValorPost('nombre')?>></td>
                            <?php if (isset($errores['nombre'])) { ?>
                            <td class="error"><?= $errores['nombre'] ?></td>
                            <?php
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>Fecha de nacimiento: </td>
                            <td><input type="text" name="fechaNac" value=<?=ValorPost('fechaNac')?>></td>
                            <?php if (isset($errores['fechaNac'])) { ?>
                            <td class="error"><?= $errores['fechaNac'] ?></td>
                            <?php
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>Sexo: </td>
                            <td>
                                <input type="radio" name="sexo" value="Hombre">Hombre<br>
                                <input type="radio" name="sexo" value="Mujer"/>Mujer
                            </td>
                            <?php if (isset($errores['sexo'])) { ?>
                            <td class="error"><?= $errores['sexo'] ?></td>
                            <?php
                            }
                            ?>
                        </tr>
                    </table>
                    <input type="submit" name="enviar" value="Guardar contacto"/>
                    <a href="mostrarContactos.php">Ver contactos guardados</a>
                </form>
                <?php
            }

            if (!$_POST) {
                mostrarFormulario($errores);
            } else if ($_POST['paso'] == 1){

                // NOMBRE
                if(empty($_POST["nombre"])) {
                    $errores['nombre'] = "Se requiere nombre";
                } else if (strlen($_POST["nombre"]) <= 3){
                    $errores['nombre'] = "El nombre ha de tener un mínimo de tres caracteres.";
                } else if (!preg_match('/[A-Za-z]+/', $_POST["nombre"])) {
                    $errores['nombre'] = "El nombre contiene números.";
                }

                //FECHA DE NACIMIENTO
                if (empty($_POST["fechaNac"])) {
                    $errores['fechaNac'] = "Se requiere fecha de nacimiento";
                } else if (!validaFecha($_POST["fechaNac"])) {
                    $errores['fechaNac'] = "La fecha establecida es inválida.";
                } else if (!preg_match("/[0-9]{2}\W[0-9]{2}\W[0-9]{4}/", $_POST["fechaNac"])){
                    $errores['fechaNac'] = "La estructura de la fecha es incorrecta. ".$_POST["fechaNac"];
                } else if ($_POST["fechaNac"] > time('d/m/Y')) {
                    $errores['fechaNac'] = "La fecha establecida es antes de la fecha actual.";
                } 

                //SEXO
                if (empty($_POST["sexo"])) {
                    $errores['sexo'] = "Especifique un sexo.";
                }

                if ($errores) {
                    mostrarFormulario($errores);
                } else {

                    $sql = 'INSERT INTO contactos VALUES ("", "'.$_POST['nombre'].'", "'.convierteFechaA($_POST['fechaNac'], 'Y-m-d').'", "'.$_POST['sexo'].'")';

                    $conexionBD = mysqli_connect("localhost", "root", "", "agenda")
                    or die("Ha habido un error al conectar a la base de datos.");

                    if ($conexionBD -> query($sql) == TRUE) {
                        ?>
                            <p>Se ha guardado el contacto <?= $_POST['nombre'] ?></p>
                            <a href="index.php">Introducir más contactos</a> 
                            <a href="mostrarContactos.php">Ver contactos guardados</a>
                        <?php
                    } else {
                        ?>
                            <p>Hubo un error al introducir el contacto en la base de datos: <?= $conexionBD -> error ?></p>
                            <a href="index.php">Introducir más contactos</a> 
                            <a href="mostrarContactos.php">Ver contactos guardados</a>
                        <?php
                    }

                }

            }

        ?>
    </body>
</html>