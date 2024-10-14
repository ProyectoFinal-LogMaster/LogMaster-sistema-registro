desc estudiante;

INSERT INTO docente 
VALUES ("55829536", "Fernando", "Crespo", "fernando@gmail.com"), 
	   ("11223344", "Marcos", "Rodriguez", "marcos@gmail.com"),
       ("33228233", "Fernanda", "Martinez", "fernanda@gmail.com"),
       ("43223156", "Laura", "Canucci", "laura@gmail.com"),
       ("33245678", "Jose", "Ganju", "jose@gmail.com");
       
INSERT INTO estudiante
VALUES ("55829535", "Lucas", "Da Rosa", "lucas@gmail.com", "Camino pepe 1234 esquina pepito", "Colón"),
	   ("51213335", "Matías", "Álvez", "matias@gmail.com", "Camino pepe 4321 esquina joselito", "Carbonera"),
       ("44313299", "Valentín", "Pírez", "valentin@gmail.com", "Camino pepe 4231 esquina juancito", "Lézica"),
       ("43798712", "Mario", "Silva", "mario@gmail.com", "Camino pepe 1114 esquina pepecin", "Colón");
       

INSERT INTO grupo
VALUES ("1RO BF", "Primer año de informática", 10),
	   ("2DO BF", "Segundo año de informática", 11),
       ("3ERO BF", "Tercer año de informática", 12),
       ("1RO BB", "Primer año de administración", 10),
       ("2DO BB", "Segundo año de administración", 11),
       ("3ERO BB", "Tercer año de administración", 12);
       


INSERT INTO sala
VALUES ("Sala 1", "Sala número uno"),
	   ("Sala 2", "Sala número dos"),
       ("Sala 3", "Sala número tres");


INSERT INTO maquina
VALUES (00000000001, "Sala 3", "Computadora en sala 3"),
	   (00000000002, "Sala 3", "Computadora en sala 3"),
       (00000000003, "Sala 3", "Computadora en sala 3"),
       (00000000004, "Sala 3", "Computadora en sala 3"),
       (00000000005, "Sala 3", "Computadora en sala 3"),
       (00000000006, "Sala 3", "Computadora en sala 3"),
       (00000000007, "Sala 3", "Computadora en sala 3"),
       (00000000008, "Sala 3", "Computadora en sala 3"),
       (00000000009, "Sala 3", "Computadora en sala 3"),
       (00000000010, "Sala 3", "Computadora en sala 3"),
       (00000000011, "Sala 3", "Computadora en sala 3"),
       (00000000012, "Sala 3", "Computadora en sala 3"),
       (00000000013, "Sala 3", "Computadora en sala 3");
       
	

INSERT INTO telefonoEstudiante
VALUES 
       ("43798712", "091245872"),
       ("43798712", "2322 2321");
       
       
INSERT INTO telefonoDocente 
VALUES ("55829536", "092988786"),
	   ("55829536", "2344 2321"),
       ("11223344", "099888222"),
	   ("11223344", "2322 1233"),
	   ("33228233", "091323323"),
       ("33228233", "2300 9911"),
       ("43223156", "098776763"),
       ("43223156", "2309 2333"),
       ("33245678", "099877832"),
       ("33245678", "2332 3213");
       

INSERT INTO pertenece
VALUES ("55829535", "3ERO BF"),
	   ("51213335", "3ERO BF"),
       ("44313299", "3ERO BF"),
       ("43798712", "3ERO BF");


desc contiene;
INSERT INTO contiene
VALUES (00000000001, "Sala 1"),
	   (00000000002, "Sala 1"),
       (00000000003, "Sala 1"),
       (00000000004, "Sala 1"),
       (00000000005, "Sala 1"),
       (00000000006, "Sala 1"),
       (00000000007, "Sala 1"),
       (00000000008, "Sala 1"),
       (00000000009, "Sala 1"),
       (00000000010, "Sala 1"),
       (00000000011, "Sala 1"),
       (00000000012, "Sala 1"),
       (00000000013, "Sala 1"),
       (00000000001, "Sala 2"),
       (00000000002, "Sala 2"),
       (00000000003, "Sala 2"),
       (00000000004, "Sala 2"),
       (00000000005, "Sala 2"),
       (00000000006, "Sala 2"),
       (00000000007, "Sala 2"),
       (00000000008, "Sala 2"),
       (00000000009, "Sala 2"),
       (00000000010, "Sala 2"),
       (00000000011, "Sala 2"),
       (00000000012, "Sala 2"),
       (00000000013, "Sala 2"),
       (00000000002, "Sala 3"),
       (00000000003, "Sala 3"),
       (00000000004, "Sala 3"),
       (00000000005, "Sala 3"),
       (00000000006, "Sala 3"),
       (00000000007, "Sala 3"),
       (00000000008, "Sala 3"),
       (00000000009, "Sala 3"),
       (00000000010, "Sala 3"),
       (00000000011, "Sala 3"),
       (00000000012, "Sala 3"),
       (00000000013, "Sala 3");
       
       
INSERT INTO reserva 
VALUES ("3ERO BF", "33228233", "Sala 3", "2024-09-09",  "18:10:00", "18:50:00", "nocturno"),
	   ("3ERO BF", "33245678", "Sala 1", "2024-09-10",  "19:30:00", "23:30:00", "nocturno"),
       ("3ERO BF", "43223156", "Sala 3", "2024-09-11", "19:30:00", "21:30:00", "nocturno"),
       ("3ERO BF", "33228233", "Sala 3", "2024-09-11", "21:30:00", "23:30:00", "nocturno"),
       ("3ERO BF", "55829536", "Sala 3", "2024-09-12","20:10:00", "21:30:00", "nocturno"),
       ("3ERO BF", "11223344", "Sala 3", "2024-09-13", "20:10:00", "22:10:00", "nocturno");

INSERT INTO utiliza
VALUES ("43798712", "2024-09-09", "18:10:00", "18:50:00", "Funcional", 1, "Sala 3"),
	   ("44313299", "2024-09-09", "18:10:00", "18:50:00", "Funcional", 2, "Sala 3"),
       ("51213335", "2024-09-09", "18:10:00", "18:50:00", "Con Defectos", 3, "Sala 3"),
       ("55829535", "2024-09-09", "18:10:00", "18:50:00", "Funcional", 6, "Sala 3");
       
INSERT INTO utiliza 
VALUES ("43798712", "2024-09-10", "19:30:00", "23:30:00", "Funcional", 1, "Sala 1"),
       ("44313299", "2024-09-10", "19:30:00", "23:30:00", "Con Defectos", 4, "Sala 1"),
       ("51213335", "2024-09-10", "19:30:00", "23:30:00", "Funcional", 2, "Sala 1"),
       ("55829535", "2024-09-10", "19:30:00", "23:30:00", "Conon Defectos", 8, "Sala 1");
       
INSERT INTO utiliza 
VALUES ("43798712", "2024-09-11", "19:30:00", "21:30:00", "Funcional", 8, "Sala 3"),
       ("44313299", "2024-09-11", "19:30:00", "21:30:00", "Con Defectos", 3, "Sala 3"),
       ("51213335", "2024-09-11", "19:30:00", "21:30:00", "Funcional", 1, "Sala 3"),
       ("55829535", "2024-09-11", "19:30:00", "21:30:00", "Funcional", 2, "Sala 3");
       
INSERT INTO utiliza 
VALUES ("43798712", "2024-09-11", "21:30:00", "23:30:00", "Funcional", 8, "Sala 3"),
       ("44313299", "2024-09-11", "21:30:00", "23:30:00", "Con Defectos", 3, "Sala 3"),
       ("51213335", "2024-09-11", "21:30:00", "23:30:00", "Funcional", 1, "Sala 3"),
       ("55829535", "2024-09-11", "21:30:00", "23:30:00", "Funcional", 2, "Sala 3");
       
       
INSERT INTO utiliza 
VALUES ("43798712", "2024-09-12", "20:10:00", "21:30:00", "Funcional", 1, "Sala 3"),
       ("44313299", "2024-09-12", "20:10:00", "21:30:00", "Funcional", 2, "Sala 3"),
       ("51213335", "2024-09-12", "20:10:00", "21:30:00", "Con Defectos", 3, "Sala 3"),
       ("55829535", "2024-09-12", "20:10:00", "21:30:00", "Funcional", 6, "Sala 3");
       
INSERT INTO utiliza 
VALUES ("43798712", "2024-09-13", "20:10:00", "22:10:00", "Funcional", 8, "Sala 3"),
       ("44313299", "2024-09-13", "20:10:00", "22:10:00", "Con Defectos", 3, "Sala 3"),
       ("51213335", "2024-09-13", "20:10:00", "22:10:00", "Funcional", 1, "Sala 3"),
       ("55829535", "2024-09-13", "20:10:00", "22:10:00", "Funcional", 2, "Sala 3");