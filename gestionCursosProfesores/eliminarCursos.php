<?php
include 'scriptsEnlaces/conexion.php';
include 'scriptsEnlaces/sesionStar.php';
$boton = $_POST['boton'];
$contador = 0;


try{
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
            echo "<h1>Eliminar Curso</h1>";
    if($boton != "Eliminar Curso"){
        $consulta = "select nombre from cursos";
        $resultado = $enlace->query($consulta);

        echo "<form action='eliminarCursos.php' method='post'>";
                echo "<select name='lista'>";
                foreach ($resultado as $fila){
                    echo "<option value='{$fila['nombre']}'>{$fila['nombre']}</option>";
                }
                echo "</select>";
                echo "<input type='submit' name='boton' value='Eliminar Curso'>";
                echo "</form>";
                echo "<tr>";
    }else{
        echo "<form action='eliminarCursos.php' method='post'>";
        $nombreCurso = $_POST['lista'];
        $stmt2 = $enlace->prepare("select codigo from cursos where nombre = (?)");
        $stmt2->bindParam(1, $nombreCurso, PDO::PARAM_STR);
        $stmt2->execute();
        $codigo = $stmt2->fetch(PDO::FETCH_ASSOC);

        $codigoCurso = $codigo['codigo'];
        $stmt3 = $enlace->prepare("delete from solicitudes where codigocurso = (?)");
        $stmt3->bindParam(1, $codigoCurso, PDO::PARAM_INT);
        $stmt3->execute();



        $stmt = $enlace->prepare("delete from cursos where codigo = (?)");
        $stmt->bindParam(1, $codigoCurso, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "<p style='color: green'>Curso Eliminado Correctamente</p>";
        } else {
            echo "<p style='color: red'>Error: No se ha podido eliminar el curso</p>";
        }

    }
    echo "</form>";
    echo "<button><a href='index.php'>Volver</a></button>";
    echo "</div>";
    echo "</body>";
    echo "</html>";
}catch(PDOException $e){
    echo "Error".$e->getMessage();
}
?>