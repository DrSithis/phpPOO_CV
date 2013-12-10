<?php

class CvManager {

    private $selectAll;
    private $selectAllPersonne;
    private $selectAllAdresse;
    private $selectAllContenu;
    
    private $selectIdAdresse;
    private $selectIdPersonne;
            
    private $insertPersonne;
    private $insertAdresse;
    private $insertContenu;
    
    //--INIT--//
    public function __construct($db) {
        $this->selectAll = $db->prepare("SELECT * FROM personne p, adresse a, categorie c, contenu ct WHERE p.adresse=a.id AND p.id=ct.personne AND c.id=ct.categorie");
        $this->selectAllPersonne = $db->prepare("SELECT * FROM personne p");
        $this->selectAllAdresse = $db->prepare("SELECT * FROM adresse a");
        $this->selectAllContenu = $db->prepare("SELECT * FROM contenu ct ");
        
        $this->selectIdAdresse = $db -> prepare("SELECT id FROM adresse a WHERE num=:num AND rue=:rue AND cp=:cp AND ville=:ville AND pays=:pays");
        $this->selectIdPersonne = $db -> prepare("SELECT id FROM personne p WHERE nom=:nom AND prenom=:prenom AND email=:email");
        
        $this->insertAdresse = $db->prepare("INSERT INTO `adresse` (`id` ,`num` ,`rue` ,`cp` ,`ville` ,`pays`) VALUES (NULL ,  :num,  :rue,  :cp,  :ville,  :pays);");
        $this->insertPersonne = $db->prepare("INSERT INTO `personne` (`id`, `nom`, `prenom`, `email`, `intitulecv`, `adresse`) VALUES (NULL, :nom, :prenom, :email, :intitulecv, :idadresse);");
        $this->insertContenu = $db->prepare("INSERT INTO `contenu` (`id`, `intitule`, `anneedebut`, `anneefin`, `ecole`, `ville`, `personne`, `categorie`) VALUES (NULL, :intitule, :anneedebut, :anneefin, :ecole, :ville, :idpersonne, :idcategorie)");
    }
    
    //--METHOD--//
    public function insertionCV($Nom, $Prenom, $Email, $Intitulecv, array $Adresse, array $Contenu) {
        if ($this->controleDoubleAdresse($Adresse) == 1) {
            $idadresse = $this->selectIdAdresse($Adresse);
            if($this->controleDoublePersonne($Nom, $Prenom, $Email, $Intitulecv, $idadresse['0']) == 1){
                $idpersonne = $this->selectIdPersonne($Nom, $Prenom, $Email);
                $this->insertionAllContenu($Contenu, $idpersonne['0']);
            }else{echo 'error insert personne';}
        }else{echo 'error insert adresse';}
    }

    private function insertionAllContenu(array $Contenu, $idPersonne) {
        foreach ($Contenu as $uncontenu) {
            $this->insertContenu($uncontenu, $idPersonne);
        }
    }

    private function controleDoubleAdresse(array $Adresse){
        if($this->selectCountAdresse($Adresse) == 0){
            return $this->insertAdresse($Adresse);
        }
        else { return NULL; }
    }
    
    private function controleDoublePersonne($Nom, $Prenom, $Email, $Intitulecv, $Adresse){
        if($this->selectCountPersonne($Nom, $Prenom, $Email) == 0){
            return $this->insertPersonne($Nom, $Prenom, $Email, $Intitulecv, $Adresse);
        }
        else { return NULL; }
    }
    
    //--+SELECT+--//
    public function selectIdAdresse(array $Adresse){
        $this->selectIdAdresse->execute(array(':num'=>$Adresse['num'], ':rue'=>$Adresse['rue'], ':cp'=>$Adresse['cp'], ':ville'=>$Adresse['ville'], ':pays'=>$Adresse['pays']));
        return $this->selectIdAdresse->fetch();
    }
    
    public function selectCountAdresse(array $Adresse){
        $this->selectIdAdresse->execute(array(':num'=>$Adresse['num'], ':rue'=>$Adresse['rue'], ':cp'=>$Adresse['cp'], ':ville'=>$Adresse['ville'], ':pays'=>$Adresse['pays']));
        return $this->selectIdAdresse->rowCount();
    }
    
    public function selectIdPersonne($Nom, $Prenom, $Email){
        $this->selectIdPersonne->execute(array(':nom'=>$Nom, ':prenom'=>$Prenom, ':email'=>$Email));
        return $this->selectIdPersonne->fetch();
    }
    
    public function selectCountPersonne($Nom, $Prenom, $Email){
        $this->selectIdPersonne->execute(array(':nom'=>$Nom, ':prenom'=>$Prenom, ':email'=>$Email));
        return $this->selectIdPersonne->rowCount();
    }
    
    public function selectAll() {
        $this->selectAll->execute();
        return $this->selectAll->fetchAll();
    }
    
    public function selectAllPersonne(){
        $this->selectAllPersone->execute();
        return $this->selectAllPersonne->fetchAll();
    }

    public function selectAllAdresse(){
        $this->selectAllAdresse->execute();
        return $this->selectAllAdresse->fetchAll();
    }
    
    public function selectAllContenu(){
        $this->selectAllContenu->execute();
        return $this->selectAllContenu->fetchAll();
    }
    
    //--+INSERT+--//
    
    public function insertAdresse(array $Adresse){
        $this->insertAdresse->execute(array(':num'=>$Adresse['num'], ':rue'=>$Adresse['rue'], ':cp'=>$Adresse['cp'], 
                                            ':ville'=>$Adresse['ville'], ':pays'=>$Adresse['pays']));
        return $this->insertAdresse->rowCount();
    }
        
    public function insertPersonne($Nom, $Prenom, $Email, $Intitulecv, $Idadresse){
        $this->insertPersonne->execute(array(':nom'=>$Nom, ':prenom'=>$Prenom, ':email'=>$Email, 
                                             ':intitulecv'=>$Intitulecv, ':idadresse'=>$Idadresse));
        return $this->insertPersonne->rowCount();
    }
    
    public function insertContenu(array $Contenu, $idpersonne){
        if($Contenu['categorie'] == 'experience'){
            $categorie = 1;
        }elseif ($Contenu['categorie'] == 'formation') {
            $categorie = 2;
        }
        $this->insertContenu->execute(array(':intitule'=>$Contenu['intitule'], ':anneedebut'=>$Contenu['anneedebut'], ':anneefin'=>$Contenu['anneefin'], 
                                            ':ville'=>$Contenu['ville'], ':idpersonne'=>$idpersonne, ':idcategorie'=>$categorie));
        return $this->insertContenu->rowCount();
    }
}
