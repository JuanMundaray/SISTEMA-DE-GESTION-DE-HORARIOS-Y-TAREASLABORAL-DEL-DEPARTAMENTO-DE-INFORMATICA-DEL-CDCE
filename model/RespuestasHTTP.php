<?php

// Respuestas OK

// La solicitud ha tenido éxito.
function response200($message = null, $data = '') {
    echo "Success: " . json_encode($data) . "\n";
    return [
        'statusCode' => 200,
        'message' => $message,
        'data' => $data
    ];
}

// La solicitud ha tenido éxito y se ha creado un nuevo recurso como resultado de ello.
function response201($message = null, $data = '') {
    echo "Created: " . json_encode($data) . "\n";
    return [
        'statusCode' => 201,
        'message' => $message,
        'data' => $data
    ];
}

// La petición se ha completado con éxito pero su respuesta no tiene ningún contenido
function response204($message = null, $data = '') {
    echo "No Content\n";
    return [
        'statusCode' => 204,
        'message' => $message,
        'data' => $data
    ];
}

// Respuestas de ERROR

// Esta respuesta significa que el servidor no pudo interpretar la solicitud dada una sintaxis inválida.
function response400($message = null, $data = null, $error = '') {
    echo "Bad Request: " . $error . "\n";
    return [
        'statusCode' => 400,
        'message' => $message,
        'data' => $data
    ];
}

// Es necesario autenticar para obtener la respuesta solicitada. Esta es similar a 403, pero en este caso, la autenticación es posible.
function response401($message = null, $data = null, $error = '') {
    echo "Unauthorized: " . $error . "\n";
    return [
        'statusCode' => 401,
        'message' => $message,
        'data' => $data
    ];
}

// El cliente no posee los permisos necesarios para cierto contenido, por lo que el servidor está rechazando otorgar una respuesta apropiada.
function response403($message = null, $data = null, $error = '') {
    echo "Forbidden: " . $error . "\n";
    return [
        'statusCode' => 403,
        'message' => $message,
        'data' => $data
    ];
}

// El servidor no pudo encontrar el contenido solicitado. Este código de respuesta es uno de los más famosos dada su alta ocurrencia en la web.
function response404($message = null, $data = null, $error = '') {
    echo "Not Found: " . $error . "\n";
    return [
        'statusCode' => 404,
        'message' => $message,
        'data' => $data
    ];
}

// El servidor ha encontrado una situación que no sabe cómo manejarla.
function response500($message = null, $data = null, $error = '') {
    echo "Internal Server Error: " . $error . "\n";
    return [
        'statusCode' => 500,
        'message' => $message,
        'data' => $data
    ];
}

?>
