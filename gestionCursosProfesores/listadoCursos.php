<?php
    include 'scriptsEnlaces/conexion.php';
    include 'scriptsEnlaces/sesionStar.php';

    try {
        $boton = $_POST['boton'];
        if ($boton != "Enviar Inscripcion") {
            $consulta = "select * from cursos where abierto = 1";
            $resultado = $enlace->query($consulta);
            echo "<!DOCTYPE html>";
            echo "<html lang='es'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>Listado de Cursos</title>";
            echo "<link rel='stylesheet' href='css/estilo.css'>";
            echo "</head>";
            echo "<body>";
            echo "<div class='container'>";
            echo "<h1>Cursos Disponibles</h1>";
            echo "<form action='?' method='post'>";
                echo "<table>";
                    echo "<tr><th>Codigo</th><th>Nombre</th><th>Abierto</th><th>NumeroPlazas</th><th>PlazoInscripcion</th><th>Inscribir</th></tr>";
                    while ($fila = $resultado->fetch(PDO::FETCH_NUM)) {
                        echo "<tr>";
                        foreach ($fila as $value) {
                            echo "<td>$value</td>";
                        }
                        echo "<td><input type='checkbox' name='cursos[]' value=$fila[0]></td>";
                        echo "</tr>";
                    }
                echo "</table>";
                echo "<tr>";
                echo "<input type='submit' name='boton' value='Enviar Inscripcion'>";
                echo "<button><a href='index.php'>Volver</a></button>";
            echo "</form>";
            echo "</div>";
            echo "</body>";
            echo "</html>";
        } else {
            $consulta2 = "select * from cursos where abierto = 1";
            $resultado2 = $enlace->query($consulta2);
            $cursos = $_POST['cursos'] ?? [];
            $sesion = $_SESSION['inicioSesion'];
            echo "<!DOCTYPE html>";
            echo "<html lang='es'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
            echo "<title>Listado de Cursos</title>";
            echo "<link rel='stylesheet' href='css/estilo.css'>";
            echo "</head>";
            echo "<body>";
            echo "<div class='container'>";
            echo "<h1>Inscripcion Cursos</h1>";
            echo "<button><a href='listadoCursos.php'>Volver a Inscripciones</a></button>";
            echo "<table>";
                echo "<tr><th>Codigo</th><th>Nombre</th><th>Abierto</th><th>NumeroPlazas</th><th>PlazoInscripcion</th></tr>";
                while ($fila = $resultado2->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    foreach ($fila as $value) {
                        echo "<td>$value</td>";
                    }
                    echo "</tr>";
                }
            echo "</table>";
            echo "<br>";
            if (count($cursos)!=1) {
                echo "<p style='color: red'>No puedes tener inscripcion en mas de 1 curso a la vez o no matricularte</p>";
            } else {
                if (!isset($sesion)) {
                    echo "<p style='color: red'>Debes Iniciar Sesion</p>";
                    header("Location: inicioSesion.php");
                } else {
                    foreach ($cursos as $codigoCurso) {
                        $fecha = date("Y-m-d");
                        $stmt = $enlace->prepare("INSERT INTO solicitudes (dni, codigocurso, fechasolicitud) VALUES (?, ?, ?)");
                        $stmt->bindParam(1, $sesion, PDO::PARAM_STR);
                        $stmt->bindParam(2, $codigoCurso, PDO::PARAM_INT);
                        $stmt->bindParam(3, $fecha, PDO::PARAM_STR);
                        if ($stmt->execute()) {
                            echo "<p style='color: green'>Registro Insertado Correctamente para el curso con código $codigoCurso</p>";
                        } else {
                            echo "<p style='color: red'>Error: No se ha podido insertar el registro para el curso con código $codigoCurso. Detalles:</p>";
                        }
                    }
                }
            }
            echo "<button><a href='index.php'>Volver</a></button>";
            echo "</div>";
            echo "</body>";
            echo "</html>";
        }
    } catch (PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
?>