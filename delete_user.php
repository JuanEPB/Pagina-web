<?php
// Incluir archivo de conexión
include 'conexion.php';



// Verificar si el ID del usuario fue enviado
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

  // Preparar la consulta SQL para eliminar el usuario
  $query = "DELETE FROM users WHERE id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('i', $id);

  // Ejecutar la consulta
  if ($stmt->execute()) {
    // Mostrar alerta de confirmación con SweetAlert
    echo '<script>
          swal({
            title: "Usuario eliminado!",
            text: "El usuario ha sido eliminado con éxito.",
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
    error_log("Error al eliminar usuario: ". $stmt->error);
    echo 'Error al eliminar usuario: '. $stmt->error;
  }

  $stmt->close();
} else {
  error_log("Error: ID de usuario no válido");
  echo 'Error: ID de usuario no válido';
}

// Cerrar la conexión
if (!$conn->close()) {
  error_log("Error al cerrar la conexión: ". $conn->error);
  echo 'Error al cerrar la conexión';
}
?>