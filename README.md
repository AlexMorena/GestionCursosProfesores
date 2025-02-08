# 🎓 Gestion de Cursos para Profesores

## 📖 Descripción
**Gestion de Cursos** es una plataforma web que permite la administración y gestión de cursos para profesores. Los administradores pueden agregar, activar, desactivar y eliminar cursos, mientras que los profesores pueden inscribirse y consultar los cursos disponibles. 

## 🚀 Características Principales
✅ Sistema de autenticación de usuarios (inicio y cierre de sesión).  
✅ Gestión de cursos para administradores (crear, eliminar, activar y desactivar cursos).  
✅ Listado de cursos disponibles para usuarios. 
✅ Interfaz sencilla y accesible.  
✅ Utilización de Base de Datos SQL y Servidor Axigen de Correo. 

## 📂 Estructura del Proyecto
```
gestionCursosProfesores/
│── 📜 index.php                # Página principal con autenticación y acceso a funcionalidades
│── 📜 inicioSesion.php         # Página de inicio de sesión
│── 📜 listadoCursos.php        # Listado de cursos disponibles
│── 📜 activarDesactivarCursos.php # Activar y desactivar cursos (Admin)
│── 📜 incorporarCursos.php     # Incorporar nuevos cursos (Admin)
│── 📜 eliminarCursos.php       # Eliminar cursos (Admin)
│── 📜 mostrarAdmitidosPorCurso.php # Mostrar estudiantes admitidos por curso
│── 📜 admitirProfesoresCursos.php  # Asignar profesores a cursos
│── 📂 css/                     # Estilos de la plataforma
│── 📂 scriptsEnlaces/          #Scripts necesarios para la conexion a la base de datos
```

## 🛠️ Instalación
1️⃣ **Clona el repositorio o descarga los archivos**  
```bash
 git clone https://github.com/tu-usuario/GestionCursosProfesores
```
2️⃣ **Configura la base de datos** en `scriptsEnlaces/conexion.php`.   
3️⃣ **Instalar y tener Servidor Axigen de Correo**. 
4️⃣ **Ejecuta el servidor local** con Apache y MySQL (XAMPP, WAMP o similar). 
5️⃣ **Accede a `index.php` desde tu navegador**. 

## 💡 Ejemplo de Uso
- Un administrador inicia sesión y gestiona los cursos.
- Un profesor usuario navega por el listado y se inscribe en un curso disponible.
- Un administrador puede revisar la lista de admitidos a cada curso.

## 🤝 Contribución
Si deseas mejorar este proyecto, revisa el archivo `CONTRIBUIR.md` para más detalles sobre cómo contribuir. 🎉

## 📜 Licencia
Este proyecto es de código abierto y puede ser utilizado libremente para fines educativos. 📚

## 📩 Contacto
Para más información, sugerencias o mejoras, puedes contactarme en **alexmorena2002@gmail.com**. ✉️

🎉 ¡Gracias por usar **Gestión de Cursos para Profesores**! 🚀
