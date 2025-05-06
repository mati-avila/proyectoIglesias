<?php
// funciones.php
require_once 'config.php';

function obtenerDescripcionRegion($region) {
    $descripciones = [
        'puna' => 'La inmensidad del cielo se funde con la belleza del Altiplano...',
        'quebrada' => 'Un lienzo natural de colores vibrantes...',
        'valles' => 'Un oasis verde en medio del árido paisaje...',
        'yungas' => 'Un bosque nuboso lleno de vida...',
        'sanpedro' => 'Una región de contrastes donde nuestras iglesias...',
        'capital' => 'El corazón urbano de Jujuy donde nuestras iglesias...'
    ];
    return $descripciones[$region] ?? 'Descripción no disponible';
}

function obtenerIglesiasPorRegion($region) {
    global $db;
    try {
        $stmt = $db->prepare("SELECT * FROM iglesias WHERE region = :region AND activo = 1 ORDER BY nombre");
        $stmt->bindParam(':region', $region);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Error al obtener iglesias por región: " . $e->getMessage());
        return [];
    }
}


function buscarIglesias($termino) {
    global $db;
    $termino = "%$termino%";
    $stmt = $db->prepare("SELECT * FROM iglesias 
                         WHERE (nombre LIKE :termino OR localidad LIKE :termino OR direccion LIKE :termino) 
                         AND activo = 1 ORDER BY nombre");
    $stmt->bindParam(':termino', $termino);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function obtenerNoticias($limite = 4) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM noticias WHERE activo = 1 ORDER BY fecha DESC LIMIT :limite");
    $stmt->bindParam(':limite', $limite, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function obtenerNoticiaPorId($id) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM noticias WHERE id = :id AND activo = 1");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>