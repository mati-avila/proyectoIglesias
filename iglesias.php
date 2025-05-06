<?php
require_once 'config.php';
require_once 'funciones.php';

// Definir las regiones disponibles
$regiones = [
    'puna' => 'La Puna',
    'quebrada' => 'La Quebrada',
    'valles' => 'Los Valles',
    'yungas' => 'El Ramal',
    'sanpedro' => 'San Pedro y La Mendieta',
    'capital' => 'Capital Palpalá'
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Iglesias Unidad de Jujuy - Nuestras Iglesias</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="Conoce nuestras iglesias en las diferentes regiones de Jujuy" />
<meta name="author" content="Iglesias Unidas de Jujuy" />
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
<link href="css/jcarousel.css" rel="stylesheet" />
<link href="css/flexslider.css" rel="stylesheet" />
<link href="css/font-awesome.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet" />
<style>
   /* Estilos generales */
body {
    font-family: 'Open Sans', sans-serif;
    line-height: 1.8;
    color: #555;
    background-color: #f5f7fa;
}
h1, h2, h3, h4, h5, h6 {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    color: #2c3e50;
}
.pageTitle {
    font-size: 2.8rem;
    margin-bottom: 30px;
    text-shadow: 1px 1px 4px rgba(0,0,0,0.1);
    text-align: center;
}

/* Estilos para la sección de introducción */
.about-logo {
    text-align: center;
    padding: 40px 20px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    margin-bottom: 40px;
}
.about-logo h3 {
    font-size: 2.4rem;
    margin-bottom: 25px;
    color: #2980b9;
}
.about-logo p {
    font-size: 1.5rem;
    margin-bottom: 25px;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}
.bible-quote {
    font-style: italic;
    color: #555;
    padding: 20px;
    background-color: #f8f9fa;
    border-left: 5px solid #2980b9;
    border-radius: 5px;
    max-width: 800px;
    margin: 20px auto;
}

/* Contenedor de regiones */
.regions-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 30px;
    margin-bottom: 60px;
}

/* Estilos para las tarjetas de región */
.region-card {
    display: flex;
    flex-direction: column;
    margin-bottom: 30px;
    transition: all 0.3s ease;
    border: none;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    cursor: pointer;
    background: #fff;
    min-height: 450px; /* Altura mínima para consistencia */
}
.region-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
}
.region-card img {
    width: 100%;
    height: 250px; /* Altura fija para imágenes */
    object-fit: cover;
    border-bottom: 3px solid #2980b9;
}
.region-card .card-body {
    padding: 25px;
    flex: 1;
    display: flex;
    flex-direction: column;
}
.region-card h4 {
    color: #2980b9;
    margin-bottom: 15px;
    font-size: 1.8rem;
}
.region-card p {
    flex: 1;
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 20px;
}

/* Estilo para región activa */
.region-card.active {
    border: 4px solid #2980b9;
    box-shadow: 0 12px 30px rgba(41, 128, 185, 0.3);
}

/* Estilos para las iglesias */
.church-container {
    display: none;
    margin-top: 40px;
    animation: fadeIn 0.5s ease;
}
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
.church-item {
    background: #fff;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}
.church-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}
.church-item img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 20px;
    border: 2px solid #eee;
}
.church-item h4 {
    color: #2c3e50;
    margin-bottom: 15px;
    font-size: 1.5rem;
}
.church-item p {
    margin-bottom: 10px;
    font-size: 1.1rem;
    color: #666;
}
.church-item .map-link {
    display: inline-block;
    margin-top: 15px;
    color: #2980b9;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.2s ease;
}
.church-item .map-link:hover {
    text-decoration: underline;
    color: #1a5276;
}

/* Botones */
.btn-color {
    background: #2980b9;
    color: white;
    padding: 12px 30px;
    border-radius: 50px;
    border: none;
    transition: all 0.3s ease;
    align-self: center;
    margin-top: auto;
    font-size: 1.1rem;
    font-weight: 600;
}
.btn-color:hover {
    background: #3498db;
    transform: translateY(-2px);
    color: white;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

/* Estilos para la búsqueda */
.church-search {
    margin: 40px 0;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}
#church-search-input {
    height: 55px;
    font-size: 1.2rem;
    border: 2px solid #ddd;
    border-radius: 50px;
    padding: 0 20px;
    transition: all 0.3s ease;
}
#church-search-input:focus {
    border-color: #2980b9;
    box-shadow: 0 0 8px rgba(41, 128, 185, 0.2);
    outline: none;
}
#church-search-btn {
    height: 55px;
    padding: 0 30px;
    border-radius: 50px;
    font-size: 1.1rem;
}
#search-results-count {
    margin-top: 15px;
    font-style: italic;
    display: none;
    color: #555;
    text-align: center;
}
.no-results {
    text-align: center;
    padding: 40px;
    font-size: 1.3rem;
    color: #777;
    background: #fff;
    border-radius: 10px;
    margin: 20px 0;
}

/* Mejoras en el grid de iglesias */
.church-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 30px;
}

/* Responsive */
@media (max-width: 768px) {
    .pageTitle {
        font-size: 2.2rem;
    }
    .about-logo h3 {
        font-size: 1.8rem;
    }
    .about-logo p {
        font-size: 1.2rem;
    }
    .region-card img, .church-item img {
        height: 200px;
    }
    .regions-container {
        grid-template-columns: 1fr;
    }
    .region-card {
        min-height: 400px;
    }
    .church-grid {
        grid-template-columns: 1fr;
    }
    .region-card h4, .church-item h4 {
        font-size: 1.4rem;
    }
}
@media (max-width: 576px) {
    .region-card img, .church-item img {
        height: 180px;
    }
    .btn-color {
        padding: 10px 20px;
        font-size: 1rem;
    }
    .region-card {
        min-height: 380px;
    }
}
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
                        <li><a href="noticias.php">Noticias</a></li>
                        <li class="active"><a href="iglesias.php">Iglesias</a></li>
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
                <h2 class="pageTitle">Nuestras Iglesias</h2>
            </div>
        </div>
    </div>
    </section>
    
    <section id="content">
    <div class="container">
        <div class="row"> 
            <div class="col-md-12">
                <div class="about-logo">
                    <h3>ASAMBLEAS DE HERMANOS (LIBRES) DE LA PROVINCIA DE JUJUY</h3>
                    <p>En cada rincón de nuestra hermosa provincia de Jujuy se encuentran las Iglesias - Asambleas de Hermanos (libres) y queremos dar a conocer como parte de nuestra IDENTIDAD la información básica y necesaria para quienes quieran conocerlas.</p>
                    <p>Te invitamos a que puedas conocer las Iglesias - Asambleas de Hermanos (libres) en la Provincia de Jujuy en sus diferentes regiones.</p>
                    <p class="bible-quote">"Pero recibiréis poder, cuando haya venido sobre vosotros el Espíritu Santo, y me seréis testigos en Jerusalén, en toda Judea, en Samaria, y hasta lo último de la tierra." <strong>Hechos 1:8</strong></p>
                </div>
            </div>
        </div>
        
        <!-- Sección de regiones -->
        <div class="row">
            <div class="col-md-12">
                <div class="church-search">
                    <div class="input-group">
                        <input type="text" id="church-search-input" class="form-control" placeholder="Buscar iglesia por nombre, localidad o región...">
                        <span class="input-group-btn">
                            <button class="btn btn-color" type="button" id="church-search-btn">
                                <i class="fa fa-search"></i> Buscar
                            </button>
                        </span>
                    </div>
                    <div id="search-results-count"></div>
                </div>
                <h3 class="text-center" style="margin: 60px 0 40px; font-size: 2.2rem;">Nuestras Regiones</h3>
            </div>
            
            <?php foreach($regiones as $region_key => $region_nombre): ?>
            <div class="col-md-6 col-lg-4">
                <div class="region-card" data-region="<?php echo $region_key; ?>">
                    <img src="img/<?php echo $region_key; ?>.jpg" alt="<?php echo $region_nombre; ?>">
                    <div class="card-body">
                        <h4><?php echo $region_nombre; ?></h4>
                        <p><?php echo obtenerDescripcionRegion($region_key); ?></p>
                        <button class="btn btn-color">Ver iglesias</button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Contenedores de iglesias por región -->
        <?php foreach($regiones as $region_key => $region_nombre): ?>
        <div class="row church-container" id="<?php echo $region_key; ?>-churches">
            <div class="col-md-12">
                <h3 class="text-center" style="margin: 40px 0; font-size: 2rem;">Iglesias en <?php echo $region_nombre; ?></h3>
            </div>
            <div class="col-md-12">
                <div class="church-grid">
                    <?php 
                    $iglesias = obtenerIglesiasPorRegion($region_key);
                    if(count($iglesias) > 0): 
                        foreach($iglesias as $iglesia): ?>
                        <div class="church-item">
                            <img src="<?php echo htmlspecialchars($iglesia['imagen']); ?>" alt="<?php echo htmlspecialchars($iglesia['nombre']); ?>">
                            <h4><?php echo htmlspecialchars($iglesia['nombre']); ?></h4>
                            <p><strong>Localidad:</strong> <?php echo htmlspecialchars($iglesia['localidad']); ?></p>
                            <p><strong>Dirección:</strong> <?php echo htmlspecialchars($iglesia['direccion']); ?></p>
                            <?php if(!empty($iglesia['mapa_url'])): ?>
                            <a href="<?php echo htmlspecialchars($iglesia['mapa_url']); ?>" class="map-link" target="_blank">Ver en mapa &rarr;</a>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; 
                    else: ?>
                        <div class="col-md-12">
                            <p class="no-results">No hay iglesias registradas en esta región.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    </section>
    
    <footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="widget">
                    <h5 class="widgetheading">Nuestro Contacto</h5>
                    <address>
                    <strong>Email:</strong> contacto@iglesiasunidadejujuy.com<br>
                    <strong>Teléfono:</strong> +54 388 1234567
                    </address>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="widget">
                    <h5 class="widgetheading">Síguenos</h5>
                    <ul class="social-network">
                        <li><a href="#" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" data-placement="top" title="YouTube"><i class="fa fa-youtube"></i></a></li>
                        <li><a href="#" data-placement="top" title="Instagram"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright">
                        <p class="text-center">
                            &copy; <?php echo date('Y'); ?> Iglesias Unidas de Jujuy. Todos los derechos reservados.
                        </p>
                    </div>
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

<script>
    $(document).ready(function(){
        // Variables para controlar el estado
        let currentRegion = null;
        
        // Ocultar todas las secciones de iglesias al cargar
        $('.church-container').hide();
        
        // Manejar clic en las tarjetas de región
        $('.region-card').click(function(){
            var region = $(this).data('region');
            var targetSection = $('#' + region + '-churches');
            
            // Si estamos haciendo clic en la misma región
            if(currentRegion === region) {
                // Ocultar la sección y quitar la clase active
                targetSection.hide();
                $(this).removeClass('active');
                currentRegion = null;
                return;
            }
            
            // Remover clase active de todas las tarjetas
            $('.region-card').removeClass('active');
            // Agregar clase active a la tarjeta clickeada
            $(this).addClass('active');
            
            // Ocultar todas las secciones de iglesias
            $('.church-container').hide();
            
            // Mostrar solo la sección correspondiente
            targetSection.fadeIn(300);
            
            // Actualizar la región actual
            currentRegion = region;
            
            // Desplazarse suavemente a la sección
            $('html, body').animate({
                scrollTop: targetSection.offset().top - 100
            }, 500);
        });
        
        // Función para buscar iglesias
        let searchTimeout;
        function searchChurches(query) {
            clearTimeout(searchTimeout);
            
            searchTimeout = setTimeout(function() {
                query = query.toLowerCase().trim();
                
                if (!query) {
                    $('.church-item').show();
                    $('#search-results-count').hide();
                    
                    // Si había una región activa, volver a mostrarla
                    if(currentRegion) {
                        $('#' + currentRegion + '-churches').show();
                    } else {
                        $('.church-container').hide();
                    }
                    return;
                }
                
                // Mostrar todas las secciones de iglesias
                $('.church-container').show();
                
                // Contador de resultados
                var resultsCount = 0;
                
                // Ocultar todas las iglesias primero
                $('.church-item').hide();
                
                // Filtrar iglesias
                $('.church-item').each(function() {
                    var churchName = $(this).find('h4').text().toLowerCase();
                    var churchLocation = $(this).find('p:contains("Localidad:")').text().toLowerCase().replace('localidad:', '').trim();
                    var churchAddress = $(this).find('p:contains("Dirección:")').text().toLowerCase().replace('dirección:', '').trim();
                    
                    if (churchName.includes(query) || 
                        churchLocation.includes(query) || 
                        churchAddress.includes(query)) {
                        $(this).show();
                        resultsCount++;
                    }
                });
                
                // Mostrar contador de resultados
                if (resultsCount > 0) {
                    $('#search-results-count').html('Se encontraron <strong>' + resultsCount + '</strong> iglesias').show();
                } else {
                    $('#search-results-count').html('No se encontraron iglesias que coincidan con "<strong>' + query + '</strong>"').show();
                }
                
                // Desplazarse a la primera iglesia encontrada
                if (resultsCount > 0) {
                    $('html, body').animate({
                        scrollTop: $('.church-item:visible').first().offset().top - 150
                    }, 500);
                }
                
                // Actualizar el estado de la región actual
                currentRegion = null;
                $('.region-card').removeClass('active');
            }, 300);
        }
        
        // Manejar búsqueda al hacer clic en el botón
        $('#church-search-btn').click(function() {
            var query = $('#church-search-input').val();
            searchChurches(query);
        });
        
        // Manejar búsqueda al presionar Enter
        $('#church-search-input').keypress(function(e) {
            if (e.which === 13) {
                var query = $(this).val();
                searchChurches(query);
            }
        });
        
        // Manejar búsqueda en tiempo real con debounce
        $('#church-search-input').on('input', function() {
            var query = $(this).val();
            if(query.length >= 3 || query.length === 0) {
                searchChurches(query);
            }
        });
    });
</script>
</body>
</html>