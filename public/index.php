<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);


define('APP_PATH', realpath('..'));

try {
    date_default_timezone_set('America/Bogota');
    $debug = new \Phalcon\Debug();
    $debug->listen();
    /**
     * Read the configuration
     */
    $config = include APP_PATH . "/app/config/config.php";

    /**
     * Read auto-loader
     */
    include APP_PATH . "/app/config/loader.php";

    /**
     * Read services
     */
    include APP_PATH . "/app/config/services.php";

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
