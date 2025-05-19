<?php
require_once 'config.php';
require_once 'funciones.php';

// Obtener las noticias más recientes
$noticias = obtenerNoticias(4); // Limitar a 4 noticias
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Iglesias Unidas de Jujuy - Noticias</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
<link href="css/jcarousel.css" rel="stylesheet" />
<link href="css/flexslider.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
    /* Estilos para las tarjetas de noticias */
    .news-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        margin-bottom: 30px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .news-image-container {
        height: 200px;
        overflow: hidden;
    }
    
    .news-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .news-card:hover .news-image {
        transform: scale(1.05);
    }
    
    .news-content {
        padding: 20px;
    }
    
    .news-title {
        color: #2c3e50;
        font-size: 1.4rem;
        margin-bottom: 10px;
    }
    
    .news-excerpt {
        color: #555;
        margin-bottom: 15px;
        line-height: 1.6;
    }
    
    .news-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid #eee;
    }
    
    .news-date {
        color: #7f8c8d;
        font-size: 0.9rem;
    }
    
    .read-more {
        color: #3498db;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
    }
    
    .read-more:hover {
        color: #2980b9;
    }
    
    .read-more i {
        margin-left: 5px;
        font-size: 0.8rem;
    }
    
    .news-category {
        display: inline-block;
        padding: 3px 10px;
        background: #f1f1f1;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 10px;
        color: #555;
    }
    
    .category-event {
        background: #e3f2fd;
        color: #1976d2;
    }
    
    .category-testimony {
        background: #e8f5e9;
        color: #388e3c;
    }
    
    .category-announcement {
        background: #fff8e1;
        color: #ffa000;
    }
</style>
</head>
<body>
<div id="wrapper">
    <!-- start header -->
    <header>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="img/iglesia-unida-jujuy.png" alt="logo"/></a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li><a href="index.html">Inicio</a></li> 
                        <li class="active"><a href="noticias.php">Noticias</a></li>
                        <li><a href="iglesias.php">Iglesias</a></li>
                        <li><a href="nosotros.html">Nosotros</a></li>
                        <li><a href="contactos.html">Contactarnos</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header><!-- end header -->
    
    <section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="pageTitle">Noticias</h2>
            </div>
        </div>
    </div>
    </section>
    
    <section id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-intro">
                    <p>¡Te damos la bienvenida a la sección de noticias recientes, 
                        donde compartiremos los informes de las reuniones y campañas unidas 
                        que realizan las Iglesias Cristianas Evangelicas - Asambleas de los Hermanos 
                        en la Provincia de Jujuy! Las noticias se publicarán cada semana y te animamos 
                        a que estés atento a los informes y que tambien  puedas apoyar con tus oraciones 
                        en favor de esta labor que el Señor esta haciendo en Jujuy.</p>
                </div>
                
                <!-- Lista de Noticias -->
                <div class="row">
    <?php foreach($noticias as $noticia): ?>
    <div class="col-md-3">
        <div class="news-card">
            <div class="news-image-container">
                <img src="<?php echo htmlspecialchars($noticia['imagen']); ?>" alt="<?php echo htmlspecialchars($noticia['titulo']); ?>" class="news-image">
            </div>
            <div class="news-content">
                <span class="news-category category-<?php echo htmlspecialchars($noticia['categoria']); ?>">
                    <?php echo ucfirst(htmlspecialchars($noticia['categoria'])); ?>
                </span>
                <h3 class="news-title"><?php echo htmlspecialchars($noticia['titulo']); ?></h3>
                <p class="news-excerpt"><?php echo substr(strip_tags($noticia['contenido']), 0, 100) . '...'; ?></p>
                <div class="news-meta">
                    <span class="news-date"><?php echo date('d M Y', strtotime($noticia['fecha'])); ?></span>
                    <a href="noticia-<?php echo $noticia['id']; ?>.html" class="read-more" target="_blank">
                        Leer más <i class="fas fa-external-link-alt"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
                
                <!-- Paginación -->
                <div class="text-center" style="margin-top: 40px;">
                    <ul class="pagination">
                        <li class="disabled"><a href="#">&laquo;</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </section>
    
    <footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="widget">
                    <h5 class="widgetheading">Nuestro Contacto</h5>
                    <address>
                    <strong>Email</strong><br>
                    contacto@iglesiasunidadejujuy.com<br>
                </div>
            </div>
        </div>
    </div>
    <div id="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="copyright">
                        <p>
                            <span>&copy; <?php echo date('Y'); ?> Iglesias Unidas de Jujuy</span>
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="social-network">
                        <li><a href="#" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" data-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </footer>
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>

<!-- javascript -->
<script src="js/jquery.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/jquery.fancybox-media.js"></script> 
<script src="js/portfolio/jquery.quicksand.js"></script>
<script src="js/portfolio/setting.js"></script>
<script src="js/jquery.flexslider.js"></script>
<script src="js/animate.js"></script>
<script src="js/custom.js"></script>
</body>
</html>