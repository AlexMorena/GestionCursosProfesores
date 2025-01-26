<?php
    include 'scriptsEnlaces/conexion.php';
    include 'scriptsEnlaces/sesionStar.php';

    $inicioSesion = $_SESSION['inicioSesion'];
    $esAdmin = $_SESSION['esAdmin'];

    if (isset($inicioSesion)){

        echo "<!DOCTYPE html>";
        echo "<html lang='es'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Gestion Cursos</title>";
        echo "<link rel='stylesheet' href='css/estilo.css'>";
        echo "</head>";
        echo "<body>";
        echo "<div class='container'>";
            echo "<button><a href='index.php?cerrar_sesion=1'>Cerrar sesion</a></button><br>";
            $cerrar = $_GET['cerrar_sesion'];
            if (isset($cerrar)) {
                $_SESSION=array();
                setcookie('PHPSESSID','',time()-3600);
                session_destroy();
                header("Location: index.php");
            }
            if (!isset($inicioSesion)) {
                header("Location: index.php");
            }
            echo "<h1>Identificado como usuario ".$inicioSesion.", bienvenido</h1>";
            if ($esAdmin==1) {
                echo "<p class='centrar'>Tienes Permisos de Admin</p>";
                echo "<button><a href='activarDesactivarCursos.php'>Desactivar/Activar Cursos</a></button>";
                echo "<button style='margin-left: 10px'><a href='incorporarCursos.php'>Incorporar Cursos</a></button>";
                echo "<button style='margin-left: 10px'><a href='eliminarCursos.php'>Eliminar Cursos</a></button>";
                echo "<button style='margin-left: 10px'><a href='mostrarAdmitidosPorCurso.php'>Mostrar Admitidos Por Cursos</a></button>";
                echo "<button style='margin-left: 10px'><a href='admitirProfesoresCursos.php'>Admitir Cursos</a></button>";
            }
            echo "<p class='centrar'>Puedes ver los cursos que hay disponibles para ti</p>";
            echo "<button><a href='listadoCursos.php'>Ver Listado</a></button>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
        
    } else {

        echo "<!DOCTYPE html>";
        echo "<html lang='es'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Gestion Cursos</title>";
        echo "<link rel='stylesheet' href='css/estilo.css'>";
        echo "</head>";
        echo "<body>";
        echo "<div class='container'>";
            echo "<button><a href='inicioSesion.php'>Iniciar Sesion</a></button>";
            echo "<h1>Gestion de cursos para Profesores</h1>";
            echo "<p>Puedes ver los cursos disponibles ahora mismo para ti</p>";
            echo "<button><a href='listadoCursos.php'>Ver Listado</a></button>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
        
    }
?>