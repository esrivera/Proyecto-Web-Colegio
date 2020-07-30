<?php

class Connection {
 function getConnection() {
    $conex = mysqli_connect("bexotsqo1smcwibzrc2c-mysql.services.clever-cloud.com", "u82pcl89espzoccg", "mnbGjN1vY0F6YqtrpAPy", "bexotsqo1smcwibzrc2c");

	if (!$conex) {
		echo "<p> Error: No se pudo conectar a MySQL." . PHP_EOL;
		echo "errno de depuraciÃ³n: " . mysqli_connect_errno() . PHP_EOL;
		echo "error de depuraciÃ³n: " . mysqli_connect_error() . PHP_EOL;
		echo "</p>";
		exit;
	}
    echo "<p>Conectado con Ã©xito</p>" . PHP_EOL;
    return $conex;

 }
}
?>