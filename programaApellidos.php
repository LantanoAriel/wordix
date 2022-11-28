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
 * @return void
 */
function mostrarMenu()
{
    //$opcionElegida
    echo "\n";
    echo "**********************************************************************\n";
    echo "* 1) Jugar Wordix con una palabra predeterminada                     *\n";
    echo "* 2) Jugar Wordix con una palabra aleatoria                          *\n";
    echo "* 3) Mostrar una partida                                             *\n";
    echo "* 4) Mostrar la primera partida ganadora                             *\n";
    echo "* 5) Mostrar resumen de un jugador                                   *\n";
    echo "* 6) Mostrar listado de partidas ordenadas por jugador y por palabra *\n";
    echo "* 7) Agregar una palabra de 5 letras                                 *\n";
    echo "* 8) Salir                                                           *\n";
    echo "********************************************************************** \n";
}

/** Muestra los datos de la partida jugada
 * @param array $coleccionJuegos
 * @param int $nIndice
 * @return void 
 */
function mostrarDatos($coleccionJuegos, $nIndice)
{
    $datoPartida = $coleccionJuegos[$nIndice];
    $nIndice  = ++$nIndice;
    echo $nIndice;
    echo "Datos de la partida: \n" . "Nombre: " . $datoPartida["jugador"] . "\n" . "Palabra: " . $datoPartida["palabraWordix"] . "\n" . "Puntaje: " . $datoPartida["puntaje"] . "\n" . "Adivino en el intento: " . $datoPartida["intentos"];
}

/** Permite realizar la comparacion para $comparacionPalabras
 * @param string @a
 * @param string @b
 * @return int
 */
function comparar($a, $b) 
{
    if ($a["jugador"] == $b["jugador"]) {
        $orden = 0;
    } elseif ($a["jugador"] < $b["jugador"]) {
        $orden = -1;
    } else {
        $orden = 1;
    }

    return $orden;
}

//Esta funcion es llamada dentro de la funcion ordenarArray para la opcion 6 del menu -M

/** Permite realizar la comparacion para $coleccionPalabras
 * @param string $a
 * @param string $b
 * @return int
 */
function comparar2($a, $b) //esta funcion nos permitira realizar la comparacion para $coleccionPalabras
{
    if ($a["palabraWordix"] == $b["palabraWordix"]) {
        $orden = 0;
    } elseif ($a["palabraWordix"] < $b["palabraWordix"]) {
        $orden = -1;
    } else {
        $orden = 1;
    }

    //Esta funcion tambien es llamada dentro de la funcion ordenarArray para la opcion 6 del menu -M
    return $orden;
}


/**
 * funcion para ordenar la coleccion de partidas
 * @param array $sinOrdenar
 * @return void
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
function solicitarJugador()
{
    $aux = false;

    do {
        echo "Ingrese el nombre del jugador: \n";
        $jugador = trim(fgets(STDIN));
        $vali = substr($jugador, 0, 1);
        if (ctype_alpha($vali)) {
            $jugador = strtolower($jugador);
            $aux = true;
        } else {
            echo "El nombre ingresado debe empezar con una letra del alfabeto. \n";
        }
    } while ($aux == false);

    return $jugador;
}



/** 
 * solicita un nombre de jugador y muestra el resumen de sus partidas
 * @param array $arrayResumen
 * @param string $nombreJ
 * @return string 
 */
function resumenJugadores($arrayResumen, $nombreJ)
{
    //string $resumen//

    echo "\n";
    $key = array_search("$nombreJ", array_column($arrayResumen, 'jugador'));
    if ($arrayResumen[$key]["jugador"] == $nombreJ) {

        $resumen = print_r($arrayResumen[$key]);
    } else {
        $resumen = "\n el jugador ingresado aun no jugo una partida";
        echo $resumen;
    }
    return $resumen;
}



/** Verifica si el usuario ya uso una palabra
 * @param string $usuario
 * @param string $palabra
 * @param array $comprobar
 * @return boolean
 */
function palabraRepetida($usuario, $palabra, $comprobar)
{
    // boolean $aux
    $aux = false;
    foreach ($comprobar as $key => $elemento) {
        if ($elemento['jugador'] == $usuario && $elemento['palabraWordix'] == $palabra) {
            $aux = true;
        }
    }
    if ($aux) {
        return $aux;
    } else {
        return $aux;
    }
}
/**
 * 
 */
function primerPartidaGanada($usuario, $miColeccionPartidas)
{
    $aux = 0;
    for ($i = 0; $i < count($miColeccionPartidas); $i++) {
        if ($miColeccionPartidas[$i]['jugador'] == $usuario && $miColeccionPartidas[$i]['intentos'] > 0) {
            $aux = 0;
        } else if ($miColeccionPartidas[$i]['jugador'] == $usuario && $miColeccionPartidas[$i]['intentos'] == 0) {
            $aux = 1;
        } else {
            $aux = 2;
        }
    }
    switch ($aux) {
        case 0:
            echo "El jugador a ganado";
            break;
        case 1:
            echo "El jugador no a ganado ninguna partida";
            break;
        case 2:
            echo "El jugador no existe";
            break;
    }
}
/* ... COMPLETAR ... */



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//DECLARACION DE VARIABLES:

/*
string $jugador, $palabraJuego, $nombreJ, $deNuevo, $nuevaPalabra
int $opcionElegida, $numPalabra, $elMax, $elMin, $nPartida, $conteo, $aleatoria
bool $verificaPalabra
*/



//INICIALIZACION DE VARIABLES:
$nPartida = 0;
$palabraNombre = [];
$miColeccionPartidas = cargarColeccionPartidas();
$miColeccionPalabras = cargarColeccionPalabras();
$i = 0;

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
            $jugador = solicitarJugador();
            $elMax = miMaxInd($miColeccionPalabras);
            $elMin = miMenInd($elMax);
            $numPalabra = solicitarNumeroEntre($elMin, $elMax);
            $palabraJuego = $miColeccionPalabras[$numPalabra];
            $jugar = palabraRepetida($jugador, $palabraJuego, $miColeccionPartidas);
            if ($jugar == false) {
                $nuevaPartida = jugarWordix($palabraJuego, $jugador);
                array_push($miColeccionPartidas, $nuevaPartida);
            } else {
                echo "El jugador " . $jugador . " ya utilizo la palabra " . $palabraJuego;
            }
            break;

        case 2:

            echo " Bienvenido! \n";
            $jugador = solicitarJugador();
            $conteo = count($miColeccionPalabras);
            $aleatoria = mt_rand(0, $conteo - 1);
            $palabraAleatoria = $miColeccionPalabras[$aleatoria];
            $jugar = palabraRepetida($jugador, $palabraAleatoria, $miColeccionPartidas);
            if ($jugar == false) {
                $nuevaPartida = jugarWordix($palabraAleatoria, $jugador);
                array_push($miColeccionPartidas, $nuevaPartida);
            } else {
                echo "El jugador " . $jugador . " ya utilizo la palabra " . $palabraAleatoria;
            }

            break;

        case 3:

            $elMax = miMaxInd($miColeccionPartidas);
            $elMin = miMenInd($elMax);

            echo "seleccione una partida entre la partida numero " . $elMin + 1 . " y la numero " . $elMax + 1;

            $indice = trim(fgets(STDIN));

            if ($indice >= 0 && $indice < count($miColeccionPartidas)) {
                mostrarDatos($miColeccionPartidas, $indice);
            } else {
                echo "El número ingresado no corresponde a ningún juego.\n";
            }
            break;

        case 4:

            $usuario = solicitarJugador();
            primerPartidaGanada($usuario, $miColeccionPartidas);
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
            ordenarArray($miColeccionPartidas);

            //mostrar listado de partidas ordenados por jugador y por palabra
            //aca llame la funcion que hice arriba xd -M

            break;

        case 7:

            echo "ingrese la palabra que quiera agregar a wordix:";
            $nuevaPalabra = trim(fgets(STDIN));
            $nuevaPalabra = strtoupper($nuevaPalabra);
            $valido = false;
            for ($i = 0; $i < count($miColeccionPartidas); $i++) {
                if ($miColeccionPartidas[$i]["palabraWordix"] == $nuevaPalabra) {
                    $valido = true;
                }
            }
            $verificaPalabra = esPalabra($nuevaPalabra);
            $nuevaPalabra = strtoupper($nuevaPalabra);
            if ($verificaPalabra == 1 && strlen($nuevaPalabra) == 5 && $valido == false) {
                array_push($miColeccionPalabras, $nuevaPalabra);
            } elseif ($verificaPalabra != 1) {
                echo "Lo ingresado debe ser una palabra";
            } elseif ($valido == true) {
                echo "La palabra esta repetida";
            } else {
                echo "Su palabra debe ser de una longitud de 5 letras";
            }
            break;

        case 8:

            echo chr(27) . chr(91) . 'H' . chr(27) . chr(91) . 'J';
            echo "\n**************************************";
            echo "\n* Gracias por jugar a con mi corazón *";
            echo "\n**************************************	\n";
            break;

        default:
        
            echo "Ingrese un numero valido entre el 1 y el 8 \n";
    }
} while ($opcionElegida != 8);
