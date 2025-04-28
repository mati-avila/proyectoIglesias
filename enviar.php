<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger datos del formulario
    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $asunto = $_POST['subject'] ?? 'Mensaje desde el sitio web';
    $mensaje = $_POST['message'];
    
    // Dirección de correo a la que llegará el mensaje
    $destinatario = "contacto@iglesiasunidasdejujuy.com";
    
    // Cabeceras del correo
    $headers = "From: $nombre <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    // Contenido del correo
    $contenido = "
    <html>
    <body>
    <h2>Nuevo mensaje desde el sitio web</h2>
    <p><strong>Nombre:</strong> $nombre</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Asunto:</strong> $asunto</p>
    <p><strong>Mensaje:</strong></p>
    <p>$mensaje</p>
    </body>
    </html>
    ";
    
    // Enviar el correo
    $envio = mail($destinatario, $asunto, $contenido, $headers);
    
    // Redireccionar con mensaje de éxito o error
    if ($envio) {
        header('Location: contactos.html?status=success');
    } else {
        header('Location: contactos.html?status=error');
    }
} else {
    header('Location: contactos.html');
}
?>