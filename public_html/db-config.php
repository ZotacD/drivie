<?php

function dbConnect()
{
    $host = 'localhost';
    $dbname = 'inf2pj_07';
    $user = 'root';
    $password = '';

    return new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $user, $password,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}
