CREATE DATABASE logmaster;
USE logmaster;

# GRUPO (hecho)
CREATE TABLE grupo(
	codigoGrupo VARCHAR(15) PRIMARY KEY NOT NULL,
    descripcion VARCHAR(25) NOT NULL,
    grado INT NOT NULL
);

# ESTUDIANTE (hecho)
CREATE TABLE estudiante(
	ci VARCHAR(8) PRIMARY KEY NOT NULL,
    nombre VARCHAR(25) NOT NULL,
    apellido VARCHAR(25) NOT NULL,
    email VARCHAR(30) NOT NULL,
    direccion VARCHAR(45) NOT NULL,
    barrio VARCHAR(20) NOT NULL
);

# DOCENTE (hecho)
CREATE TABLE docente(
	ci VARCHAR(8) PRIMARY KEY NOT NULL,
    nombre VARCHAR(25) NOT NULL,
    apellido VARCHAR(25) NOT NULL,
    email VARCHAR(30) NOT NULL
);

# SALA (hecho)
CREATE TABLE sala(
	codigoSala VARCHAR(7) PRIMARY KEY NOT NULL,
    descripcion VARCHAR(25) NOT NULL
);

# MAQUINA (hecho)
CREATE TABLE maquina(
	numeroMaquina INT NOT NULL,
    codigoSala VARCHAR(7) NOT NULL,
    descripcion VARCHAR(25) NOT NULL,
    PRIMARY KEY(numeroMaquina, codigoSala),
    FOREIGN KEY(codigoSala) REFERENCES sala(codigoSala)
);

# TELEFONOESTUDIANTE (hecho)
CREATE TABLE telefonoEstudiante(
	ciEstudiante VARCHAR(8) NOT NULL,
    telefono INT NOT NULL,
    PRIMARY KEY(ciEstudiante, telefono),
    FOREIGN KEY(ciEstudiante) REFERENCES estudiante(ci)
);

# TELEFONODOCENTE (hecho)
CREATE TABLE telefonoDocente(
	ciDocente VARCHAR(8) NOT NULL,
    telefono INT NOT NULL,
    PRIMARY KEY(ciDocente, telefono),
    FOREIGN KEY(ciDocente) REFERENCES docente(ci)
);

# PERTENECE (hecho)
CREATE TABLE pertenece(
	ciEstudiante VARCHAR(8) PRIMARY KEY NOT NULL,
    codigoGrupo VARCHAR(15) NOT NULL,
    FOREIGN KEY(ciEstudiante) REFERENCES estudiante(ciii)
);

# RESERVA (hecho)
CREATE TABLE reserva(
	codigoGrupo VARCHAR(15) NOT NULL,
    ciDocente VARCHAR(8) NOT NULL,
    codigoSala VARCHAR(7) NOT NULL,
    fecha DATE NOT NULL,
    horaInicio TIME NOT NULL,
    horaFin TIME NOT NULL,
    turno VARCHAR(15) NOT NULL,
    PRIMARY KEY(codigoGrupo, ciDocente, codigoSala, fecha, horaInicio, horaFin),
    FOREIGN KEY(codigoGrupo) REFERENCES grupo(codigoGrupo),
    FOREIGN KEY(ciDocente) REFERENCES docente(ci),
    FOREIGN KEY(codigoSala) REFERENCES sala(codigoSala)
);

# CONTIENE (hecho)
CREATE TABLE contiene(
	numeroMaquina INT NOT NULL,
    codigoSala VARCHAR(7) NOT NULL,
    PRIMARY KEY(numeroMaquina, codigoSala),
    FOREIGN KEY(numeroMaquina) REFERENCES maquina(numeroMaquina),
    FOREIGN KEY(codigoSala) REFERENCES sala(codigoSala)
);

# UTILIZA (hecho)
CREATE TABLE utiliza(
	ciEstudiante VARCHAR(8) NOT NULL,
    fecha DATE NOT NULL,
    horaInicio TIME NOT NULL,
    horaFin TIME NOT NULL,
    estado VARCHAR(50) NOT NULL,
    numeroMaquina INT NOT NULL,
    codigoSala VARCHAR(7) NOT NULL,
    PRIMARY KEY(ciEstudiante, numeroMaquina, codigoSala, fecha, horaInicio, horaFin),
    FOREIGN KEY(ciEstudiante) REFERENCES estudiante(ci),
    FOREIGN KEY(numeroMaquina) REFERENCES maquina(numeroMaquina),
    FOREIGN KEY(codigoSala) REFERENCES sala(codigoSala)
);

