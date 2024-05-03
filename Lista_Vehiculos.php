<?php
// 1. Conectar al servidor
$conexion = new mysqli("localhost", "root", "", "db_01", "3308");

// Verificar conexión
if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);
}

// 2. Ejecutar consulta SQL
$stmt = $conexion->prepare("SELECT * FROM vehiculos");
$stmt->execute();
$resultado = $stmt->get_result();

// 3. Visualizar / procesar los datos
echo "<br><a href='FormVehiculos.html'>Nuevo vehículo</a>";
echo "<table border='1'><tr><th>Placa</th><th>Modelo</th><th>Marca</th><th>Año</th></tr>";

while ($fila = $resultado->fetch_assoc()) {
    echo "<tr>";
    echo "<td>". htmlspecialchars($fila['placa']). "</td>";
    echo "<td>". htmlspecialchars($fila['modelo']). "</td>";
    echo "<td>". htmlspecialchars($fila['marca']). "</td>";
    echo "<td>". htmlspecialchars($fila['anio']). "</td>";
    echo "<td><a href='editar.php?placa=" . urlencode($fila['placa']). "'>Editar</a></td>";
    echo "<td><a href='eliminar.php?placa=" . urlencode($fila['placa']). "'>Eliminar</a></td>";
    echo "</tr>";
}

echo "</table>";

// 4. Cerrar conexión
$conexion->close();
?>