<?php

function jeuessaie($db) {
    insert1($db);
    insert2($db);
}

function insert1($db){
    $nom = "Hof";
    $prenom = "David";
    $email = "contact@hoflackdavid.fr";
    $intitule = "Dev";
    $adresse = preRemplissageAdresse(3, 'Rue des frênes', 62380, 'Acquin', 'France');
    $form1 = preRemplissageContenu('BTS', 2010, 2012, 'Guy Mollet', 'Arras', 'formation');
    $form2 = preRemplissageContenu('BAC', 2008, 2009, 'LAA', 'Saint-Omer', 'formation');
    $exp = preRemplissageContenu('TestExp', 2013, 2013, 'Projet Etudiant', 'Acquin', 'experience');
    
    $cv = new Cv($nom, $prenom, $email, $intitule, $adresse);
    $cv->construct_Contenu($form1);
    $cv->construct_Contenu($form2);
    $cv->construct_Contenu($exp);

    $cvmanage = new CvManager($db);
    $cvmanage->insertionCV($nom, $prenom, $email, $intitule, $adresse, $cv->getAllToutContenu());
}

function insert2($db){
    $nom = "Maxifest";
    $prenom = "blero";
    $email = "contact@hoflackdavid.fr";
    $intitule = "Dev";
    $adresse = preRemplissageAdresse(9, 'Rue des frênes', 62380, 'Acquin', 'France');
    $form1 = preRemplissageContenu('BTS', 2010, 2012, 'Guy Mollet', 'Arras', 'formation');
    $form2 = preRemplissageContenu('BAC', 2008, 2009, 'LAA', 'Saint-Omer', 'formation');
    $exp = preRemplissageContenu('TestExp', 2013, 2013, 'Projet Etudiant', 'Acquin', 'experience');
    
    $cv = new Cv($nom, $prenom, $email, $intitule, $adresse);
    $cv->construct_Contenu($form1);
    $cv->construct_Contenu($form2);
    $cv->construct_Contenu($exp);

    $cvmanage = new CvManager($db);
    $cvmanage->insertionCV($nom, $prenom, $email, $intitule, $adresse, $cv->getAllToutContenu());
}

function preRemplissageAdresse($Num, $Rue, $Cp, $Ville, $Pays) {
    return array('num' => $Num, 'rue' => utf8_decode($Rue), 'cp' => $Cp, 'ville' => utf8_decode($Ville), 'pays' => utf8_decode($Pays));
}

function preRemplissageContenu($Intitule, $Anneedebut, $Anneefin, $Ecole, $Ville, $Categorie) {
    return array('intitule' => utf8_decode($Intitule), 'anneedebut' => $Anneedebut, 'anneefin' => $Anneefin, 'ecole' => utf8_decode($Ecole), 'ville' => utf8_decode($Ville), 'categorie' => $Categorie);
}