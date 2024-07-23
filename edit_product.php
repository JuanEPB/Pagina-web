<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: login.html');
  exit;
}

// Código de la página dashboard.php
?>
<?php
include 'conexion.php';

$id = $_GET['id'];
$sql = $conn->query("SELECT * FROM productos WHERE id = $id");
$data = $sql->fetch_object();

// Mostrar el formulario de edición con los datos del producto
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="./css/edit.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                    <img src="./img/logo.png" width="100"/>
                        <h2 class="card-title">Actualizar Producto</h2>
                        <hr>
                        <form action="update_product.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Nombre del producto:</label>
                                <input type="text" id="name" name="name" value="<?= htmlspecialchars($data->name)?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción del producto:</label>
                                <textarea id="description" name="description" class="form-control"><?= htmlspecialchars($data->description)?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Precio del producto:</label>
                                <input type="number" id="price" name="price" value="<?= htmlspecialchars($data->price)?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="photo">Imagen del producto:</label>
                                <input type="file" id="photo" name="photo" class="form-control-file">
                            </div>
                            <input type="hidden" name="id" value="<?= htmlspecialchars($data->id)?>">
                            <button type="submit" class="btn btn-primary btn-block">Guardar cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
