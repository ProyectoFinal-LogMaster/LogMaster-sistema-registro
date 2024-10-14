<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="./verFaltas.css">
    <title>LogMaster | Ver faltas</title>
</head>
<body>
    <?php 
    require_once("../../conexion.php");
    require_once("../../clases/Metodos.php");
    $metodos = new Metodos();
    $faltas = $metodos->obtenerFaltas($conn);

    session_start();
    ?>
    
    <?php if(isset($_SESSION["cedula"]) && $_SESSION["rol"] == "docente"):?>
        <header>
            <a href="../../index.php" class="title"><h1>LogMaster <span>for <?= $_SESSION["rol"]?></span></h1></a>
            <nav>
                <ul>
                    <li><a href="../salones/salones.php">Reservar salón</a></li>
                    <li><a href="../faltas/faltas.php">Ingresar Falta</a></li>
                    <li><a href="../verificarMáquinas/verificarMaquina.php">Verificar Máquinas</a></li>
                    <li class="current"><a href="./verFaltas.php">Ver faltas</a></li>
                    <li><a href="../../cerrarSesion.php">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>
    <?php elseif(isset($_SESSION["cedula"]) && $_SESSION["rol"] == "estudiante"):?>
        <header>
            <a href="../../index.php" class="title"><h1>LogMaster <span>for <?= $_SESSION["rol"]?></span></h1></a>
            <nav>
                <ul>
                    <li class="current"><a href="./verFaltas.php">Ver faltas</a></li>
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
        <div class="faltas">
            <?php foreach($faltas as $falta): ?>
                <section class="falta">
                    <article class="texto">
                        <div class="curso">
                            <h2><?= $falta["curso"]?>, <span><?= $falta["grupo"]?></span></h2>
                        </div>
                        <p>No asiste para el día <?= $falta["fecha"]?></p>
                    </article>

                    <button class="ver-mas-btn">Ver más</button>

                    <article class="justificacion">
                        <p><span>Justificación: </span> <?= $falta["justificacion"] ?></p>
                    </article>
                </section>
            <?php endforeach ?>
        </div>
        </main>
    <script src="./script.js"></script>
</body>
</html>


