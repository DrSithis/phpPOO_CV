<?php

static $config = NULL;
$config = require_once('config.php');

try {
    $db = new PDO($config['global']['database']['engine'] . ':host='.$config['global']['database']['options']['hostname'].';dbname='.$config['global']['database']['options']['database'],$config['global']['database']['options']['username'],$config['global']['database']['options']['password']);
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage() . '<br />';
    echo 'N° : ' . $e->getCode();
}

