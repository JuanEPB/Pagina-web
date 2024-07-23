<?php
// Incluir archivo de conexión
include 'conexion.php';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir y validar los datos del formulario
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
    $description = filter_input(INPUT_POST, 'description', FILTER_DEFAULT);
    $image = $_FILES['image'];
    $price = filter_input(INPUT_POST, 'price', FILTER_DEFAULT);

    // Verificar si el campo de imagen está seteado y es válido
    if (isset($image) && $image['error'] === 0) {
        // Validar el tamaño de la imagen
        if ($image['size'] > 500000) {
            echo "Lo siento, su archivo es demasiado grande.";
            exit;
        }

        // Validar el tipo de archivo
        $allowedTypes = ['image/jpeg', 'image/png'];
        if (!in_array($image['type'], $allowedTypes)) {
            echo "Lo siento, solo se permiten archivos JPG y PNG.";
            exit;
        }

        // Leer la imagen y prepararla para actualizar en la base de datos
        $image_data = fread($image['tmp_name'], $image['size']);
    } else {
        $image_data = null;
    }

    // Preparar la consulta SQL utilizando consultas preparadas
    $query = "UPDATE productos SET ";
    $params = array();

    if (!empty($name)) {
        $query .= "name = ?, ";
        $params[] = $name;
    }
    if (!empty($description)) {
        $query .= "description = ?, ";
        $params[] = $description;
    }
    if ($image_data !== null) {
        $query .= "image = ?, ";
        $params[] = $image_data;
    }
    if (!empty($price)) {
        $query .= "price = ?, ";
        $params[] = $price;
    }

    $query = rtrim($query, ', ') . " WHERE id = ?";
    $params[] = $id;

    $stmt = $conn->prepare($query);

    if ($stmt) {
        $types = str_repeat('s', count($params));
        $stmt->bind_param($types, ...$params);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo 'Producto actualizado con éxito!';
            header('Location: productos.php');
            exit;
        } else {
            error_log("Error al actualizar producto: ". $stmt->error);
            echo 'Error al actualizar producto: '. $stmt->error;
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