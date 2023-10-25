<?php

// define('CONF_SITE_URL', 'http://localhost/ProgramacaoWebISistema');
define('CONF_SITE_URL', 'http://192.168.0.101/ws');
//define('CONF_SITE_URL', 'http://localhost/UNC/programação%20web/ProgramacaoWebISistema');
// define('CONF_SITE_URL', 'http://10.1.1.60/PHP/.Caua/teste/sist/ProgramacaoWebISistema');

define('DATA_LAYER_CONFIG', [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "test",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

// define('DATA_LAYER_CONFIG', [
//     "driver" => "mysql",
//     "host" => "localhost",
//     "port" => "3306",
//     "dbname" => "sis",
//     "username" => "alunos",
//     "passwd" => "alunos",
//     "options" => [
//         PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
//         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
//         PDO::ATTR_CASE => PDO::CASE_NATURAL
//     ]
// ]);

define("IP_WESLEY", "http://192.168.0.102");
define("IP_VIVAN", "http://192.168.0.104");
define("IP_NICOLAS", "http://192.168.0.103");
