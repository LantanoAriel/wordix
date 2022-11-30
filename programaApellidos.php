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

/**
 * Verifica si el usuario ingresado esta presente en coleccion de partidas
 * @param array $coleccionJugadores
 * @param string $player
 * @return boolean
 */
function esJugador($coleccionJugadores, $player)
{
    $i = 0;
    $esJugador = false;
    $elMax = miMaxInd($coleccionJugadores);
    while ($i < $elMax && $coleccionJugadores[$i]["jugador"] != $player) {
        $i = $i + 1;
    }
    if ($coleccionJugadores[$i]["jugador"] == $player) {
        $esJugador = true;
    }

    return $esJugador;
}


/** 
 * retorna el resumen del jugador
 * @param string $jugador
 * @return array
 */
function resumenJugador($jugador, $jugoPartidas)
{

    $datosJugador =
        [
            "jugador" => $jugador,
            "partidas" => 0,
            "puntaje" => 0,
            "victorias" => 0,
            "intento1" => 0, "intento2" => 0, "intento3" => 0, "intento4" => 0, "intento5" => 0, "intento6" => 0
        ];


    foreach ($jugoPartidas as $indicePartida => $infoPar) {
        if ($jugador == $infoPar["jugador"]) {
            $datosJugador["partidas"] += 1;
            $datosJugador["puntaje"] += $infoPar["puntaje"];
            if ($infoPar["puntaje"] > 0) {
                $datosJugador["victorias"] += 1;
            }
            switch ($infoPar["intentos"]) {
                case 1:
                    $datosJugador["intento1"] += 1;
                    break;

                case 2:
                    $datosJugador["intento2"] += 1;
                    break;
                case 3:
                    $datosJugador["intento3"] += 1;
                    break;
                case 4:
                    $datosJugador["intento4"] += 1;
                    break;
                case 5:
                    $datosJugador["intento5"] += 1;
                    break;
                case 6:
                    $datosJugador["intento6"] += 1;
                    break;
            }
        }
    }
    $porcentaje = $datosJugador["victorias"] * 100 / $datosJugador["partidas"];
    echo "\n**\n";
    echo "Jugador: " . $jugador . "\n";
    echo "Partidas: " . $datosJugador["partidas"] . "\n";
    echo "Puntaje Total: " . $datosJugador["puntaje"] . "\n";
    echo "Victorias: " . $datosJugador["victorias"] . "\n";
    echo "Porcentaje Victorias: " . round($porcentaje, 2) . "%\n";
    echo "Adivinadas: \n";
    echo "      Intento 1: " . $datosJugador["intento1"] . "\n";
    echo "      Intento 2: " . $datosJugador["intento2"] . "\n";
    echo "      Intento 3: " . $datosJugador["intento3"] . "\n";
    echo "      Intento 4: " . $datosJugador["intento4"] . "\n";
    echo "      Intento 5: " . $datosJugador["intento5"] . "\n";
    echo "      Intento 6: " . $datosJugador["intento6"] . "\n";
    echo "**\n";
}

/** Muestra el menú para el usuario
 * @param string $player
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

    if ($datoPartida["intentos"] > 0) {
        echo "Partida WORDIX " . ($nIndice + 1) . ": palabra " . $datoPartida["palabraWordix"] . "\n" . "Jugador: " . $datoPartida["jugador"] . "\n" . "Puntaje: " . $datoPartida["puntaje"] . " puntos\n" . "Intento: Adivinó la palabra en " . $datoPartida["intentos"] . " intentos";
    } else {

        echo "Partida WORDIX " . $nIndice . ": palabra " . $datoPartida["palabraWordix"] . "\n" . "Jugador: " . $datoPartida["jugador"] . "\n" . "Puntaje: " . $datoPartida["puntaje"] . " puntos" . "\n" . "Intento: No adivinó la palabra.";
    }
}



/** Permite realizar la comparacion para $comparacionPalabras
 * @param string @a
 * @param string @b
 * @return int
 */
function comparar($a, $b)
{
    if ($a["jugador"] == $b["jugador"]) {
        if ($a["palabraWordix"] == $b["palabraWordix"]) {
            $orden = 0;
        } elseif ($a["palabraWordix"] < $b["palabraWordix"]) {
            $orden = -1;
        } else {
            $orden = 1;
        }
    } elseif ($a["jugador"] < $b["jugador"]) {
        $orden = -1;
    } else {


        $orden = 1;
    }

    return $orden;
}



/**
 * funcion para ordenar la coleccion de partidas
 * @param array $sinOrdenar
 * @return void
 */
function ordenarArray($sinOrdenar)
{
    uasort($sinOrdenar, "comparar");
    print_r($sinOrdenar);
}
//esta es la funcion sin retorno que se nos pedia en el inciso para la opcion 6 del menu -M


/** 
 * solicita un nombre de jugador y lo convierte en minusculas retornado asi jugador en minuscula.
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




/** 
 * Verifica si la palabra ingresada esta repetida o no y devuelve true/false
 * @param string $usuario
 * @param string $palabra
 * @param array $comprobar
 * @return boolean
 */

function palabraRepetida($usuario, $palabra, $comprobar)
{
    $aux = false;
    $i = 0;
    while ($i < count($comprobar) && ($comprobar[$i]['jugador'] != $usuario || $comprobar[$i]['palabraWordix'] != $palabra)) {
        $i++;
    }
    if ($i < count($comprobar)) {
        $aux = true;
    }
    return $aux;
    /*$aux = false;
    foreach ($comprobar as $key => $elemento) {
        if ($elemento['jugador'] == $usuario && $elemento['palabraWordix'] == $palabra) {
            $aux = true;
        }
    }*/
}

/**
 * Dado un jugador, retorna el índice de su primera partida ganada guardada en el arreglo. Sino retorna -1
 * @param string $jogador
 * @param array $coleccionPartidas
 * @param int $indice
 * @return int $numeroPartida
 */
function primerPartidaGanada($jogador, $partidasGuardadas, $numeroPartida)
{
    //int $i, $indice
    $indice = -1;
    $i = 0;
    while ($i < $numeroPartida && ($jogador != $partidasGuardadas[$i]["jugador"] || $partidasGuardadas[$i]["puntaje"] == 0)) {
        $i++;
    }
    if ($i < $numeroPartida) {
        $indice = $i;
    }
    return $indice;
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
$opcionElegida = 0;
$minMenu = 1;
$maxMenu = 8;
//PROCESO:

//print_r($partida);
//imprimirResultado($partida);


do {
    mostrarMenu();
    echo "Seleccione una de las opciones: \n";
    $opcionElegida = verificaValMenu($minMenu, $maxMenu);

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

            echo "seleccione una partida entre la partida numero " . ($elMin + 1) . " y la numero " . ($elMax + 1) . "\n";

            $indice = trim(fgets(STDIN));
            $indice = $indice - 1;

            if ($indice >= 0 && $indice < count($miColeccionPartidas)) {
                mostrarDatos($miColeccionPartidas, $indice);
            } else {
                echo "El número ingresado no corresponde a ningún juego.\n";
            }
            break;

        case 4:

            $usuario = solicitarJugador();
            $partidaGanada = primerPartidaGanada($usuario, $miColeccionPartidas, count($miColeccionPartidas));
            $existeJugador = esJugador($miColeccionPartidas, $usuario);


            if ($partidaGanada != -1) {
                echo "********************************************************************\n";
                echo "* Partida WORDIX " . ($partidaGanada + 1) . " : Palabra " . $miColeccionPartidas[$partidaGanada]['palabraWordix'] . "\n";
                echo "* Jugador: " . $miColeccionPartidas[$partidaGanada]['jugador'] . "\n";
                echo "* Puntaje: " . $miColeccionPartidas[$partidaGanada]['puntaje'] . " Puntos\n";
                echo "* Intentos: " . $miColeccionPartidas[$partidaGanada]['intentos'] . "\n";
                echo "********************************************************************\n";
            }
            if (!$existeJugador) {
                echo "*************************\n";
                echo "* El jugador no existe  *\n";
                echo "*************************\n";
            }
            if ($partidaGanada == -1 && $existeJugador) {
                echo "*************************************************************\n";
                echo "* El jugador " . $usuario . " no a ganado ninguna partida   *\n";
                echo "*************************************************************\n";
            }
            break;


            break;

        case 5:

            $jugador = solicitarJugador();
            $esJugador = esJugador($miColeccionPartidas, $jugador);
            if ($esJugador) {
                resumenJugador($jugador, $miColeccionPartidas);
            } else {
                echo "\n el usuario no existe \n";
            }

            break;
        case 6:

            echo "Listado ordenado de las partidas jugadas";
            ordenarArray($miColeccionPartidas);

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
                echo "\n Su palabra se ingreso correctamente!";
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
            echo "\n*Gracias por jugar con mi corazón</3 *";
            echo "\n**************************************	\n";
            break;
    }
} while ($opcionElegida != 8);
