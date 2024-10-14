<?php
// require_once("../conexion.php");

class Metodos{
    public function __construct(){}

    // Verifica si el estudiante existe o no existe (se verifica antes de hacer el registro)
    public function verificarEstudianteAntesDeInsercion($conn, $cedula){
        $sql = "SELECT * FROM estudiante WHERE ci='$cedula'";
        $result = $conn->query($sql);

        return $result->num_rows;
    }

    // Verifica si el docente existe o no existe (se verifica antes de hacer el registro)
    public function verificarDocenteAntesDeInsercion($conn, $cedula){
        $sql = "SELECT * FROM docente WHERE ci='$cedula'";
        $result = $conn->query($sql);

        return $result->num_rows;

    }

    // Verifica si el estudiante existe o no existe bajo el criterio
    // pasado por parámetros
    public function verificarEstudiante($conn, $cedula, $contraseña){
        $verified = false;
        $sql = "SELECT * FROM estudiante WHERE ci='$cedula'";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()){
            $password = $row["password"];
            $password_verified = password_verify($contraseña, $password);

            if($password_verified){
                $verified = true;
            }
        }

        return $verified;
    }

    // Verifica si el docente existe o no existe bajo el criterio
    // pasado por parámetros
    public function verificarDocente($conn, $cedula, $contraseña){
        $verified = false;
        $sql = "SELECT * FROM docente WHERE ci='$cedula'";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()){
            $password = $row["password"];
            $password_verified = password_verify($contraseña, $password);

            if($password_verified){
                $verified = true;
            }
        }

        return $verified;

    }

    // Insertar estudiante dentro de la base de datos.
    public function insertarEstudiante($conn, $cedula, $nombre, $email, $direccion, $barrio, $password){
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO estudiante(ci, nombre , email, direccion, barrio, password)
                VALUES('$cedula', '$nombre', '$email', '$direccion', '$barrio', '$password_hash')
        ";
        $result = $conn->query($sql);

        if($conn->error){
            echo "There was an error: $conn->error";
        }
        
    }

    // Insertar docente dentro de la base de datos.
    public function insertarDocente($conn, $ci, $nombre, $apellido, $email, $password){
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO docente(ci, nombre, apellido, email, password)
                VALUES('$ci', '$nombre', '$apellido', '$email', '$password_hash')";
        $result = $conn->query($sql);

        if($conn->error){
            echo "There was an error: $conn->error";
        }
    }

    // Obtener docente en base a su cedula
    public function obtenerDocente($conn, $ci){
        $nombre = "";
        $apellido = "";
        $email = "";

        $sql = "SELECT * FROM docente WHERE ci='$ci' LIMIT 1";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()){
            $nombre = $row["nombre"];
            $apellido = $row["apellido"];
            $email = $row["email"];
        }

        return [
            "nombre" => $nombre,
            "apellido" => $apellido,
            "email" => $email
        ];
    }

    // Obtener estudiante en base a su cedula
    public function obtenerEstudiante($conn, $ci){
        $nombre = "";
        $email = "";
        
        $sql = "SELECT * FROM estudiante WHERE ci='$ci'";
        $result = $conn->query($sql);


        while($row = $result->fetch_assoc()){
            $nombre = $row["nombre"];
            $email = $row["email"];
        }

        return [
            "nombre" => $nombre,
            "email" => $email
        ];
    }

    // Obtener estudiantes en base a su grupo
    public function obtenerEstudiantes($conn, $grupo){
        $estudiantes = [];
        $sql = "SELECT e.nombre FROM estudiante AS e
                JOIN pertenece AS p
                ON e.ci = p.ciEstudiante
                WHERE p.codigoGrupo='$grupo'";

        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()){
           $estudiantes[] = ["nombre" => $row["nombre"]];
        }

        return $estudiantes;
    }

    // Obtener cedula de estudiante en base a su nombre y grupo.
    private function obtenerCedulaEstudiante($conn, $nombre_estudiante, $grupo){
        $ciEstudiante = "";

        $sqlCedulaEstudiante = "SELECT e.ci, e.nombre FROM estudiante AS e
        JOIN pertenece AS p
        ON e.ci = p.ciEstudiante
        WHERE p.codigoGrupo = '$grupo' AND
              e.nombre='$nombre_estudiante'";


        $result = $conn->query($sqlCedulaEstudiante);

        if(!($nombre_estudiante == 'Sin utilizar')){
            while($row = $result->fetch_assoc()){
                $ciEstudiante = $row["ci"];
            }
        }
        
        return $ciEstudiante;
    }

    // Obtener cursos dictados por un docente en particular (se pasa la cedula por parametros)
    public function obtenerCursos($conn, $ci){
        $cursos = [];
        $sql = "SELECT * FROM curso WHERE ci_docente_curso='$ci'";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()){
            $cursos[] = $row["nombre_curso"];
        }

        return array_unique($cursos);
    }

    // Obtener grupos en los que el docente dicta cursos (se pasa la cedula por parametros)
    public function obtenerGrupos($conn, $ci){
        $grupos = [];
        $sql = "SELECT * FROM curso WHERE ci_docente_curso='$ci'";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()){
            $grupos[] = $row["grupo_curso"];
        }

        return array_unique($grupos);
    }

    // Verifica si el curso (asignatura) ingresado es parte de un grupo
    public function verificarCursoYGrupo($conn, $grupo, $curso){
        $sql = "SELECT * FROM curso WHERE nombre_curso='$curso' AND grupo_curso='$grupo'";
        $result = $conn->query($sql);

        return $result->num_rows;
    }

    // Verifica si la falta ya fue ingresada previamente.
    // Se verifica si ya existe un registro con la misma cedula, grupo, curso y fecha.
    public function verificarFechaFalta($conn, $ci, $grupo, $curso){
        $fecha = date("Y-m-d");
        $sql = "SELECT * FROM falta_docente 
                WHERE cedula_docente_falta_docente='$ci'
                      AND curso_falta_docente='$curso'
                      AND grupo_falta_docente='$grupo'
                      AND fecha_falta_docente='$fecha'
        ";
        $result=$conn->query($sql);

        return $result->num_rows;
    }

    // Ingresa la falta del docente a la base de datos.
    public function ingresarFalta($conn, $ci, $curso, $grupo, $justificacion){
        $sql = "INSERT INTO falta_docente(cedula_docente_falta_docente, 
                                          curso_falta_docente,
                                          grupo_falta_docente,
                                          justificacion_falta_docente)
                VALUES ('$ci', '$curso', '$grupo', '$justificacion')";
        
        $result = $conn->query($sql);
        
        if($conn->error){
            echo "There was an error: $conn->error";
        }
    }

    // Se obtienen las faltas de la base de datos.
    public function obtenerFaltas($conn){
        $resultados=array();
        $sql = "SELECT d.nombre, d.apellido, f.curso_falta_docente AS curso, f.grupo_falta_docente AS grupo, f.justificacion_falta_docente AS justificacion, f.fecha_falta_docente AS fecha
                FROM docente AS d
                JOIN falta_docente AS f
                ON d.ci = f.cedula_docente_falta_docente";
        
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
            $falta = [];
            
            $falta["nombre"] = $row["nombre"];
            $falta["apellido"] = $row["apellido"];
            $falta["curso"] = $row["curso"];
            $falta["grupo"] = $row["grupo"];
            $falta["justificacion"] = $row["justificacion"];
            $falta["fecha"] = $row["fecha"];

            $resultados[] = $falta;
        }

        return $resultados;
    }

    // Se obtienen las salas de la base de datos.
    public function obtenerSalas($conn){
        $salas = [];
        $sql = "SELECT * FROM sala";
        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()){
            $salas[] = $row["codigoSala"];
        }

        return $salas;
    }


    /**
     * Se verifica si ya hay una reserva para la sala pasada por parámetros en la 
     * hora inicio y la hora fin
     */
    public function verificarReservaSala($conn, $sala, $hora_inicio, $hora_fin){
        $resultado = [];
        $validacion = false;
        $fecha = date("Y-m-d");

        $sql = "SELECT * FROM reserva WHERE nombre_sala_reserva='$sala' AND
                              fecha_reserva='$fecha' AND
                              (hora_inicio_reserva < '$hora_fin' AND 
                              hora_fin_reserva > '$hora_inicio')";

        $sqlHora = "SELECT * FROM reserva WHERE nombre_sala_reserva='$sala' AND
                    (hora_inicio_reserva < '$hora_fin' AND hora_fin_reserva > '$hora_inicio')
                    ORDER BY hora_fin_reserva DESC
                    LIMIT 1";

        $result = $conn->query($sql);
        $resultHora = $conn->query($sql);

        while($row = $resultHora->fetch_assoc()){
            $resultado["hora_final"] = $row["hora_fin_reserva"];
        }
        
        if($result->num_rows === 0){
            $validacion = true;
            $resultado["verificacion"] = $validacion;
        }

        return $resultado;
    }


    /**
     * Se inserta una reserva de sala.
     */
    public function insertarReservaSala($conn, $sala, $cedula, $grupo, $hora_inicio, $hora_fin){
        $sql = "INSERT INTO reserva(nombre_sala_reserva,
                                     cedula_docente_reserva,
                                     nombre_grupo_reserva,
                                     hora_inicio_reserva,
                                     hora_fin_reserva)
                VALUES ('$sala', '$cedula', '$grupo', '$hora_inicio', '$hora_fin')";

        $result = $conn->query($sql);

        if($conn->error){
            echo "There was an error: $conn->error";
        }
    }

    /**
     * Se verifica si existe una reserva para el docente, la fecha, hora inicio y hora final 
     * pasados por parámetros. Esta verificación se hace con el fin de validar si hay una reserva
     * hecha y corriendo antes de la verificación de las máquinas.
     */
    public function verificarReservaSalaMaquina($conn, $cedula, $sala, $grupo, $hora_inicio, $hora_fin){
        $fecha = date("Y-m-d");
        $sql = "SELECT * FROM reserva 
                WHERE nombre_sala_reserva='$sala' AND
                      nombre_grupo_reserva='$grupo' AND
                      cedula_docente_reserva='$cedula' AND
                      fecha_reserva='$fecha' AND
                      hora_inicio_reserva='$hora_inicio' AND
                      hora_fin_reserva='$hora_fin'";

        $result = $conn->query($sql);

        return !($result->num_rows === 0);
    }

    /**
     * Se obtiene las máquinas pertenecientes a una sala en particular.
     */
    public function obtenerMaquinas($conn, $sala){
        $maquinas = [];
        $sql = "SELECT * FROM maquina 
                WHERE codigoSala='$sala'";

        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()){
            $maquinas[] = $row["numeroMaquina"];
        }

        return $maquinas;
    }

    /**
     * Se registra quien utilizó cada máquina y su estado.
     */
    public function insertarRegistroMaquina($conn, $nombre_estudiante, $grupo, $hora_inicio, $hora_fin, $estado, $numero_maquina, $codigo_sala){
        $validacion = true;
        $fecha = date("Y-m-d");
        $ciEstudiante = $this->obtenerCedulaEstudiante($conn, $nombre_estudiante, $grupo);

        if($ciEstudiante != ""){
            $sqlInsertarRegistroMaquina = "INSERT INTO utiliza(ciEstudiante, 
                                                               fecha, 
                                                               horaInicio,
                                                               horaFin, 
                                                               estado,
                                                               numeroMaquina,
                                                               codigoSala)
                                            VALUES('$ciEstudiante',
                                                   '$fecha',
                                                   '$hora_inicio',
                                                   '$hora_fin',
                                                   '$estado',
                                                   $numero_maquina,
                                                   '$codigo_sala')";

            
            $result = $conn->query($sqlInsertarRegistroMaquina);
            $validacion = true;

            if($conn->error){
             echo "There was an error: $conn->error";
             $validacion = false;
            }
        }

        return $validacion;
    }

    /**
     * Se verifica si ya se registraron las maquinas.
     */
    public function verificarRegistroMaquina($conn, $nombre_estudiante, $grupo, $hora_inicio, $hora_fin, $numero_maquina, $codigo_sala){
        $fecha = date("Y-m-d");
        $ciEstudiante = $this->obtenerCedulaEstudiante($conn, $nombre_estudiante, $grupo);

        $sql = "SELECT * FROM utiliza 
                    WHERE ciEstudiante='$ciEstudiante' AND
                        fecha='$fecha' AND
                        horaInicio='$hora_inicio' AND
                        horaFin='$hora_fin' AND
                        numeroMaquina='$numero_maquina' AND
                        codigoSala='$codigo_sala'";

        $result = $conn->query($sql);

        return $result->num_rows === 0;
        
    }
}