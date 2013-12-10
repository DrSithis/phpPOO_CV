<?php
require_once('bdd/connect_pdo.php');
require_once('func/func.php');
require_once('func/jeuessaie.func.php');
require_once('class/cv.class.php');
require_once('class/cv_manager.class.php');
$cvmanager = new CvManager($db);

if (!empty($_POST) && !empty($_POST['bt'])) {
    var_dump($_POST);
    $contenu = preRemplissageContenu($_POST['intitule'], $_POST['anneedebut'], $_POST['anneefin'], $_POST['ecole'], $_POST['ville'], $_POST['categorie']);
    $cvmanager->insertContenu($contenu, $_POST['idpers']);
    header('location: index.php');
    exit;
}