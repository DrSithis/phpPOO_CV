<?php

function preRemplissageAdresse($Num, $Rue, $Cp, $Ville, $Pays) {
    return array('num' => $Num, 'rue' => utf8_decode($Rue), 'cp' => $Cp, 'ville' => utf8_decode($Ville), 'pays' => utf8_decode($Pays));
}

function preRemplissageContenu($Intitule, $Anneedebut, $Anneefin, $Ecole, $Ville, $Categorie) {
    return array('intitule' => utf8_decode($Intitule), 'anneedebut' => $Anneedebut, 'anneefin' => $Anneefin, 'ecole' => utf8_decode($Ecole), 'ville' => utf8_decode($Ville), 'categorie' => $Categorie);
}