<?php

/**
 * Obtiene una colección de palabras
 * @return array
 */
function cargarColeccionPalabras()
{
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS", 
        "PERRO", "PLAZA", "DANZA", "LAPIZ", "RELOJ"
        ];

    return ($coleccionPalabras);
}

/** Determina el indice maximo de un array
 * @param array $coleccionPal
 * @return int
 */
function miMaxInd($coleccionPal)
{
    //int $maxInd
    $coleccionPal = cargarColeccionPalabras($coleccionPal);
    $maxInd = count($coleccionPal)-1;
    return ($maxInd);
}

/** Determina el indice Minimode un array
 * @param int $elMax
 * @return int
 */
function miMenInd ($elMax){
    //int $minInd
    $minInd = $elMax - $elMax;
    return ($minInd);
}

$ind=0;
$maxIndice=miMaxInd($ind);
echo $maxIndice . "\n";
$minIndice=miMenInd($maxIndice);
echo $minIndice;
