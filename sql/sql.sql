use logmaster;

# CÓDIGO PRINCIPAL
SELECT * FROM reserva
WHERE nombre_sala_reserva='Sala 1' AND
	  hora_inicio_reserva >= '20:10' AND
	 (hora_fin_reserva BETWEEN '20:10' AND '21:30')
ORDER BY hora_fin_reserva DESC;

# Verificación hora anterior.
SELECT * FROM reserva
WHERE nombre_sala_reserva='Sala 1' AND
	  hora_inicio_reserva < '20:10' AND
	  (hora_fin_reserva > '21:30')
ORDER BY hora_fin_reserva DESC
LIMIT 1;