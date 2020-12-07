<?php

function getDbObject() {
    $rdbms = 'mysql';
    $host = 'localhost';
    $db = 'taitaja_kiplailu_ohjelmointiprojekti';
    $user = 'root';
    $pass = '';
    $charset = 'utf8';

    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $connectionString = "$rdbms:host=$host;dbname=$db;charset=$charset";
    return new PDO($connectionString, $user, $pass, $opt);
};
?>