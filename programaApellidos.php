<?php
include_once("wordix.php");

/* 
Diaz, Fabricio. FAI-4210. TUWD. dfabricio255@gmail.com. diazfabrici0
Ferrada, Bruno. FAI-3307. TUDW. brunoferrada1212@gmail.com. BrunoFerrada
Ferrada, Mauro. FAI-4211. TUDW. mauroferrada01@gmail.com. MauroFerrada
Lantaño, Daniel Ariel. FAI-2305. TUDW. s.lantanoariel@gmail.com. lantanoariel
*/

/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/** Muestra el menú para el usuario
 * @param string $player
 */
function mostrarMenu ($player){
    //$opcionElegida
    escribirMensajeBienvenida($player);
    echo "\n";
    echo "***************************************************** \n";
    echo "1) Jugar Wordix con una palabra predeterminada \n";
    echo "2) Jugar Wordix con una palabra aleatoria \n";
    echo "3) Mostrar una partida \n";
    echo "4) Mostrar la primera partida ganadora \n";
    echo "5) Mostrar resumen de un jugador \n";
    echo "6) Mostrar listado de highscore \n";
    echo "7) Agregar una palabra de 5 letras \n";
    echo "8) Salir \n";
    echo "***************************************************** \n";
}
/* ... COMPLETAR ... */



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//DECLARACION DE VARIABLES:

/*
string $jugador, $palabraJuego
int $opcionElegida, $numPalabra, $elMax, $elMin

*/



//INICIALIZACION DE VARIABLES:
$miColeccionPalabras = [];
$miColeccionPalabras=cargarColeccionPalabras($miColeccionPalabras);


//PROCESO:

//print_r($partida);
//imprimirResultado($partida);

echo " Bienvenido! Por favor ingrese su nombre. \n";
$jugador = trim(fgets(STDIN));
echo mostrarMenu($jugador);

echo "*Elija una opcion*\n";

$opcionElegida = trim(fgets(STDIN));

do {
   

    
    switch ($opcionElegida) {
        case 1: 
            if($opcionElegida == 1){
                $elMax = miMaxInd($miColeccionPalabras);
                $elMin = miMenInd($elMax);
                $numPalabra = solicitarNumeroEntre($elMin, $elMax);
                //echo $numPalabra; //creo que este echo esta de mas -B
                $palabraJuego = $miColeccionPalabras[$numPalabra];
                $resultado = jugarWordix($palabraJuego, $jugador);
                //hasta acá llega a jugar con la palabra elegida, igual hay un error en la ejecucion y se repite, no sé porqué -B
            }

            break;
        case 2: 
            if($opcionElegida == 2){
                
            }
            //jugar al wordix con una palabra aleatoria

            break;
        case 3: 
            if($opcionElegida == 3){
                
            }
            //mostrar una partida

            break;
        case 4:
            if($opcionElegida == 4){
                
            }
            //mostrar la primera partida ganadora

            break;
        case 5: 
            if($opcionElegida == 5){
                
            }
            //mostrar resumen de jugador

            break;
        case 6:
            if($opcionElegida == 6){
                
            }
            //mostrar listado de partidas ordenados por jugador y por palabra

            break;
        case 7: 
            if($opcionElegida == 7){
                
            }
            //agregar una palabra de 5 letgras a wordix

            break;
        case 8:
            //Salir

            break;

  }} while ($opcionElegida != 8);
    