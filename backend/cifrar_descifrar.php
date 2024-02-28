<?php

function cifrarDescifrar($texto, $accion) {
    $alfabeto = 'abcdefghijklmnopqrstuvwxyz';
    $desplazamientoExterior = 3;
    $desplazamientoInterior = 5;

    $resultado = '';

    for ($i = 0; $i < strlen($texto); $i++) {
        $letra = $texto[$i];

        if (ctype_alpha($letra)) {
            $indice = strpos($alfabeto, strtolower($letra));

            if ($indice !== false) {
                if ($accion == 'cifrar') {
                    $nuevoIndice = ($indice + $desplazamientoExterior) % strlen($alfabeto);
                    $nuevaLetra = $alfabeto[$nuevoIndice];
                    $resultado .= $nuevaLetra;
                } elseif ($accion == 'descifrar') {
                    $nuevoIndice = ($indice - $desplazamientoExterior + strlen($alfabeto)) % strlen($alfabeto);
                    $nuevaLetra = $alfabeto[$nuevoIndice];
                    $resultado .= $nuevaLetra;
                }
            }
        } else {
            $resultado .= $letra;
        }
    }

    return $resultado;
}

$texto = $_POST['texto'] ?? '';
$accion = $_POST['accion'] ?? '';

if (!empty($texto) && !empty($accion)) {
    $resultado = cifrarDescifrar($texto, $accion);
    echo "Texto " . ($accion == 'cifrar' ? 'cifrado' : 'descifrado') . ": $resultado";
} else {
    echo "Por favor, ingresa un texto y selecciona una acción.";
}

?>
