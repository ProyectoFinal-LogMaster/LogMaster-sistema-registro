<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../styles.css">
    <link rel="stylesheet" href="./verificarMaquina.css">
    <title>LogMaster | Registrar Máquinas</title>
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
                    <li class="current"><a href="./verificarMaquina.php">Verificar Máquinas</a></li>
                    <li><a href="../salones/salones.php">Reservar salón</a></li>
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
    <form action="./verificarMaquina.php" method='post'>
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

            <button>Verificar reserva</button>
    </main>
</body>
</html>

<?php
    if($_POST){
        $sala = $_POST["salas"];
        $hora_inicio = $_POST["hora-inicio"];
        $hora_final = $_POST["hora-final"];
        $grupo = $_POST["grupos"];
        $cedula = $_SESSION["cedula"];

        $verificacion_sala = $metodos->verificarReservaSalaMaquina($conn, $cedula, $sala, $grupo, $hora_inicio, $hora_final);
        
        if(!$verificacion_sala){
            echo "<div class='error'>
                    <p>No hay reserva para los datos especificados.</p>
                  </div>";
        } else {
            $_SESSION["sala"] = $sala;
            $_SESSION["grupo"] = $grupo;
            $_SESSION["hora_inicio"] = $hora_inicio;
            $_SESSION["hora_final"] = $hora_final;
            header('Location: salaVerificarMaquina.php');
        }
        
    }
?>
