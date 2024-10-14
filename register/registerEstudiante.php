<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./register.css">
    <title>LogMaster | Register</title>
</head>
<body>
    <header>
        <h1>Registro estudiante</h1>
    </header>

    <main>
        <section class="login">
            <article>
                <p>¿Ya tenés cuenta?</p>
                <a href="../login/login.php">Logueate</a>
            </article>
        </section>

        <form action="registerEstudiante.php" method="post">
            <label for="cedula">Cédula</label>
            <input type="number" placeholder="423321452" name="cedula" id="cedula" required>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Carlos" name="nombre" id="nombre" required>

            <label for="apellido">Apellido</label>
            <input type="text" placeholder="Gutiérrez" name="apellido" id="apellido" required>

            <label for="email">Email</label>
            <input type="email" placeholder="carlos@gmail.com" name="email" id="email" required>

            <label for="direccion">Dirección (opcional)</label>
            <input type="text" placeholder="..." name="direccion" id="direccion" value=" ">
            
            <label for="barrio">Barrio</label>
            <input type="text" placeholder="Colón" name="barrio" id="barrio" required>


            <label for="contraseña">Contraseña</label>
            <input type="password" placeholder="**********" name="contrasena" id="contrasena" required>

            <label for="repetir_contraseña">Repetir Contraseña</label>
            <input type="password" placeholder="**********" name="repetir_contrasena" id="repetir_contraseña" required>

            <button>Crear Usuario</button>
        </form>
    </main>

</body>
</html>

<?php
require_once("../conexion.php");
require_once("../clases/Metodos.php");

if($_POST){
    $cedula = $_POST["cedula"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $email = $_POST["email"];
    $direccion = $_POST["direccion"];
    $barrio = $_POST["barrio"];
    $contrasena = $_POST["contrasena"];
    $repetir_contrasena = $_POST["repetir_contrasena"];

    if($contrasena === $repetir_contrasena){
        $metodos = new Metodos();
        $verificacionEstudiante = $metodos->verificarEstudianteAntesDeInsercion($conn, $cedula);

        if($verificacionEstudiante>0){
            echo "
            <div class='error'>
                <p>Ya existe un estudiante con estas credenciales.</p>
            </div>
            ";
        } else {
            $metodos->insertarEstudiante($conn, $cedula, $nombre, $apellido, $email, $direccion, $barrio, $contrasena);

            session_start();
            $_SESSION["cedula"] = $cedula;
            $_SESSION["nombre"] = $nombre;
            $_SESSION["apellido"] = $apellido;
            $_SESSION["email"] = $email;
            $_SESSION["rol"] = "estudiante";

            header("Location: ../index.php");
        }
    } else {
        echo "
            <div class='error'>
                <p>Las contraseñas no son iguales.</p>
            </div>
            ";
    }
}
?>