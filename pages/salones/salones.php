<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="./salones.css">
    <title>LogMaster | Reservar salón</title>
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
                    <li class="current"><a href="./salones.php">Reservar salón</a></li>
                    <li><a href="../faltas/faltas.php">Ingresar Falta</a></li>
                    <li><a href="../verFaltas/verFaltas.php">Ver faltas</a></li>
                    <li><a href="../../cerrarSesion.php">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>
        
    <?php elseif($_SESSION["rol"] == "estudiante"):?>
        <?php
            header("Location: ../../index.php");    
        ?>   
    <?php else:?>
        <?php
            header("Location: ../../login/login.php");    
        ?>
    <?php endif?>

    <main>
        <form action="./salones.php" method='post'>
            <label for="salas"> Seleccione sala</label>
            <select name="salas" id="salas" required>
                <?php 
                $salas = $metodos->obtenerSalas($conn);

                foreach($salas as $sala){
                    echo "<option value='$sala'>$sala</option>";
                }
                ?>
            </select>

            <label for="grupos">Seleccione grupo</label>
            <select name="grupos" id="grupos" required>
                <?php 
                $grupos = $metodos->obtenerGrupos($conn, $_SESSION["cedula"]);
                
                foreach($grupos as $grupo){
                    echo "<option value='$grupo'>$grupo</option>";
                }
                ?>
            </select>

            <section class="hora">
                <article class="hora-comienzo">
                    <label for="hora-inicio">Hora inicial</label>
                    <input type="time" name="hora-inicio" id="hora-inicio" required>
                </article>

                <article class="hora-final">
                <label for="hora-final">Hora final</label>
                <input type="time" name="hora-final" id="hora-final" required>
                </article>
            </section>

            <button>Reservar</button>
        </form>
    </main>
</body>
</html>

<?php

if($_POST){
    $sala = $_POST["salas"];
    $grupo = $_POST["grupos"];
    $hora_inicio = $_POST["hora-inicio"];
    $hora_fin = $_POST["hora-final"];

    $verificacion = $metodos->verificarReservaSala($conn, $sala, $hora_inicio, $hora_fin);

    if(($hora_inicio >= "23:30" || $hora_inicio <= "07:00") || ($hora_fin > "23:30" || $hora_fin < "07:00")){
        echo "<div class='error'>
                <p>Horario incorrecto</p>
             </div>";
    } else {
        if($verificacion["verificacion"]){
            $metodos->insertarReservaSala($conn, $sala, $_SESSION["cedula"], $grupo, $hora_inicio, $hora_fin);
            echo "<div class='satisfactorio'>
                    <p>Sala reservada correctamente.</p>
                  </div>";
        }  else{
            $hora_final_sala = $verificacion["hora_final"];
            echo "<div class='error'>
                    <p>Ya hay una reserva para ese horario.</p>
                    <p>La sala se librará a las $hora_final_sala</p>
                  </div>";
        
        }
    }
}
?>