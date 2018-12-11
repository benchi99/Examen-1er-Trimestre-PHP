<!DOCTYPE html5>
<html lang="es_ES">
    <head>
        <meta name="description" content="Mostrar todos los contactos en la Base de Datos">
        <meta name="author" content="Rubén Bermejo Romero">
        <meta name="keywords" content="mostrar sql">
        <meta charset="UTF-8">
        <title>Mostrando contactos</title>
    </head>

    <body>
        <h1>Agenda Contactos</h1>

        <table>
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Fecha Nacimiento</td>
                <td>Sexo</td>
            </tr>
            <?php

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

            $sql = "SELECT * FROM contactos";

            $conexionBD = mysqli_connect("localhost", "root", "", "agenda")
            or die("Hubo un error al intentar conectar con la base de datos.");

            $consulta = mysqli_query($conexionBD, $sql);

            if ($consulta -> num_rows > 0) {
                while ($fila = $consulta -> fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?=$fila['id']?></td>
                            <td><?=$fila['nombre']?></td>
                            <td><?=convierteFechaA($fila['fecha_nac'], 'd-m-Y')?></td>
                            <td><?=$fila['sexo']?></td>
                        </tr>
                    <?php
                }
            } 
            ?>

        </table>    
        <a href="index.php">Introducir más contactos</a>
    </body>
</html>