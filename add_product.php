<?php
// Incluir archivo de conexión
include 'conexion.php';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir y validar los datos del formulario
    $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
    $description = filter_input(INPUT_POST, 'description', FILTER_DEFAULT);
    $image = $_FILES['image'];
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

    // Verificar si el campo de imagen está seteado y es válido
    if (isset($image) && $image['error'] === 0) {
        // Validar el tamaño de la imagen
        if ($image['size'] > 500000) {
            echo "Lo siento, su archivo es demasiado grande.";
            exit;
        }

        // Validar el tipo de archivo
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($image['type'], $allowedTypes)) {
            echo "Lo siento, solo se permiten archivos JPG y PNG.";
            exit;
        }

        // Leer la imagen y prepararla para insertar en la base de datos
        $fp = fopen($image['tmp_name'], 'rb');
        $image_data = fread($fp, $image['size']);
        fclose($fp);
        } else {
        $image_data = null;
    }

    // Preparar la consulta SQL utilizando consultas preparadas
    $query = "INSERT INTO productos (name, description, image, price) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("ssbd", $name, $description, $image_data, $price);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo 'Producto agregado con éxito!';
            header('Location: productos.php');
            exit;
        } else {
            error_log("Error al agregar producto: ". $stmt->error);
            echo 'Error al agregar producto: '. $stmt->error;
        }

        $stmt->close();
    } else {
        error_log("Error al preparar la consulta: ". $conn->error);
        echo 'Error al preparar la consulta';
    }

    // Cerrar la conexión
    if (!$conn->close()) {
        error_log("Error al cerrar la conexión: ". $conn->error);
        echo 'Error al cerrar la conexión';
    }
}
?>