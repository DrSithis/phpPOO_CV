<?php
require_once('bdd/connect_pdo.php');
require_once('func/func.php');
require_once('func/jeuessaie.func.php');
require_once('class/cv.class.php');
require_once('class/cv_manager.class.php');

//jeuessaie($db);

$cvmanager = new CvManager($db);

$personne = $cvmanager->selectAllNomPersonne();
       
?>

<form id="form" action="index.php" name="formulaire" method="POST">
    <select name="personne">
        <?php 
        foreach ($personne as $pers){
            echo '<option name="personne" value="' . $pers['id'] . '">' . $pers['nom'] . ' ' . $pers['prenom'] . '</option>';
        }
        ?>
    </select>

<input id="bt" name="bt" type="submit" value="Afficher">
</form>

<?php
if (!empty($_POST) && !empty($_POST['bt'])) {
    $nom; $prenom; $email; $intitule; $adresse = array(); $contenu = array();
    $cv = new Cv($nom, $prenom, $email, $intitule, $adresse);
    
    foreach($cvmanager->selectAll() as $lignecv){
        if($lignecv['0'] == $_POST['personne']){
            $nom = $lignecv['nom'];$prenom = $lignecv['prenom'];
            $email = $lignecv['email'];$intitule = $lignecv['intitulecv'];
            $adresse = preRemplissageAdresse($lignecv['num'], $lignecv['rue'], $lignecv['cp'], $lignecv['ville'], $lignecv['pays']);
            
            if($lignecv['categorie'] == 1){$categorie = 'experience';}
            elseif ($lignecv['categorie'] == 2) {$categorie = 'formation';}
          
            $contenu = preRemplissageContenu($lignecv['intitule'], $lignecv['anneedebut'], $lignecv['anneefin'], $lignecv['ecole'], $lignecv['ville'], $categorie);
          
            $cv->construct($nom, $prenom, $email, $intitule, $adresse);
            $cv->construct_Contenu($contenu);
        }
    }
    $cv->afficher();
    
}