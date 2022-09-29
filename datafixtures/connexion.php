<?php

/* fonction connexion à la base de donnée (PDO) */

function connect()
{
    require('config.php');

    try
    {
        $co = new PDO("mysql:host=" . $dbHost . ";dbname=" . $dbName,$dbUser);
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }	
    catch(PDOException $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
    return $co;
}	

/* fonction déconnection à la base de donnée */

function disconnect()
{
    $co = null;
} 