<?php

function preRemplissageAdresse($Num, $Rue, $Cp, $Ville, $Pays) {
    return array('num' => $Num, 'rue' => $Rue, 'cp' => $Cp, 'ville' => $Ville, 'pays' => $Pays);
}

function preRemplissageContenu($Intitule, $Anneedebut, $Anneefin, $Ecole, $Ville, $Categorie) {
    return array('intitule' => $Intitule, 'anneedebut' => $Anneedebut, 'anneefin' => $Anneefin, 'ecole' => $Ecole, 'ville' => $Ville, 'categorie' => $Categorie);
}