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
function mostrarMenu (){
    //$opcionElegida
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
string $jugador, $palabraJuego, $nombreJ, $deNuevo
int $opcionElegida, $numPalabra, $elMax, $elMin, $nPartida

*/



//INICIALIZACION DE VARIABLES:
$nPartida = 0;

$miColeccionPalabras = [];
$miColeccionPalabras=cargarColeccionPalabras($miColeccionPalabras);
$resumenGlobal = [];
$partidasGanadas = [];
//PROCESO:

//print_r($partida);
//imprimirResultado($partida);


do {
    mostrarMenu();
    echo "Seleccione una de las opciones: \n";
    $opcionElegida = trim(fgets(STDIN));

    
    switch ($opcionElegida) {
        case 1: 
            echo " Bienvenido! Por favor ingrese su nombre. \n";
            $jugador = trim(fgets(STDIN));
                $elMax = miMaxInd($miColeccionPalabras);
                $elMin = miMenInd($elMax);
                $numPalabra = solicitarNumeroEntre($elMin, $elMax);
                //echo $numPalabra; //creo que este echo esta de mas -B
                $palabraJuego = $miColeccionPalabras[$numPalabra];
                $resultado = jugarWordix($palabraJuego, $jugador);

                //hasta acá llega a jugar con la palabra elegida, igual hay un error en la ejecucion y se repite, no sé porqué -B
            

            break;
        case 2: 
            
                $conteo = count($miColeccionPalabras);
                $aleatoria = mt_rand(0, $conteo - 1);
                $palabraAleatoria = $miColeccionPalabras[$aleatoria];
                $resultado = jugarWordix($palabraAleatoria, $jugador);
                //llega a jugar con una palabra aleatoria, tiene el mismo error que el caso 1, se repite (y la funcion "mt_rand" la saque de internet) -B
                //por las dudas no dejé declaradas la variables $conteo, $aleatoria y $resultado -B
            
            //jugar al wordix con una palabra aleatoria

            break;
        case 3: 
            
                $elMax = miMaxInd($coleccionPartidas);
                $elMin = miMenInd($elMax);
                do {
                echo "seleccione una partida entre la". $elMin . "y la". $elMax;
                $nPartida = trim(fgets(STDIN));
                echo "PARTIDA NÚMERO:". $nPartida;
                print_r($coleccionPartidas[$nPartida]);
                echo "desea ver otra partida?(s/n)";
                } while ($deNuevo == "si");
            
            //mostrar una partida

            break;
        case 4:
            
                echo "PRIMERA PARTIDA GANADORA:";
                print_r($partidasGanadas[0]);
                
            
            //mostrar la primera partida ganadora

            break;
        case 5: 
            
                do {
                echo "escriba el nombre del jugador";
                $nombreJ = trim(fgets(STDIN));
                print_r($resumenGlobal[$nombreJ]);
                echo "desea ver el resumen de otro jugador?(s/n)";
                } while ($deNuevo == "si");
            
            //mostrar resumen de jugador

            break;
        case 6:
            
                
            
            //mostrar listado de partidas ordenados por jugador y por palabra

            break;
        case 7: 
            
                echo "ingrese la palabra que quiera agregar a wordix:";
                $nuevaPalabra = trim(fgets(STDIN));
                $verificaPalabra = esPalabra($nuevaPalabra);
                if ($verificaPalabra) {
                    //añadir la palabra al array que aun no estoy seguro como se hace xd
                }
            
            //agregar una palabra de 5 letgras a wordix

            break;
        case 8:
            //Salir

            break;

  }} while ($opcionElegida != 8);
    