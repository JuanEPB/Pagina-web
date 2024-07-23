<?php
// Incluir archivo de conexión
include 'conexion.php';



// Verificar si el ID del producto fue enviado
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

  // Preparar la consulta SQL para eliminar el producto
  $query = "DELETE FROM productos WHERE id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('i', $id);

  // Ejecutar la consulta
  if ($stmt->execute()) {
    // Mostrar alerta de confirmación con SweetAlert
    echo '<script>
          swal({
            title: "Producto eliminado!",
            text: "El producto ha sido eliminado con éxito.",
            icon: "success",
            buttons: false,
            timer: 2000
          });
          </script>';

    // Redirigir a la página principal después de 2 segundos
    echo '<script>
          setTimeout(function() {
            window.location.href = "dashboard.php";
          }, 2000);
          </script>';
  } else {
    error_log("Error al eliminar producto: ". $stmt->error);
    echo 'Error al eliminar producto: '. $stmt->error;
  }

  $stmt->close();
} else {
  error_log("Error: ID de producto no válido");
  echo 'Error: ID de producto no válido';
}

// Cerrar la conexión
if (!$conn->close()) {
  error_log("Error al cerrar la conexión: ". $conn->error);
  echo 'Error al cerrar la conexión';
}
?>