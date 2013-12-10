<?php

class CvManager {

    private $selectAll;

    public function __construct($db) {
        $this->selectAll = $db->prepare("SELECT * FROM personne p, adresse a, categorie c, contenu ct WHERE p.adresse=a.id AND p.id=ct.personne AND c.id=ct.categorie");
    }

    public function selectAll() {
        $this->selectAll->execute();
        return $this->selectAll->fetchAll();
    }

}
