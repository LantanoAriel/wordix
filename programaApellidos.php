<?php
include_once("wordix.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* 
Diaz, Fabricio. FAI-4210. TUWD. dfabricio255@gmail.com. diazfabrici0
Ferrada, Bruno. FAI-3307. TUDW. brunoferrada1212@gmail.com. BrunoFerrada
Ferrada, Mauro. FAI-4211. TUDW. mauroferrada01@gmail.com. MauroFerrada
Lantaño, Daniel Ariel. FAI-2305. TUDW. s.lantanoariel@gmail.com. lantanoariel
*/
/* ... COMPLETAR ... */



/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

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

function palabraElegida()
 {
    
}

/* ... COMPLETAR ... */



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//DECLARACION DE VARIABLES:

/*
string $jugador

*/



//INICIALIZACION DE VARIABLES:



//PROCESO:

echo " Bienvenido! Por favor ingrese su nombre. \n";
$jugador = trim(fgets(STDIN));
escribirMensajeBienvenida($jugador);

echo"Elija una opcion: \n";
$opcionElegida = trim(fgets(STDIN));

//print_r($partida);
//imprimirResultado($partida);




do {
    $opcion = $opcionElegida;

    
    switch ($opcion) {
        case 1: 
            //jugar al wordix con una palabra elegida

            break;
        case 2: 
            //jugar al wordix con una palabra aleatoria

            break;
        case 3: 
            //mostrar una partida

            break;
        case 4:
            //mostrar la primera partida ganadora

            break;
        case 5: 
            //mostar resumen de jugador

            break;
        case 6:
            //mostrar listado de partidas ordenados por jugador y por palabra

            break;
        case 7: 
            //agregar una palabra de 5 letgras a wordix

            break;
        case 8:
            //salir

            break;

  }} while ($opcion != 8);
    