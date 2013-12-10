<?php

function jeuessaie($db) {
    viderbdd($db);
    insert1($db);
    insert2($db);
}

function insert1($db){
    $nom = "Hof";
    $prenom = "David";
    $email = "contact@hoflackdavid.fr";
    $intitule = "Dev info";
    $adresse = preRemplissageAdresse(3, 'Rue des frênes', 62380, 'Acquin', 'France');
    $form1 = preRemplissageContenu('BTS', 2010, 2012, 'Guy Mollet', 'Arras', 'formation');
    $form2 = preRemplissageContenu('BAC', 2008, 2009, 'LAA', 'Saint-Omer', 'formation');
    $exp = preRemplissageContenu('TestExp', 2013, 2013, 'Projet Etudiant', 'Acquin', 'experience');
    
    $cv = new Cv($nom, $prenom, $email, $intitule, $adresse);
    $cv->construct_Contenu($form1);
    $cv->construct_Contenu($form2);
    $cv->construct_Contenu($exp);

    //$cv->afficher();
    $cvmanage = new CvManager($db);
    $cvmanage->insertionCV($nom, $prenom, $email, $intitule, $adresse, $cv->getAllToutContenu());
}

function insert2($db){
    $nom = "Maxifest";
    $prenom = "blero";
    $email = "contact@hoflackdavid.fr";
    $intitule = "Dev info";
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

function viderbdd($db){
    $cvmanage = new CvManager($db);
    $cvmanage->deleteAll();
}