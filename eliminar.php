<?php
$placa = $_GET['placa'];
// Crear conexión
$conexion = new mysqli("localhost", "root", "", "db_01", "3308");
if ($conexion->connect_error) {
die("La conexión falló: " . $conexion->connect_error);
}
// Preparar la consulta para prevenir inyección SQL
$stmt = $conexion->prepare("DELETE FROM vehiculos WHERE placa = ?");
$stmt->bind_param("s", $placa);
// Ejecutar la consulta
if ($stmt->execute()) {
echo "Vehículo $placa eliminado correctamente.";
} else {
echo "Error al eliminar el vehículo:" . $conexion->error;
}

echo "<p><a href='lista_vehiculos.php'>Volver al listado</a></p>";

// Cerrar conexión
$stmt->close();
$conexion->close();

?>