<?php 
include 'conexion.php';

// Configuración de la paginación
$products_per_page = isset($_GET['et_per_page']) ? (int)$_GET['et_per_page'] : 4;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $products_per_page;

// Obtener el número total de productos
$total_products_sql = "SELECT COUNT(*) as total FROM productos";
$total_products_result = $conn->query($total_products_sql);
$total_products = $total_products_result->fetch_assoc()['total'];

// Obtener los productos para la página actual
$sql = $products_per_page == -1 ? "SELECT * FROM productos" : "SELECT * FROM productos LIMIT $offset, $products_per_page";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/productos.css">
    <!-- CSS only -->
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    </head>
    <body>
    <header>
    <div class="logo" >
        <div class="imagelogo">
        <img src="./img/logo.png" width="350" height="" alt="Logo de la empresa">
        </div>
        <div class="navegacion w-100 justify-content-end">
            <nav class="navbar navbar-light bg-light w-100">
            <nav class="navbar navbar-expand-lg justify-content-end">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarToggleExternalContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#inicio">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#productos">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#conocenos">Conocenos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contactanos">Contactanos</a>
                </li>
                </ul>
            </div>
            </nav>
            </nav>
        </div>
    </div>
    </header>
    <main>
    <section>
    <div class="Inicio">
    <div class="background-image">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./img/aire1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./img/aire2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./img/aire3.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./img/aire4.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="./img/aire5.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
        </div>
    </div>
    <div class="contenido">
        <h2> PRAICOM</h2>
        <p>En  PRAICOM nos enorgullecemos de ofrecer soluciones integrales para sistemas de aire comprimido. Con años de experiencia en la industria, nuestro equipo está comprometido a proporcionar productos de calidad y un servicio excepcional a nuestros clientes en todo momento.</p>
        
    </div>
</div>
    </section>
    <section>
    <h1 class="productos">Productos por pagina</h1>
    <div class="select-container">
        <div class="titulog">
        </div>
        <div class="select">
        <form method="GET" action="">
            <select name="et_per_page" id="et_per_page" onchange="this.form.submit()" class="form-select form-select-sm" aria-label="Small select example">
                <option value="4" <?php if ($products_per_page == 4) echo 'selected'; ?>>4</option>
                <option value="8" <?php if ($products_per_page == 8) echo 'selected'; ?>>8</option>
                <option value="12" <?php if ($products_per_page == 12) echo 'selected'; ?>>12</option>
                <option value="20" <?php if ($products_per_page == 20) echo 'selected'; ?>>20</option>
                <option value="-1" <?php if ($products_per_page == -1) echo 'selected'; ?>>Todos</option>
            </select>
        </form>
        </div>
    </div>
    <div class="containerpro">
        <div class="container mt-100 product-grid">
            <div class="row justify-content-center">
                <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="col-md-3 col-sm-6 mb-30">';
                            echo '<div class="card">';
                            echo '<a class="card-img-tiles" href="#" data-abc="true">';
                            echo '<div class="inner">';
                            echo '<div class="thumblist"><img src="data:image/jpg;charset=utf8;base64,'. base64_encode($row['image']). '"></div>';
                            echo '</div>';
                            echo '</a>';
                            echo '<div class="card-body text-center">';
                            echo '<h4 class="card-title">'. $row['name']. '</h4>';
                            echo '<p class="text-muted">'. $row['description']. '</p>';
                            echo '<p class="text-price">'. $row['price'].'</p>';
                            echo '<a class="btn btn-outline-primary btn-sm" href="#" data-abc="true">View Products</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "No hay productos disponibles";
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="pagination">
            <?php
                if ($products_per_page != -1) {
                    $total_pages = ceil($total_products / $products_per_page);
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo '<a href="?page=' . $i . '&et_per_page=' . $products_per_page . '"';
                        if ($page == $i) echo ' class="active"';
                        echo '>' . $i . '</a>';
                    }
                }
            ?>
        </div>
        </section>
            

        </main>
        <footer>
    <div class="social-media">
    <div class="text-muted">&copy; PRAICOM <script>new Date().getFullYear()>2010&&document.write(""+new Date().getFullYear());</script>.
                            </div>
    
    <a href="https://www.facebook.com/">
        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="20" fill="currentColor" class="facebook" viewBox="0 0 16 16">
            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
        </svg>
    </a>
    <a href="https://www.instagram.com/">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="50" fill="currentColor" class="instagram" viewBox="0 0 16 16">
            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
        </svg>
    </a>
    <a href="https://www.x.com/">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="50" fill="currentColor" class="twitter-x" viewBox="0 0 16 16">
            <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
        </svg>
    </a>
</div>
    
    <ul class="footer-options">
        <li><a href="#Inicio">Inicio</a></li>
        <li><a href="#Productos">Productos Populares</a></li>
        <li><a href="#Conocenos">Conocenos</a></li>
        <li><a href="#Contactanos">Contactanos</a></li>
    </ul>
    <ul class="footer-options">
        <li><a href="#">Productos</a></li>
        <li><a href="#">Airpaipe</a></li>
        <li><a href="#">Deco</a></li>
    </ul>
    <ul class="footer-options">
        <li><a href="#Contactanos">Contactanos</a></li>
        <li><a href="#Contactanos">Informacion de contacto</a></li>
    </ul>
</footer>

</body>
</html>
