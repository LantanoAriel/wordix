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
function mostrarMenu()
{
    //$opcionElegida
    echo "\n";
    echo "***************************************************** \n";
    echo "1) Jugar Wordix con una palabra predeterminada \n";
    echo "2) Jugar Wordix con una palabra aleatoria \n";
    echo "3) Mostrar una partida \n";
    echo "4) Mostrar la primera partida ganadora \n";
    echo "5) Mostrar resumen de un jugador \n";
    echo "6) Mostrar listado de partidas ordenadas por jugador y por palabra \n";
    echo "7) Agregar una palabra de 5 letras \n";
    echo "8) Salir \n";
    echo "***************************************************** \n";
}

/** Muestra los datos de la partida jugada
 * @param array $coleccionJuegos
 * @param int $nIndice
 * @return void 
 */
function mostrarDatos($coleccionJuegos, $nIndice){
    $datoPartida = $coleccionJuegos[$nIndice];
    $nIndice  = ++$nIndice;
    echo "Datos de la partida: \n" . "Nombre: " . $datoPartida["jugador"]. "\n" . "Palabra: " . $datoPartida["palabraWordix"] ."\n". "Puntaje: " . $datoPartida["puntaje"] . "\n". "Cantidad de intentos: " . $datoPartida["intentos"];
}


function comparar($a, $b) //esta funcion nos permitira realizar la comparacion para $coleccionPalabras
{
if($a["jugador"] == $b["jugador"]) {
   $orden=0;
}
elseif ($a["jugador"] < $b["jugador"]) {
    $orden=-1;
 }
 else {
    $orden=1;
 }
 
return $orden;
}
//Esta funcion es llamada dentro de la funcion ordenarArray para la opcion 6 del menu -M


function comparar2($a, $b) //esta funcion nos permitira realizar la comparacion para $coleccionPalabras
{
if($a["palabraWordix"] == $b["palabraWordix"]) {
   $orden=0;
}
elseif ($a["palabraWordix"] < $b["palabraWordix"]) {
    $orden=-1;
 }
 else {
    $orden=1;
 }
 
 //Esta funcion tambien es llamada dentro de la funcion ordenarArray para la opcion 6 del menu -M
return $orden;
}


 /**
 * funcion para ordenar la coleccion de partidas
 * @param array $sinOrdenar
 */
function ordenarArray($sinOrdenar)
{
uasort($sinOrdenar, "comparar2");
uasort($sinOrdenar, "comparar");
print_r($sinOrdenar);
}  
//esta es la funcion sin retorno que se nos pedia en el inciso para la opcion 6 del menu -M



/** 
* solicita un nombre de jugador y lo convierte en minusculas
* @return string 
*/
function solicitarJugador (){
// string $nombreJugador, $primero, minusculas //
echo "ingrese un nombre de jugador:";
$nombreJugador = trim(fgets(STDIN));
$primero = $nombreJugador[0];
while ($primero >=0 && $primero  <= 9) {
    echo "el primer caracter del nombre debe ser una letra. \n"; 
    echo "ingrese un nombre de jugador:";
    $nombreJugador = trim(fgets(STDIN));
    $primero = $nombreJugador[0];
}
$jugador = strtolower($nombreJugador);

return $jugador;
}
//esta funcion la puse en la opcion 1 y 2 del menu -M



/** 
* solicita un nombre de jugador y muestra el resumen de sus partidas
* @param array $arrayResumen
* @param string $nombreJ
* @return string 
*/
function resumenJugadores ($arrayResumen, $nombreJ){
    //string $resumen//
    
    echo "\n";
    $key = array_search("$nombreJ", array_column($arrayResumen, 'jugador'));
    if ($arrayResumen[$key]["jugador"]==$nombreJ) {
       
       $resumen = print_r($arrayResumen[$key]);
    } else {
       $resumen = "\n el jugador ingresado aun no jugo una partida";
       echo $resumen;
   }
   return $resumen;
   }
   
   //esta funcion la realize para la opcion 5 del menu :) -M
   

/* ... COMPLETAR ... */



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//DECLARACION DE VARIABLES:

/*
<<<<<<< HEAD
string $jugador, $palabraJuego, $nombreJ, $deNuevo, $nuevaPalabra
int $opcionElegida, $numPalabra, $elMax, $elMin, $nPartida, $conteo, $aleatoria
bool $verificaPalabra
=======
*string $jugador, $palabraJuego, $nombreJ, $deNuevo, $nuevaPalabra
*int $opcionElegida, $numPalabra, $elMax, $elMin, $nPartida
*bool $verificaPalabra
*
>>>>>>> d140536f4b86c8ab4ae350f70f394e38e51704c7
*/



//INICIALIZACION DE VARIABLES:
$nPartida = 0;

$miColeccionPalabras = [];
$coleccionPartidas = [];
$miColeccionPalabras = cargarColeccionPalabras($miColeccionPalabras);
$coleccionPartidas = cargarColeccionPartidas($coleccionPartidas);
$partidasGanadas = [];
$i = 10;

//PROCESO:

//print_r($partida);
//imprimirResultado($partida);


do {
    mostrarMenu();
    echo "Seleccione una de las opciones: \n";
    $opcionElegida = trim(fgets(STDIN));


    switch ($opcionElegida) {
        case 1:
            echo " Bienvenido! \n";
            $jugador=solicitarJugador();
            $elMax = miMaxInd($miColeccionPalabras);
            $elMin = miMenInd($elMax);
            $numPalabra = solicitarNumeroEntre($elMin, $elMax);
            $palabraJuego = $miColeccionPalabras[$numPalabra];
            $coleccionPartidas[$i] = jugarWordix($palabraJuego, $jugador);
            $i++;
          


            //Aca ya te arreglé las cosas con los problemas que te repetian. -Ariel 
            //Solo falta poner unas cosas mas respecto a las condiciones que da 


            break;
        case 2:
            echo " Bienvenido! \n";
            $jugador=solicitarJugador();
            $conteo = count($miColeccionPalabras);
            $aleatoria = mt_rand(0, $conteo - 1);
            $palabraAleatoria = $miColeccionPalabras[$aleatoria];
            $coleccionPartidas[$i] = jugarWordix($palabraAleatoria, $jugador);
            $i++;
           
            
            //llega a jugar con una palabra aleatoria, tiene el mismo error que el caso 1, se repite (y la funcion "mt_rand" la saque de internet) -B
            //por las dudas no dejé declaradas la variables $conteo, $aleatoria y $resultado -BRUUUNO
            //Ya te arreglé el tema de la repeticion infinita :) -ARIEL
            //Lo mismo que arriba, hay que terminar lo de las condiciones -ARIEL

            //jugar al wordix con una palabra aleatoria
        

            break;
        case 3:
            //$elMax = miMaxInd($coleccionPartidas);
            //$elMin = miMenInd($elMax);

           // echo "seleccione una partida entre la partida numero " . $elMin . " y la numero " . $elMax;
           echo "ingrese: ";
            $indice = trim(fgets(STDIN));
            $indice--;
            if ($indice >= 0 && $indice < count($coleccionPartidas)) {
                mostrarDatos($coleccionPartidas, $indice);
            } else {
                echo "El número ingresado no corresponde a ningún juego.\n";
            }


           /* $elMax = miMaxInd($coleccionPartidas);
            $elMin = miMenInd($elMax);
            do {
                echo "seleccione una partida entre la partida numero " . $elMin . " y la numero " . $elMax;
                $nPartida = trim(fgets(STDIN));
                echo "PARTIDA NÚMERO: " . $nPartida;
                print_r($coleccionPartidas[$nPartida]);
                echo "Desea ver otra partida? Si/No";
                $deNuevo = trim(fgets(STDIN));
                strtoupper($deNuevo);
            } while ($deNuevo == "SI");
            */
            //mostrar una partida  

            //NO PRESTEN MUCHA ATENCION A ESTO, ESTOY PROBANDO COSAS Y POR AHORA VA RE BIEN LA 3. -ARIEL

            break;
        case 4:
            solicitarJugador();
            
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
        echo "Listado ordenado de las partidas jugadas";
        ordenarArray($coleccionPartidas);

            //mostrar listado de partidas ordenados por jugador y por palabra
            //aca llame la funcion que hice arriba xd -M

            break;
        case 7:

            echo "ingrese la palabra que quiera agregar a wordix:";
            $nuevaPalabra = trim(fgets(STDIN));
            $verificaPalabra = esPalabra($nuevaPalabra);
            $nuevaPalabra = strtoupper($nuevaPalabra);

            if( $verificaPalabra == 1 && strlen($nuevaPalabra) == 5){
                array_push($miColeccionPalabras,$nuevaPalabra);
                print_r($miColeccionPalabras);
            }
            elseif($verificaPalabra != 1){
                echo "Lo ingresado debe ser una palabra";
            }
            else{
                echo "Su palabra debe ser de una longitud de 5 letras";
            }


            //agregar una palabra de 5 letras a wordix YA LO HICE! :D -ARIEL

            break;
        case 8:
            //Salir

            break;
    }
} while ($opcionElegida != 8);
