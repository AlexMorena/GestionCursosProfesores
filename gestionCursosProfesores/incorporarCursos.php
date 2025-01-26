<?php
    include 'scriptsEnlaces/conexion.php';
    include 'scriptsEnlaces/sesionStar.php';
    $boton = $_POST['boton'];
    $contador = 0;
    
    function pintaValores($tituloInput, $nombreInput){
        echo "$tituloInput: <input type='text' name='$nombreInput'>";
        echo "<br><br>";
    }

    function pintaFechas($tituloInput, $nombreInput){
        echo "$tituloInput: <input type='date' name=$nombreInput>";
        echo "<br><br>";
    }

    function validaVacios($tituloInput, $variable, $nombreInput, &$contadorParam){
        if(!empty($variable)){
            echo "$tituloInput: <input type='text' name='$nombreInput' value='$variable'>";
            echo "<br>";
            echo "<small style='color: green'>Datos Correctos</small>";
            echo "<br>";
            $contadorParam++;
        }else{
            echo "$tituloInput: <input type='text' name='$nombreInput'>";
            echo "<br>";
            echo "<small style='color: red'>Datos Incorrectos</small>";
            echo "<br>";
        }
    }

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
            echo "<h1>Incorporar Curso</h1>";
        if($boton != "Incorporar Curso"){
                echo "<form action='incorporarCursos.php' method='post'>";
                pintaValores("Nombre Curso", "nombreCurso");
                pintaValores("Numero de Plazas", "numeroPlazas");
                pintaFechas("Plazo de inscripcion","plazoInscripcion");
                echo "<input type='submit' name='boton' value='Incorporar Curso'>";
                echo "</form>";
                echo "<tr>";
        }else{
            echo "<form action='incorporarCursos.php' method='post'>";
            $nombreCurso = $_POST['nombreCurso'];
            $numeroPlazas = $_POST['numeroPlazas'];
            $plazoInscripcion = $_POST['plazoInscripcion'];
            $stmt = $enlace->prepare("insert into cursos(nombre,numeroplazas,plazoinscripcion) values(?,?,?)");
            $stmt->bindParam(1, $nombreCurso, PDO::PARAM_STR);
            $stmt->bindParam(2, $numeroPlazas, PDO::PARAM_STR);
            $stmt->bindParam(3, $plazoInscripcion, PDO::PARAM_STR);
            validaVacios("Nombre Curso",$nombreCurso,"nombreCurso",$contador);
            validaVacios("Nombre de Plazas",$numeroPlazas,"numeroPlazas",$contador);
            validaVacios("Plazo de Inscripcion",$plazoInscripcion,"plazoInscripcion",$contador);
            if ($stmt->execute()) {
                echo "<p style='color: green'>Curso Insertado Correctamente</p>";
            } else {
                echo "<p style='color: red'>Error: No se ha podido insertar el curso</p>";
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