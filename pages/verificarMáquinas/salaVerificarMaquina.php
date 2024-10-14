<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="./salaVerificarMaquina.css">
    <title>LogMaster | Registrar Máquinas</title>
</head>
<body>
<?php 
    require_once("../../conexion.php");
    require_once("../../clases/Metodos.php");
    
    session_start();

    $metodos = new Metodos();
    $maquinas = $metodos->obtenerMaquinas($conn, $_SESSION["sala"]);
    $estudiantes = $metodos->obtenerEstudiantes($conn, $_SESSION["grupo"]);

?>
    
    <?php if(isset($_SESSION["cedula"]) && $_SESSION["rol"] == "docente"):?>
        <header>
            <a href="../../index.php" class="title"><h1>LogMaster <span>for <?= $_SESSION["rol"]?></span></h1></a>
            <nav>
                <ul>
                    <li class="current"><a href="./verificarMaquina.php">Verificar Máquinas</a></li>
                    <li><a href="../salones/salones.php">Reservar salón</a></li>
                    <li><a href="../faltas/faltas.php">Ingresar Falta</a></li>
                    <li><a href="../verFaltas/verFaltas.php">Ver faltas</a></li>
                    <li><a href="../../cerrarSesion.php">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>
    <?php elseif(isset($_SESSION["cedula"]) && $_SESSION["rol"] == "estudiante"):?>
        <header>
            <a href="./index.php" class="title"><h1>LogMaster <span>for <?= $_SESSION["rol"]?></span></h1></a>
            <nav>
                <ul>
                    <li><a href="../verFaltas/verFaltas.php">Ver faltas</a></li>
                    <li><a href="../../cerrarSesion.php">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>

    <?php else:?>
        <?php
                header("Location: ../../login/login.php");    
        ?>
    <?php endif?>

    <main>
        <h2>Verificar máquinas en <?= $_SESSION["sala"]?></h2>
        
        <form action="./salaVerificarMaquina.php" method="post">
           

            <?php for($i=0; $i<count($maquinas); $i++): ?>
            <section class="maquina-utilizada">
                <article class="maquina">
                    <label for="maquina<?=$maquinas[$i]?>">Maquina</label>
                    <select name="maquina<?=$maquinas[$i]?>" required>
                    <?php
                    foreach($maquinas as $maquina){
                        echo "<option value='$maquina'>$maquina</option>";
                    }
                    ?>
                    </select>
                </article>

                <article class="estudiante">
                    <label for="estudiante<?=$i + 1?>">Estudiante</label>
                    <select name="estudiante<?=$i + 1?>" required>
                    <?php
                    foreach($estudiantes as $estudiante){
                        $nombre = $estudiante["nombre"];

                        echo "<option value='$nombre'>$nombre</option>";
                    }
                    ?>
                     <option value="sin utilizar">No fue utilizada</option>
                    </select>
                </article>

                <article class="estado">
                    <label for="estado<?=$i + 1?>">Estado</label>

                    <input type="text" name="estado<?=$i + 1?>" id="estado<?=$i + 1?>">
                </article>
            </section>
            <?php endfor ?>
        
            <button>Enviar</button>
        </form>
    </main>
</body>
</html>

<?php
    $validacion = true;

    if($_POST){
        for($i=0; $i<count($maquinas); $i++){
            $maquina = (int) $_POST["maquina$maquinas[$i]"];
            $estudiante = $_POST["estudiante" . $i+1];
            $estado = $_POST["estado" . $i+1];

            $sala = $_SESSION["sala"];
            $grupo = $_SESSION["grupo"];
            $hora_inicio = $_SESSION["hora_inicio"];
            $hora_final = $_SESSION["hora_final"];

            $validacionRegistro = $metodos->verificarRegistroMaquina($conn, $estudiante, $grupo, $hora_inicio, $hora_final, $maquina, $sala);

            if($validacionRegistro){
                $validacion = $validacion && $metodos->insertarRegistroMaquina($conn, $estudiante, $grupo, $hora_inicio, $hora_final, $estado, $maquina, $sala);
            } 
        }

        if($validacion){
            $sala = $_SESSION["sala"];
            echo "<div class='satisfactorio'>
                    <p>Registro de $sala hecho satisfactoriamente</p>
                  </div>";
        } else {
            $sala = $_SESSION["sala"];
            echo "<div class='error'>
                    <p>Hubo un error al momento de registrar la $sala.</p>
                    <p>Intente nuevamente más tarde.</p>
                  </div>";
        }
    }
?>
