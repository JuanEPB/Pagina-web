<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="./css/crud.css">
</head>
<body>

<div class="container mt-5">
    <!-- Botón para agregar nuevo usuario (abre el modal) -->
    <button class="btn btn-primary newUser" data-bs-toggle="modal" data-bs-target="#userForm">Nuevo Usuario <i class="bi bi-people"></i></button>

    <!-- Tabla para mostrar usuarios -->
    <table class="table table-striped table-hover mt-3 text-center table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Foto</th>
                <th>Nombre(s)</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="data">
            <?php
            include 'conexion.php';
            $sql = $conn->query("SELECT * FROM users");

            while ($datos = $sql->fetch_object()) {
                // Verificar el tipo MIME de la imagen y codificar en base64
                $imageType = 'image/jpeg'; // Cambiar según el tipo real de la imagen almacenada
                if ($datos->image) {
                    $imageSrc = "data:$imageType;base64," . base64_encode($datos->image);
                } else {
                    $imageSrc = './image/default-image.png'; // Imagen por defecto si no hay imagen en la base de datos
                }
            ?>
                <tr>
                    <td><?= htmlspecialchars($datos->id) ?></td>
                    <td><img src="<?= htmlspecialchars($imageSrc) ?>" width="100" alt="User Image"></td>
                    <td><?= htmlspecialchars($datos->name) ?></td>
                    <td><?= htmlspecialchars($datos->lastname) ?></td>
                    <td><?= htmlspecialchars($datos->email) ?></td>
                    <td>
                    <a href="edit_user.php?id=<?= htmlspecialchars($datos->id)?>" class="btn btn-primary">Editar<i class="bi bi-pen"></i></a>
                    <button class="btn btn-primary" onclick="location.href='delete_user.php?id=<?= htmlspecialchars($datos->id)?>'">Borrar<i class="bi bi-trash"></i></button>                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal para agregar nuevo usuario -->
<div class="modal fade" id="userForm">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nuevo Usuario</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add_user.php" method="POST" id="myForm" enctype="multipart/form-data">
                    <div class="card imgholder">
                        <label for="imgInput" class="upload">
                            <input type="file" name="image" id="imgInput">
                            <i class="bi bi-plus-circle-dotted"></i> Subir Foto
                        </label>
                        <img src="./image/Profile Icon.webp" alt="" width="200" height="200" class="img">
                    </div>
                    <div class="inputField">
                        <div>
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" id="name" required>
                        </div>
                        <div>
                            <label for="lastname">Apellidos:</label>
                            <input type="text" name="lastname" id="lastname" required>
                        </div>
                        <div>
                            <label for="email">E-mail:</label>
                            <input type="email" name="email" id="email" required>
                        </div>
                        <div>
                            <label for="password">Contraseña:</label>
                            <input type="password" name="password" id="password" minlength="8" required>
                        </div>
                    </div>
                    <td>
                    <button class="btn btn-primary" id="saveButton" onclick="location.href='add_user.php?'">Guardar</button>
                    <button class="btn btn-secondary" id="cancelButton" onclick="location.href='index.php'">Cancelar</button>
</td>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar usuario -->



<!-- Bootstrap Bundle con Popper para JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</body>
</html>
