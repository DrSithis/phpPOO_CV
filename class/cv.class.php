<?php
class Cv {

    private $nom;
    private $prenom;
    private $email;
    private $intitule;
    private $adresse = array();
    private $contenu = array();
    private $toutcontenu = array();
    private $count;

    //--INIT--//
    function __construct($Nom, $Prenom, $Email, $Intitule, array $Adresse) {
        $this->setNom($Nom);
        $this->setPrenom($Prenom);
        $this->setEmail($Email);
        $this->setIntitule($Intitule);
        $this->construct_Adresse($Adresse);
        $this->count = 0;
    }
    
    function construct($Nom, $Prenom, $Email, $Intitule, array $Adresse) {
        $this->setNom($Nom);
        $this->setPrenom($Prenom);
        $this->setEmail($Email);
        $this->setIntitule($Intitule);
        $this->construct_Adresse($Adresse);
        $this->count = 0;
    }
    
    private function construct_Adresse(array $Adresse) {
        $this->setAdresse('num', $Adresse['num']);
        $this->setAdresse('rue', $Adresse['rue']);
        $this->setAdresse('cp', $Adresse['cp']);
        $this->setAdresse('ville', $Adresse['ville']);
        $this->setAdresse('pays', $Adresse['pays']);
    }

    public function construct_Contenu(array $Contenu) {
        $this->setContenu('intitule', $Contenu['intitule']);
        $this->setContenu('anneedebut', $Contenu['anneedebut']);
        $this->setContenu('anneefin', $Contenu['anneefin']);
        $this->setContenu('ecole', $Contenu['ecole']);
        $this->setContenu('ville', $Contenu['ville']);
        $this->setContenu('categorie', $Contenu['categorie']);
        
        $this->setToutContenu($this->getCount, $this->getAllContenu());
        $this->setCount($this->getCount + 1);
    }
    
    //--METHODE--//  
    public function afficher(){
        $this->afficher_Personne();
        echo '<h2> Expérience Professionnelle </h2>';
        foreach($this->getAllToutContenu() as $contenu){$this->afficher_Experience($contenu);}
        echo '<h2> Formation </h2>';
        foreach($this->getAllToutContenu() as $contenu){$this->afficher_Formation($contenu);}
    }

    private function afficher_Personne(){
        echo $this->getNom . ' ' . $this->getPrenom .'<br>';
        echo $this->getAdresse('num') . ',' . $this->getAdresse('rue') . '<br>';
        echo $this->getAdresse('cp') . ' - ' . $this->getAdresse('ville') . ',' . $this->getAdresse('pays') . '<br>';
        echo $this->getEmail . '<br>';
        echo '<hr>';
        echo '<h1>' . $this->getIntitule . '</h1>';
        echo '<hr>';
    }
    
    private function afficher_Experience($Contenu) {
        if ($Contenu['categorie'] == "experience") {
            echo $Contenu['anneedebut'] . ' - ' . $Contenu['anneefin'] . ' | ' . $Contenu['intitule'] . '<br>';
            echo $Contenu['ecole'] . ' - ' . $Contenu['ville'];
            echo '<br><hr><br>';
        }
    }

    private function afficher_Formation($Contenu) {
        if ($Contenu['categorie'] == "formation") {
            echo $Contenu['anneedebut'] . ' - ' . $Contenu['anneefin'] . ' | ' . $Contenu['intitule'] . '<br>';
            echo $Contenu['ecole'] . ' - ' . $Contenu['ville'];
            echo '<br><hr><br>';
        }
    }

    //--GETTER&SETTER--//
    public function getNom(){return $this->nom;}
    public function setNom($Nom){$this->getNom=$Nom;}

    public function getPrenom(){return $this->prenom;}
    public function setPrenom($Prenom){$this->getPrenom=$Prenom;}

    public function getEmail(){return $this->email;}
    public function setEmail($Email){$this->getEmail=$Email;}

    public function getIntitule(){return $this->intitule;}
    public function setIntitule($Intitutle){$this->getIntitule=$Intitutle;}

    public function getAdresse($Indice){return $this->adresse[$Indice];}
    public function getAllAdresse(){return $this->adresse;}
    public function setAdresse($Indice, $Adresse){$this->adresse[$Indice]=$Adresse;}

    public function getContenu($Indice){return $this->contenu[$Indice];}
    public function getAllContenu(){return $this->contenu;}
    public function setContenu($Indice, $Contenu){$this->contenu[$Indice]=$Contenu;}
    
    public function getToutContenu($Indice){return $this->toutcontenu[$Indice];}
    public function getAllToutContenu(){return $this->toutcontenu;}
    public function setToutContenu($Indice, $Contenu){$this->toutcontenu[$Indice]=$Contenu;}
    
    public function getCount(){return $this->count;}
    public function setCount($Count){$this->getCount=$Count;}
}
