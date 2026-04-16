<?php

    // Solicitud de publicación
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // campos del formulario
        $name = strip_tags(trim($_POST["name"]));
		$name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $phone = trim($_POST["phone"]);
        $city = trim($_POST["city"]);
        $select_opt = trim($_POST["select_opt"]);
        $zip = trim($_POST["zip"]);
        $comment = trim($_POST["comment"]);

        // Check enviado al correo.
        if ( empty($name) OR empty($comment) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Por favor complete el formulario e inténtelo nuevamente.";
            exit;
        }

        // Establezca la dirección de correo electrónico del destinatario.
        $recipient = "camilo.roblesmateus962@gmail.com";

        // Configure el subdirectorio de correo electrónico.
        $sub = "Consulta web mersingenieriasolar.com $name";

        // Cree el contenido del correo electrónico.
        $email_content = "name: $name\n";
        $email_content = "email: $email\n\n";
        $email_content = "phone: $phone\n\n";
        $email_content = "city: $city\n\n";
        $email_content = "select_opt: $select_opt\n\n";
        $email_content = "zip: $zip\n\n";
        $email_content = "Comment:\n$comment\n";
     

        // Cree los encabezados de correo electrónico.
        $email_headers = "From: $name <$email>";

        // Envia el correo electronico
		$okk = mail($recipient, $email_headers, $email_content);
        if ( $okk ) {
            // Establezca un código de respuesta 200 (aceptar).
            http_response_code(200);
            echo "¡Gracias! Su mensaje ha sido enviado con exito.";
        } else {
            // Establezca un código de respuesta 500 (error interno del servidor).
            http_response_code(500);
            echo "¡Ups! Algo salió mal y no pudimos enviar tu mensaje.";
        }

    } else {
        // No es una solicitud POST, establezca un código de respuesta 403 (prohibido).
        http_response_code(403);
        echo "Hubo un problema con tu envío, inténtalo de nuevo.";
    }

?>
