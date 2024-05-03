<?php
// Asumiendo que los campos del formulario son 'xpl', 'xmo', 'xma', 'xan'.
$placa = $_POST['xpl'];
$modelo = $_POST['xmo'];
$marca = $_POST['xma'];
$anio = $_POST['xan'];


// Utiliza 'mysqli' con consultas preparadas para mayor seguridad.
$conexion = new mysqli("localhost", "root", "", "db_01", "3308");
if ($conexion->connect_error) {
    die("Conexion fallida: " . $conexion->connect_error);
}

// Preparar la consulta SQL para evitar inyección SQL
$stmt = $conexion->prepare("INSERT INTO vehiculos (placa, modelo, marca, anio) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $placa, $modelo, $marca, $anio);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Registro grabado correctamente ";
    echo "<p><a href='lista_vehiculos.php'>Volver al listado</a></p>";
} else {
    echo "Error:" . $stmt->error;
}

// Cerrar la conexion
$stmt->close();
$conexion->close();

?>