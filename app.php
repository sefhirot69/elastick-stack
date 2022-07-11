<?php

require __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Handler\RotatingFileHandler;

// create a log channel
$log = new Logger('logger');

//Log to stdout
$stdoutHandler = new ErrorLogHandler();
$formatter = new JsonFormatter();
$stdoutHandler->setFormatter($formatter);
$log->pushHandler($stdoutHandler);

for ($i = 0; $i <= 10; $i++) {
    // File Handler
    $fileHandler = new RotatingFileHandler('var/logs/app.log', 0, Logger::DEBUG);
    $formatter = new JsonFormatter();
    $fileHandler->setFormatter($formatter);
    $log->pushHandler($fileHandler);

//// Elasticsearch Handler
//$elasticaClient = new Client(
//    [
//        'host' => 'localhost',
//        'port' => 9200
//    ]
//);
//
//
//$elasticsearchHandler = new ElasticaHandler($elasticaClient,['index' => 'codelytv']);
//$log->pushHandler($elasticsearchHandler);

// My Application
    $options = ['a', 'b', 'c'];
    $letter = $options[random_int(0, 2)];

# App Servidor A
    if ($letter === 'a') {
        $log->warning('Esto es un Warning', ['Servidor' => 'Servidor '.generateRandomString()]);
    } else {
        $log->info('Esto es un Info', ['Servidor' => 'Servidor '.generateRandomString()]);
    }

# App Servidor B
    if ($letter === 'b') {
        $log->error('Esto es un Error', ['Servidor' => 'Servidor '.generateRandomString()]);
    } else {
        $log->info('Esto es un Info', ['Servidor' => 'Servidor '.generateRandomString()]);
    }

# App Servidor C
    if ($letter === 'c') {
        $log->info('Esto es un Error', ['Servidor' => 'Servidor '.generateRandomString()]);
    } else {
        $log->emergency('Esto es un Info', ['Servidor' => 'Servidor '.generateRandomString()]);
    }
}

function generateRandomString()
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);

    return $characters[random_int(0, $charactersLength - 1)];
}