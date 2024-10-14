<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="./faltas.css">
    <title>LogMaster | Ingresar falta</title>
</head>
<body>
    <?php 
    require_once("../../conexion.php");
    require_once("../../clases/Metodos.php");
    $metodos = new Metodos();

    session_start();
    ?>

    <?php if(isset($_SESSION["cedula"]) && $_SESSION["rol"] == "docente"):?>
        <header>
            <a href="../../index.php" class="title"><h1>LogMaster <span>for <?= $_SESSION["rol"]?></span></h1></a>
            <nav>
                <ul>
                    <li><a href="../verificarMáquinas/verificarMaquina.php">Verificar Máquinas</a></li>
                    <li><a href="../salones/salones.php">Reservar salón</a></li>
                    <li class="current"><a href="./faltas.php">Ingresar Falta</a></li>
                    <li><a href="../verFaltas/verFaltas.php">Ver faltas</a></li>
                    <li><a href="../../cerrarSesion.php">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>
    <?php else:?>
        <?php
                header("Location: login/login.php");    
        ?>
    <?php endif?>


    <main>
            <form action="./faltas.php" method="post">
                <label for="cursos">Tus asignaturas</label>
                <select name="cursos" id="cursos" required>
                    <?php 
                    $cursos = $metodos->obtenerCursos($conn, $_SESSION["cedula"]);
                    
                    foreach($cursos as $curso){
                        echo "<option value='$curso'>$curso</option>";
                    }
                    ?>
                </select>

                <label for="grupos">Tus grupos: </label>
                <select name="grupos" id="grupos" required>
                    <?php 
                    $grupos = $metodos->obtenerGrupos($conn, $_SESSION["cedula"]);
                    
                    foreach($grupos as $grupo){
                        echo "<option value='$grupo'>$grupo</option>";
                    }
                    ?>
                </select>

                <label for="justificacion">Justificacion</label>
                <textarea name="justificacion" id="jutificacion" cols="20" rows="10" required></textarea>
                
                <button>Enviar falta</button>
        </form>
        </main>
</body>
</html>

<?php
if($_POST){
$curso = $_POST["cursos"];
$grupo = $_POST["grupos"];
$justificacion = $_POST["justificacion"];

$verificacionCursoYGrupo = $metodos->verificarCursoYGrupo($conn, $grupo, $curso);
$verificacionFechaFalta = $metodos->verificarFechaFalta($conn, $_SESSION["cedula"], $grupo, $curso);

if($verificacionCursoYGrupo === 0){
    echo "
    <div class='error'>
        <p>La asignatura no está asignada a ese grupo.</p>
        <p>Intente nuevamente.</p>
    </div>
    ";
} else {
    if($verificacionFechaFalta === 1){
        echo "
        <div class='error'>
            <p>Ya fue ingresada una falta en $curso para $grupo el día de hoy.</p>
        </div>
        ";
    } else {
        $metodos->ingresarFalta($conn, $_SESSION["cedula"], $curso, $grupo, $justificacion);
        
        echo "
        <div class='satisfactorio'>
            <p>Falta ingresada correctamente.</p>
        </div>
        ";
    }
}
}

/*

*/
?>
