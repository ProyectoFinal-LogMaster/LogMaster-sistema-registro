CREATE TABLE falta_docente(
	cedula_docente_falta_docente VARCHAR(8) NOT NULL,
    curso_falta_docente VARCHAR(100) NOT NULL,
    grupo_falta_docente VARCHAR(15) NOT NULL,
    justificacion_falta_docente VARCHAR(15) NOT NULL,
    fecha_falta_docente DATE NOT NULL DEFAULT CURDATE(),
    PRIMARY KEY(cedula_docente_falta_docente, curso_falta_docente, grupo_falta_docente, fecha_falta_docente),
    FOREIGN KEY (cedula_docente_falta_docente) REFERENCES docente(ci),
    FOREIGN KEY (curso_falta_docente) REFERENCES curso(nombre_curso),
    FOREIGN KEY (grupo_falta_docente) REFERENCES grupo(codigoGrupo)
);

CREATE TABLE curso(
	nombre_curso VARCHAR(100) NOT NULL,
    ci_docente_curso VARCHAR(8) NOT NULL,
    grupo_curso VARCHAR(15) NOT NULL,
    PRIMARY KEY(nombre_curso, ci_docente_curso, grupo_curso),
    FOREIGN KEY (ci_docente_curso) REFERENCES docente(ci),
    FOREIGN KEY (grupo_curso) REFERENCES grupo(codigoGrupo)
); 