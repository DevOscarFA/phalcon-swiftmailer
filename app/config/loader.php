<?php

$loader = new \Phalcon\Loader();

/**
 * Registramos los directorios
 */
$loader->registerDirs(
    array(
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->libraryDir,
    )
)->register();

//Registramos las librerias
$loader->registerClasses(
    array(      
        "Swift" => $config->application->libraryDir . "swift/swift_required.php",
    )
);

//Ejecutamos el autoloader
$loader->autoLoad('Swift');

$loader->register();