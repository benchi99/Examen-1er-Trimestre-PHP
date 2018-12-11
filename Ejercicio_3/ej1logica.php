<!DOCTYPE html5>
<html lang="es_ES">
    <head>
        <meta name="description" content="logica">
        <meta name="author" content="Rubén Bermejo Romero">
        <meta name="keywords" content="sql procesarlotodo">
        <meta charset="UTF-8">
        <title>Actividad 1</title>
    </head>

    <?php 
    switch ($_GET['opt']) {
        case 'todos':
            $sql = "select * from paises";        
            break;
        case 'europa':
            $sql = "select * from paises where continente = 'Europa'";        
            break;
        case 'nomoneda':
            $sql = "select * from paises where iso_moneda is null";        
            break;
    }

    $conexionDB = mysqli_connect("localhost", "root", "", "paises");
    mysqli_set_charset($conexionDB, "utf8");
    
    if (!$conexionDB){
        die("No pudo hacerse la conexión al servidor.");
    }
    $consulta = mysqli_query($conexionDB, $sql);
    $numeroFilas = $consulta -> num_rows;

    ?>
    <body>
        <table border="1" align="center">
            <tr>
                <td>Nombre</td>
                <td>Iso3</td>
                <td>Continente</td>
                <td>Nombre de moneda</td>
            </tr>
        <?php 
            $i = 0;
            while($registro = mysqli_fetch_array($consulta)) { ?>
                <tr>
                <td><?=$registro['nombre']?></td>
                <td><?=$registro['iso3']?></td>
                <td><?=$registro['continente']?></td>
                <td><?=$registro['nombre_moneda']?></td>
                </tr>
        <?php 

                if ($i == 0) {
                    $nombrePrimerPais = $registro['nombre'];
                } else if ($i == $numeroFilas - 1) {
                    $nombreUltimoPais = $registro['nombre'];
                }
                $i = $i + 1;
            }
        ?>
        </table>
            <p>El listado consta de <?=$numeroFilas?> país(es) donde <?= $nombrePrimerPais ?> es el primero, y <?= $nombreUltimoPais ?> es el último.</p>
    </body>
</html>