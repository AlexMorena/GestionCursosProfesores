<?php
    include 'scriptsEnlaces/conexion.php';
    include 'scriptsEnlaces/sesionStar.php';

    try {
        $boton = $_POST['boton'];
        
        if ($boton != "enviar") {
            $stmt = $enlace->prepare("select codigo from cursos");
            $stmt->execute();
            echo "<!DOCTYPE html>";
            echo "<html lang='es'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>VerListado</title>";
            echo "<link rel='stylesheet' href='css/estilo.css'>";
            echo "</head>";
            echo "<body>";
            echo "<div class='container'>";
            echo "<h1>Admitir Cursos</h1>";
                echo "<form action='?' method='post'>";
                echo "<table>";
                    echo "<tr><th>Codigo</th><th>Enviar</th></tr>";
                    while ($fila = $stmt->fetch(PDO::FETCH_NUM)) {
                        echo "<tr>";
                        foreach ($fila as $datos) {
                            echo "<td>$datos</td>";
                        }
                        echo "<td><input type='checkbox' name='cursos[]' value=$fila[0]></td>";
                        echo "</tr>";
                    }
                echo "</table>";
                echo "<input type='submit' name='boton' value='enviar'>";
                echo "<button><a href='index.php'>Volver</a></button>";
                echo "</form>";
            echo "</div>";
            echo "</body>";
            echo "</html>";
        } else {
            echo "<!DOCTYPE html>";
            echo "<html lang='es'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>VerListado</title>";
            echo "<link rel='stylesheet' href='css/estilo.css'>";
            echo "</head>";
            echo "<body>";
            echo "<div class='container'>";
            echo "<h1>Admitir Cursos</h1>";
            $cursos = $_POST['cursos'] ?? [];
            $stmt2 = $enlace->prepare("select cursos.codigo, cursos.numeroplazas, solicitantes.dni, solicitantes.puntos, solicitudes.admitido from cursos
                inner join solicitudes on cursos.codigo=solicitudes.codigocurso inner join solicitantes on solicitantes.dni=solicitudes.dni where cursos.codigo = (?)
                    group by cursos.codigo, solicitantes.dni order by solicitantes.puntos desc");
            $stmt2->bindParam(1, $cursos[0], PDO::PARAM_INT);
            $stmt2->execute();
            while ($fila2 = $stmt2->fetch(PDO::FETCH_NUM)) {
                if ($fila2[4]==0) {
                    $smt = $enlace->prepare("update solicitudes set admitido = admitido+1 where dni = (?) and codigocurso = (?)");
                    $smt->bindParam(1, $fila2[2], PDO::PARAM_STR);
                    $smt->bindParam(2, $fila2[0], PDO::PARAM_INT);
                    $smt->execute();
                    $smt2 = $enlace->prepare("update cursos set numeroplazas=numeroplazas-1 where codigo = (?)");
                    $smt2->bindParam(1, $fila2[0], PDO::PARAM_STR);
                    $smt2->execute();
                }
            }
            echo "<p style='color: green'>Curso ".$cursos[0]." abierto</p>";
            echo "<button><a href='index.php'>Volver</a></button>";
            echo "</div>";
            echo "</body>";
            echo "</html>";
        }
    } catch (PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
?>