<?php
require_once('bdd/connect_pdo.php');
require_once('func/func.php');
require_once('class/cv.class.php');
require_once('class/cv_manager.class.php');

jeuessaie($db);

$cvmanager = new CvManager($db);

$nom = $cvmanager->selectAllNomPersonne();

foreach ($nom as $pers){
    var_dump($pers);
}

