<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./login.css">
    <title>LogMaster | Login</title>
</head>
<body>
    <header>
        <h1>Login</h1>
    </header>

    <main>
        <form action="login.php" method="post">
            <label for="cedula">Cédula</label>
            <input type="number" placeholder="423321452" name="cedula" id="cedula" required>

            <label for="contraseña">Contraseña</label>
            <input type="password" placeholder="**********" name="contrasena" id="contrasena" required>

            <section>
               <article>
                    <label for="estudiante">Estudiante</label>
                    <input type="radio" name="rol" id="estudiante" value="estudiante" checked/>
               </article>

                <article>
                    <label for="docente">Docente</label>
                    <input type="radio" name="rol" id="docente" value="docente"/>
                </article>
            </section>

            <button>Ingresar</button>
        </form>

        <section class="registrate">
            <article>
                <p>¿Sos estudiante y no tenes cuenta?</p>
                <a href="../register/registerEstudiante.php">Registrate</a>
            </article>

            <article>
                <p>¿Sos docente y no tenes cuenta?</p>
                <a href="../register/registerDocente.php">Registrate</a>
            </article>
        </section>
    </main>

</body>
</html>

<?php
require_once("../conexion.php");
require_once("../clases/Metodos.php");


if($_POST){
    $cedula = $_POST["cedula"];
    $contrasena = $_POST["contrasena"];
    $rol = $_POST["rol"];
    $metodos = new Metodos();

    if($rol == "estudiante"){
        $verified = $metodos->verificarEstudiante($conn, $cedula, $contrasena);
        
        if($verified == false){
            echo "
            <div class='error'>
                <p>Las credenciales de estudiante son incorrectas.</p>
            </div>
            ";
        } else {
            $resultado = $metodos->obtenerEstudiante($conn, $cedula);
            
            session_start();
            $_SESSION["cedula"] = $cedula;
            $_SESSION["nombre"] = $resultado["nombre"];
            $_SESSION["apellido"] = $resultado["apellido"];
            $_SESSION["email"] = $resultado["email"];
            $_SESSION["rol"] = $rol;

            header("Location: ../index.php");
        }

    } else {
        $verified = $metodos->verificarDocente($conn, $cedula, $contrasena);

        if($verified == false){
            echo "
            <div class='error'>
                <p>Las credenciales de docente son incorrectas.</p>
                <p>Intente nuevamente.</p>
            </div>
            ";
        } else {
            $resultado = $metodos->obtenerDocente($conn, $cedula);
            
            session_start();
            $_SESSION["cedula"] = $cedula;
            $_SESSION["nombre"] = $resultado["nombre"];
            $_SESSION["apellido"] = $resultado["apellido"];
            $_SESSION["email"] = $resultado["email"];
            $_SESSION["rol"] = $rol;

            header("Location: ../index.php");
        }
    }
}
?>