<?php
// Función para generar un token único
function generar_token() {
    return bin2hex(random_bytes(32));
}

// Verificación de token CSRF
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && hash_equals($_SESSION['token'], $_POST['token'])) {
    // Procesar los datos del formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $agente_id = htmlspecialchars($_POST['agente_id']);
    $departamento_id = htmlspecialchars($_POST['departamento_id']);
    $num_misiones = htmlspecialchars($_POST['num_misiones']);
    $descripcion_mision = htmlspecialchars($_POST['descripcion_mision']);

    // Aquí podrías cifrar los campos sensibles antes de almacenarlos en la base de datos

    // Por ejemplo, puedes usar OpenSSL para cifrar el nombre y el ID del agente
    $clave = openssl_random_pseudo_bytes(32); // Genera una clave aleatoria
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc')); // Genera un IV aleatorio
    $nombre_cifrado = openssl_encrypt($nombre, 'aes-256-cbc', $clave, 0, $iv);
    $agente_id_cifrado = openssl_encrypt($agente_id, 'aes-256-cbc', $clave, 0, $iv);

    // Guardar los datos cifrados en la base de datos o en otro almacenamiento seguro
    
    // Aquí deberías tener tu lógica de almacenamiento de datos

    // Por ejemplo, aquí solo mostramos los datos cifrados
    echo "Nombre cifrado: " . $nombre_cifrado . "<br>";
    echo "ID del agente cifrado: " . $agente_id_cifrado . "<br>";
    echo "Departamento ID: " . $departamento_id . "<br>";
    echo "Número de misiones: " . $num_misiones . "<br>";
    echo "Descripción de la nueva misión: " . $descripcion_mision . "<br>";
} else {
    // Token CSRF inválido
    echo "¡Token CSRF inválido!";
}
?>
