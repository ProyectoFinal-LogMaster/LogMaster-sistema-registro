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
        <h1>Registro docente</h1>
    </header>

    <main>
        <section class="login">
            <article>
                <p>¿Ya tenés cuenta?</p>
                <a href="../login/login.php">Logueate</a>
            </article>
        </section>

        <form action="registerDocente.php" method="post">
            <label for="cedula">Cédula</label>
            <input type="number" placeholder="423321452" name="cedula" id="cedula" required>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Carlos" name="nombre" id="nombre" required>

            <label for="apellido">Apellido</label>
            <input type="text" placeholder="Villanueva" name="apellido" id="apellido" required>

            <label for="email">Email</label>
            <input type="email" placeholder="carlos@gmail.com" name="email" id="email" required>

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
    $contrasena = $_POST["contrasena"];
    $repetir_contrasena = $_POST["repetir_contrasena"];

    if($contrasena === $repetir_contrasena){
        $metodos = new Metodos();
        $verificarDocente = $metodos->verificarEstudianteAntesDeInsercion($conn, $cedula);

        if($verificarDocente > 0){
            echo "
            <div class='error'>
                <p>Ya existe un docente con estas credenciales.</p>
            </div>
            ";
        } else {
            $metodos -> insertarDocente($conn, $cedula, $nombre, $apellido, $email, $contrasena);

            session_start();
            $_SESSION["cedula"] = $cedula;
            $_SESSION["nombre"] = $nombre;
            $_SESSION["apellido"] = $apellido;
            $_SESSION["email"] = $email;
            $_SESSION["rol"] = "docente";
    
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