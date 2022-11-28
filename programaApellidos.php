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


/*
 * muestra el resumen de el jugador ingresado
 * @param string $nombreDelJugador
 * @return array
 */
/*
 * retorna el resumen del jugador
 * @param string $jugador
 */
function resumenJugador($jugador, $jugoPartidas){
 
    $miColeccionPartidas =
        ["jugador" => $jugador,"partidas" => 0,"puntaje" => 0,"victorias" => 0, "intento1" => 0,"intento2" => 0,"intento3" => 0,"intento4" => 0,"intento5" => 0,"intento6" => 0];


        foreach ($jugoPartidas as $indicePartida => $infoPar) {
            if ($jugador == $infoPar["jugador"]) {
                $miColeccionPartidas["partidas"] += 1;
                $miColeccionPartidas["puntaje"] += $infoPar["puntaje"];
                if ($infoPar["puntaje"] >0) {
                    $miColeccionPartidas["victorias"] += 1;
                }
                switch ($infoPar["intentos"]) {
                    case 1:
                        $miColeccionPartidas["intento1"] += 1;
                        break;

                    case 2:
                        $miColeccionPartidas["intento2"] += 1;
                        break;
                    case 3:
                        $miColeccionPartidas["intento3"] += 1;
                        break;
case 4:
                        $miColeccionPartidas["intento4"] += 1;
                        break;
                    case 5:
                        $miColeccionPartidas["intento5"] += 1;
                        break;
                    case 6:
                        $miColeccionPartidas["intento6"] += 1;
                        break;

                }
            }
        }
        $porcentaje = $miColeccionPartidas["victorias"]*100 / $miColeccionPartidas["partidas"];
echo "\n**\n";
        echo "Jugador: " . $jugador . "\n";
        echo "Partidas: " .$miColeccionPartidas ["partidas"]. "\n";
        echo "Puntaje Total: " .$miColeccionPartidas ["puntaje"]. "\n";
        echo "Victorias: " .$miColeccionPartidas ["victorias"]. "\n";
        echo "Porcentaje Victorias: " .round($porcentaje,2). "%\n";
        echo "Adivinadas: \n";
        echo "      Intento 1: " .$miColeccionPartidas["intento1"]. "\n";
        echo "      Intento 2: " .$miColeccionPartidas["intento2"]. "\n";
        echo "      Intento 3: " .$miColeccionPartidas["intento3"]. "\n";
        echo "      Intento 4: " .$miColeccionPartidas["intento4"]. "\n";
        echo "      Intento 5: " .$miColeccionPartidas["intento5"]. "\n";
        echo "      Intento 6: " .$miColeccionPartidas["intento6"]. "\n";
        echo "**\n";
    }

/** Muestra el menú para el usuario
 * @param string $player
 * @return void
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
function mostrarDatos($coleccionJuegos, $nIndice)
{
    $datoPartida = $coleccionJuegos[$nIndice];
    echo $nIndice;

    if($datoPartida["intentos"] > 0){
    echo "Partida WORDIX " . $nIndice . ": palabra " . $datoPartida["palabraWordix"]. "\n" . "Jugador: " . $datoPartida["jugador"] . "\n" . "Puntaje: " . $datoPartida["puntaje"] . " puntos\n" . "Intento: Adivinó la palabra en " . $datoPartida["intentos"] . " intentos";
    }
    else{
    
        echo "Partida WORDIX " . $nIndice . ": palabra " . $datoPartida["palabraWordix"]. "\n" . "Jugador: " . $datoPartida["jugador"] . "\n" . "Puntaje: " . $datoPartida["puntaje"] . " puntos". "\n" . "Intento: No adivinó la palabra.";
 
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





//esta funcion la realize para la opcion 5 del menu :) -M


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
            $aux = 1;
        } else if ($miColeccionPartidas[$i]['jugador'] == $usuario && $miColeccionPartidas[$i]['intentos'] == 0) {
            $aux = 2;
        }
    }
    $datos = [];
    $indice = 0;
    for ($i = 0; $i < count($miColeccionPartidas); $i++) {
        if ($miColeccionPartidas[$i]['jugador'] == $usuario) {
            $indice = $indice + $i;
            $datos = $datos + $miColeccionPartidas[$i];
        }
    }
    switch ($aux) {
        case 1:
            echo "**\n";
            echo "* Partida WORDIX " . $indice . " : Palabra " . $datos['palabraWordix'] . "\n";
            echo "* Jugador: " . $datos['jugador'] . "\n";
            echo "* Puntaje: " . $datos['intentos'] . " Puntos\n";
            echo "* Intentos: " . $datos['puntaje'] . "\n";
            echo "**\n";
            break;
        case 2:
            echo "**\n";
            echo " El jugador " . $usuario . " no a ganado ninguna partida\n";
            echo "**\n";
            break;
        default:
            echo "**\n";
            echo "* El jugador no existe\n";
            echo "*\n";
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
$elMax = miMaxInd($miColeccionPartidas);
$i = 0;
$estadisticasJugador = [];
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
            //Aca ya te arreglé las cosas con los problemas que te repetian. -Ariel
            //Solo falta poner unas cosas mas respecto a las condiciones que da
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

            //llega a jugar con una palabra aleatoria, tiene el mismo error que el caso 1, se repite (y la funcion "mt_rand" la saque de internet) -B
            //por las dudas no dejé declaradas la variables $conteo, $aleatoria y $resultado -BRUUUNO
            //Ya te arreglé el tema de la repeticion infinita :) -ARIEL
            //Lo mismo que arriba, hay que terminar lo de las condiciones -ARIEL

            //jugar al wordix con una palabra aleatoria


            break;
        case 3:
            $elMax = miMaxInd($miColeccionPartidas);
            $elMin = miMenInd($elMax);

            echo "seleccione una partida entre la partida numero " . $elMin . " y la numero " . $elMax . "\n";

            $indice = trim(fgets(STDIN));
            //$indice--;
            if ($indice >= 0 && $indice < count($miColeccionPartidas)) {
                mostrarDatos($miColeccionPartidas, $indice);
            } else {
                echo "El número ingresado no corresponde a ningún juego.\n";
            }


            $jugador = solicitarJugador();
            $esJugador = esJugador($miColeccionPartidas, $jugador);
            if ($esJugador) {
                resumenJugador($jugador, $miColeccionPartidas);
            }else {
                echo "\n el usuario no existe \n";
            }

            //NO PRESTEN MUCHA ATENCION A ESTO, ESTOY PROBANDO COSAS Y POR AHORA VA RE BIEN LA 3. -ARIEL

            break;
        case 4:
           

            //mostrar la primera partida ganadora

            break;
        case 5:
            $jugador = solicitarJugador();
            $esJugador = esJugador($miColeccionPartidas, $jugador);
            if ($esJugador) {
                resumenJugador($jugador, $miColeccionPartidas);
            }else {
                echo "\n el usuario no existe \n";
            }
           
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
            $verificaPalabra = esPalabra($nuevaPalabra);
            $nuevaPalabra = strtoupper($nuevaPalabra);

            if ($verificaPalabra == 1 && strlen($nuevaPalabra) == 5) {
                array_push($miColeccionPalabras, $nuevaPalabra);
                print_r($miColeccionPalabras);
            } elseif ($verificaPalabra != 1) {
                echo "Lo ingresado debe ser una palabra";
            } else {
                echo "Su palabra debe ser de una longitud de 5 letras";
            }


            //agregar una palabra de 5 letras a wordix YA LO HICE! :D -ARIEL

            break;
        case 8:
            //Salir

            break;
        default:
            echo "Ingrese un numero valido entre el 1 y el 8 \n";
    }
} while ($opcionElegida != 8);
