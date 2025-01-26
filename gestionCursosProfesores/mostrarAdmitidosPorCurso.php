<?php
    try{
        include 'scriptsEnlaces/conexion.php';
        include 'scriptsEnlaces/sesionStar.php';
        $boton = $_POST['boton'];

        
        echo "<!DOCTYPE html>";
        echo "<html lang='es'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>ActivarDesactivarCursos</title>";
        echo "<link rel='stylesheet' href='css/estilo.css'>";
        echo "</head>";
        echo "<body>";
        echo "<div class='container'>";
        echo "<h1>Lista Admitidos</h1>";
        if($boton != "mostrar"){
        $consulta = "select nombre from cursos";
        $resultado = $enlace->query($consulta);
        echo "<form action='mostrarAdmitidosPorCurso.php' method='post'>";
                echo "<select name='lista'>";
                foreach ($resultado as $fila){
                    echo "<option value='{$fila['nombre']}'>{$fila['nombre']}</option>";
                }
                echo "</select>";
                echo "<input type='submit' name='boton' value='mostrar'>";
                echo "</form>";
                echo "<tr>";
        }else{
            $nombreCurso = $_POST['lista'];
            $stmt2 = $enlace->prepare("select codigo from cursos where nombre = (?)");
            $stmt2->bindParam(1, $nombreCurso, PDO::PARAM_STR);
            $stmt2->execute();
            $codigo = $stmt2->fetch(PDO::FETCH_ASSOC);
    
            $codigoCurso = $codigo['codigo'];
            $stmt3 = $enlace->prepare("select * from solicitudes where admitido = 1 and codigocurso = (?)");
            $stmt3->bindParam(1, $codigoCurso, PDO::PARAM_INT);
            $stmt3->execute();
    
            if($stmt3->rowCount() > 0){
                echo "<form action='?' method='post'>";
                echo "<table>";
                echo "<tr><th>DNI</th><th>Codigo Curso</th><th>Fecha Solicitud</th><th>Admitido</th></tr>";
                    while ($fila = $stmt3->fetch(PDO::FETCH_NUM)) {
                        echo "<tr>";
                        foreach ($fila as $value) {
                            echo "<td>$value</td>";
                        }
                        echo "</tr>";
                    }
                echo "</form>";
            }else{
                echo "<p style='color: red'>No se han encontrado admitidos para el curso de ".$nombreCurso."</p>";
            }

        }
        echo "<button><a href='index.php'>Volver</a></button>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
    }catch(PDOException $e){
        echo "Error".$e->getMessage();
    }
?>