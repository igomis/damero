<?php
header('Content-Type: application/json');

// Leer el cuerpo de la petición
$contenido = file_get_contents('php://input');
$datos = json_decode($contenido, true);

// Aquí iría la lógica para validar el movimiento basada en $datos['origen'] y $datos['destino']
// Por ahora, retornaremos un valor aleatorio para el ejemplo
$esValido = rand(0, 1) == 1;

// Devolver la respuesta
echo json_encode(['valid' => $esValido,'datos'=>$datos]);
