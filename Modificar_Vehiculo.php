<?php
$placa = $_POST['xpl'];
$modelo = $_POST['xmo'];
$marca = $_POST['xma'];
$anio = $_POST['xan'];
// Crear conexión
$conexion = new mysqli("localhost", "root", "", "db_01", "3308");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
// Preparar la consulta para prevenir inyección SQL
$stmt = $conexion->prepare("UPDATE vehiculos SET modelo=?, marca=?, anio=? WHERE placa = ?");
$stmt->bind_param("ssis", $modelo, $marca, $anio, $placa);
// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Registro modificado correctamente.";
    echo "<p><a href='lista_vehiculos.php'>Volver al listado</a></p>";
} else {
    echo "Error al modificar el registro: " . $stmt->error;
}
// Cerrar conexión
$stmt->close();
$conexion->close();
?>