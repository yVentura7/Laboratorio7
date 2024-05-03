<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/1999/xhtml">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Editar Vehículo</title>
</head>
<body>
    <?php
    // Obtener la placa del vehículo a editar de la URL
    $placa = $_GET['placa'];

    // Crear conexión
    $conexion = new mysqli("localhost", "root", "", "db_01", "3308");
    if ($conexion->connect_error) {
        die("La conexión falló: " . $conexion->connect_error);
    }

    // Preparar la consulta
    $stmt = $conexion->prepare("SELECT * FROM vehiculos WHERE placa = ?");
    $stmt->bind_param("s", $placa);

    // Ejecutar y obtener resultados
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    // Verificar si se encontraron resultados
    if ($resultado->num_rows === 0) {
        echo "No se encontró ningún vehículo con la placa proporcionada.";
    } else {
        // Obtener el vehículo y cerrar la consulta
        $vehiculo = $resultado->fetch_assoc();
        $stmt->close();
    }

    // Cerrar la conexión
    $conexion->close();
    ?>

    <!-- Mostrar el formulario para editar el vehículo -->
    <form method="post" action="modificar_vehiculo.php">
        Placa: <input name="xpl" size="10" value="<?php echo $vehiculo['placa']; ?>" readonly="readonly"/><br />
        Modelo: <input name="xmo" size="40" value="<?php echo $vehiculo['modelo']; ?>"/><br />
        Marca: <input name="xma" size="30" value="<?php echo $vehiculo['marca']; ?>"/><br />
        Año: <input name="xan" size="10" value="<?php echo $vehiculo['anio']; ?>"/><br />
        <input type="submit" value="Grabar Cambios" />
    </form>
</body>
</html>
