<?php

define('CONF_SITE_URL', 'http://localhost/unc/programacao%20web%20I/ProgramacaoWebISistema');

define('DATA_LAYER_CONFIG', [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "turma373_projeto_primeiro_victor",
    "username" => "alunos",
    "passwd" => "alunos",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);
