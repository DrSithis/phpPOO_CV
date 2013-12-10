<?php
require_once('bdd/connect_pdo.php');
require_once('func/func.php');
require_once('func/jeuessaie.func.php');
require_once('class/cv.class.php');
require_once('class/cv_manager.class.php');
$cvmanager = new CvManager($db);

$personne = $cvmanager->selectAllNomPersonne();
       
?>

<form id="form" action="index.php" name="formulaire" method="POST">
    <input id="btinsertct" name="btinsertct" type="submit" value="Insertion Contenue">
<!--<input id="btinsertct" name="btinsertcv" type="submit" value="Nouveau CV">-->
<br><br>
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

if (!empty($_POST) && !empty($_POST['btinsertct'])) {?>

<form id="form" action="insert.php" name="formulaire" method="POST">
    <label for='intitule'>Intitule :</label><input type="text" id='intitule' name="intitule"/><br>
    <label for='anneedebut'>Annee Debut :</label><input type="text" id='anneedebut' name="anneedebut"/><br>
    <label for='anneefin'>Annee Fin :</label><input type="text" id='anneefin' name="anneefin"/><br>
    <label for='ecole'>Ecole/Universite :</label><input type="text" id='ecole' name="ecole"/><br>
    <label for='ville'>Ville :</label><input type="text" id='ville' name="ville"/><br>
    <select name="categorie">
        <option name="categorie" value="experience"> Experience Pro</option>
        <option name="categorie" value="formation"> Formation</option>
    </select>
    <br>
    <input type='hidden' name='idpers' value='<?php echo $_POST['personne']; ?>'/>
    <input id="bt" name="bt" type="submit" value="Ajouter">
</form>


<?php }
