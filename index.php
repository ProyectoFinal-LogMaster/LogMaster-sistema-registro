<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <title>LogMaster</title>
</head>
<body>
    <?php session_start()?>
    
    <?php if(isset($_SESSION["cedula"]) && $_SESSION["rol"] == "docente"):?>
        <header>
            <a href="./index.php" class="title"><h1>LogMaster <span>for <?= $_SESSION["rol"]?></span></h1></a>
            <nav>
                <ul>
                    <li><a href="./pages/verificarMáquinas/verificarMaquina.php">Verificar Máquinas</a></li>
                    <li><a href="./pages/salones/salones.php">Reservar salón</a></li>
                    <li><a href="./pages/faltas/faltas.php">Ingresar Falta</a></li>
                    <li><a href="./pages/verFaltas/verFaltas.php">Ver faltas</a></li>
                    <li><a href="cerrarSesion.php">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>
    <?php elseif(isset($_SESSION["cedula"]) && $_SESSION["rol"] == "estudiante"):?>
        <header>
            <a href="./index.php" class="title"><h1>LogMaster <span>for <?= $_SESSION["rol"]?></span></h1></a>
            <nav>
                <ul>
                    <li><a href="./pages/verFaltas/verFaltas.php">Ver faltas</a></li>
                    <li><a href="cerrarSesion.php">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>

    <?php else:?>
        <?php
                header("Location: login/login.php");    
        ?>
    <?php endif?>
</body>
</html>