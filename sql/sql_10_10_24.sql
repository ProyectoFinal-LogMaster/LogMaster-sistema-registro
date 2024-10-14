INSERT INTO curso(nombre_curso, ci_docente_curso, grupo_curso)
VALUES ("Ingles", "67857647", "1RO BB"),
	   ("Ingles", "67857647", "2DO BB"),
       ("Ingles", "67857647", "3ERO BB"),
       ("Ingles", "67857647", "1RO BF"),
	   ("Ingles", "67857647", "2DO BF"),
       ("Ingles", "67857647", "3ERO BF");
	
CREATE TABLE falta_docente(
cedula_docente_falta_docente VARCHAR(8) NOT NULL,
curso_falta_docente VARCHAR(100) NOT NULL,
grupo_falta_docente VARCHAR(15) NOT NULL,
justificacion_falta_docente VARCHAR(255) NOT NULL,
fecha_falta_docente DATE DEFAULT CURDATE(),
PRIMARY KEY (cedula_docente_falta_docente, curso_falta_docente, grupo_falta_docente, fecha_falta_docente),
FOREIGN KEY (cedula_docente_falta_docente) REFERENCES docente(ci),
FOREIGN KEY (curso_falta_docente) REFERENCES curso(nombre_curso),
FOREIGN KEY (grupo_falta_docente) REFERENCES grupo(codigoGrupo)
);

CREATE TABLE reserva(
nombre_sala_reserva VARCHAR(7) NOT NULL,
cedula_docente_reserva VARCHAR(8) NOT NULL,
nombre_grupo_reserva VARCHAR(15) NOT NULL,
fecha_reserva DATE NOT NULL,
hora_inicio_reserva TIME NOT NULL,
hora_fin_reserva TIME NOT NULL,
turno VARCHAR(15),
PRIMARY KEY(nombre_sala_reserva, fecha_reserva, hora_inicio_reserva, hora_fin_reserva),
FOREIGN KEY (nombre_sala_reserva) REFERENCES sala(codigoSala),
FOREIGN KEY (cedula_docente_reserva) REFERENCES docente(ci),
FOREIGN KEY (nombre_grupo_reserva) REFERENCES grupo(codigoGrupo)
);

ALTER TABLE reserva
MODIFY COLUMN fecha_reserva DATE NOT NULL DEFAULT CURDATE();
    
SELECT c.nombre_curso, d.nombre, d.apellido, d.ci
FROM curso AS c
JOIN docente AS d
ON d.ci=c.ci_docente_curso;

DESC docente;



SELECT * FROM reserva 
WHERE nombre_sala_reserva="Sala 2" AND
	  hora_inicio_reserva > "20:10" AND
      hora_fin_reserva < "21:33";
      
SELECT * FROM reserva 
WHERE nombre_sala_reserva="Sala 1" AND
	  hora_inicio_reserva = "18:10"
      ORDER BY hora_fin_reserva DESC
      LIMIT 1;
      
SELECT * FROM reserva WHERE nombre_sala_reserva = 'Sala 2';

SELECT DATE_FORMAT(hora_fin_reserva, '%H:%i') AS hora_fin FROM reserva
                 WHERE nombre_sala_reserva='Sala 2'
                 ORDER BY hora_fin_reserva DESC
                 LIMIT 1;

SELECT DATE_FORMAT(hora_fin_reserva, '%H:%i') AS hora_fin FROM reserva
WHERE nombre_sala_reserva='Sala 1' AND
	  hora_inicio_reserva='20:10'
ORDER BY hora_fin_reserva DESC
LIMIT 1;


SELECT * FROM reserva
WHERE nombre_sala_reserva='Sala 2' AND hora_inicio_reserva >= '20:10';

SELECT * FROM reserva 
WHERE nombre_sala_reserva="Sala 2";

SELECT *,DATE_FORMAT(hora_fin_reserva, '%H:%i') AS hora_fin FROM reserva
WHERE nombre_sala_reserva = "Sala 2"
ORDER BY hora_fin_reserva DESC limit 1;
      
select * from reserva;

SELECT * FROM reserva
WHERE nombre_sala_reserva = 'Sala 1';

SELECT DATE_FORMAT(hora_fin_reserva, '%H:%i') AS hora_fin, hora_inicio_reserva FROM reserva 
WHERE nombre_sala_reserva='Sala 1' AND
	  hora_inicio_reserva < "18:50" AND
      hora_fin_reserva > "18:50" and hora_fin_reserva <= "19:30";