<?php

function obtenerFirma($nombre, $carpeta)
{
    $nombre = trim($nombre);

    // Quitar acentos
    $nombre = iconv(
        'UTF-8',
        'ASCII//TRANSLIT//IGNORE',
        $nombre
    );

    // Convertir a minúsculas
    $nombre = strtolower($nombre);

    // Separar palabras
    $partes = preg_split('/\s+/', $nombre);

    if (count($partes) < 2) {
        return '';
    }

    $candidatos = array();

    // Nombre + segundo elemento
    $candidatos[] = $partes[0] . '_' . $partes[1];

    // Nombre + tercer elemento
    if (count($partes) >= 3) {
        $candidatos[] = $partes[0] . '_' . $partes[2];
    }

    foreach ($candidatos as $archivo) {

        $ruta = RUTA_FIRMAS . '/' . $carpeta . '/' . $archivo . '.png';

        if (file_exists($ruta)) {
            return $ruta;
        }
    }

    return '';
}
