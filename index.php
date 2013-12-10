<?php
mb_internal_encoding('UTF-8');

require_once('connect_pdo.php');
require_once('func.php');
require_once('class/cv.class.php');
require_once('class/cv_manager.class.php');

$nom ="Hof";
$prenom = "David";
$email = "contact@hoflackdavid.fr";
$intitule = "Dev";
$adresse = preRemplissageAdresse(03, 'Rue des frênes', 62380, 'Acquin', 'France');

$cv = new Cv($nom, $prenom, $email, $intitule, $adresse);

$form1 = preRemplissageContenu('BTS', 2010, 2012, 'Guy Mollet', 'Arras', 'formation');
$form2 = preRemplissageContenu('BAC', 2008, 2009, 'LAA', 'Saint-Omer', 'formation');

$exp = preRemplissageContenu('TestExp', 2013, 2013, 'Projet Etudiant', 'Acquin', 'experience');

$cv->construct_Contenu($form1);
$cv->construct_Contenu($form2);
$cv->construct_Contenu($exp);

//var_dump($cv->getAllToutContenu());
$cv->afficher();

$cvmanage = new CvManager($db);

$cvmanage->insertionCV($nom, $prenom, $email, $intitule, $adresse, $cv->getAllToutContenu());