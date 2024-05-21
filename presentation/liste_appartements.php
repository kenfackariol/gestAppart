<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des appartements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style> body{ font-family: cursive;} </style>
</head>
<body>
<?php
/*
    // Inclusion des classes et de la connexion à la base de données
    require_once('../donnees/Appartement.php');
    require_once('../donnees/Manager.php');
    require_once('../donnees/Connexion.php');
    
    global $bdd;

    // Création d'une instance de Manager
    $manager = new Manager($bdd);*/
    
    // Si le formulaire a été soumis pour ajouter ou modifier une news
    if (isset($_POST['submit'])) {
        $dossier_images="images/";
        $categorie = $_POST['categorie'];
        $type = $_POST['type'];
        $nbpersonnes = $_POST['nbpersonnes'];
        $adresselocation = $_POST['adresselocation'];
        $photo = $dossier_images.basename($_FILES['photo']['name']);
        $equipements = $_POST['equipements'];
        $codetarif = $_POST['codetarif'];
        $num = $_POST['num'];

    
        // Si l'identifiant de la news est renseigné, on modifie la news
        if (isset($_POST['numLocation'])) {
            $numLocation = $_POST['numLocation'];
            //$appartement = new Appartement($categorie, $type, $nbpersonnes, $adresselocation, $photo, $equipements,$codetarif,$nomproprio,$prenomproprio); // création d'une instance de News avec les nouvelles données
            //$appartement->setNumLocation($numLocation); // set l'id de la news
            //$manager->updateAppartement($appartement,$numLocation); // mise à jour de la news dans la base de données
            
            //require_once('../donnees/Contrat.php');

            // Chemin du fichier XML
             $xmlFile = '../donnees/gesap.xml';

              // Charger le fichier XML
            $xml = simplexml_load_file($xmlFile);

            foreach ($xml->APPARTEMENTS->APPARTEMENT as $appartement) {
                if ((int)$appartement->NumLocation == $numLocation) {
                  // Modifier les valeurs du contrat
                  $appartement->Categorie = $categorie;
                  $appartement->Type = $type;
                  $appartement->NbPersonnes = $nbpersonnes;
                  $appartement->AdresseLocation = $adresselocation;
                  $appartement->photo = $photo;
                  $appartement->Equipements = $equipements;
                  $appartement->CodeTarif = $codetarif;
                  $appartement->Num = $num;
            
            
                  // Enregistre les modifications dans le fichier XML avec indentation
            $xmlString = $xml->asXML();
            $dom = new DOMDocument("1.0");
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            $dom->loadXML($xmlString);
            $dom->save($xmlFile);
            // Message de succès après la modification
            echo '<div class="alert alert-success" role="alert">L\'appartement a été modifié avec succès !</div>';

            //reinitialiser les champs du formulaire
            $categorie = '';
            $type = '';
            $nbpersonnes = '';
            $adresselocation = '';
            $photo = '';
            $equipements = '';
            $codetarif = '';
            $num = '';

            break;}}
        }
        // Sinon, on ajoute une nouvelle news
        else {
            //$appartement = new Appartement($categorie, $type, $nbpersonnes, $adresselocation, $photo, $equipements,$codetarif,$nomproprio,$prenomproprio); // création d'une instance de News avec les données du formulaire
            //$manager->addAppartment($appartement); // ajout de la news dans la base de données
            // Message de succès après l'ajout
            
            // Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML
$xml = simplexml_load_file($xmlFile);

// Trouver le dernier numéro de propriétaire existant
$lastNumLocation = (int) $xml->APPARTEMENTS->APPARTEMENT[count($xml->APPARTEMENTS->APPARTEMENT) - 1]->NumLocation;

// Incrémenter la valeur maximale pour obtenir la nouvelle valeur de Num
$newNumLocation = $lastNumLocation + 1;

// Créer un nouvel élément APPARTEMENT
$nouvelAppartement = $xml->APPARTEMENTS->addChild('APPARTEMENT');

// Ajouter les éléments enfants au nouvel élément APPARTEMENT
$nouvelAppartement->addChild('NumLocation', $newNumLocation);
$nouvelAppartement->addChild('Categorie', $categorie);
$nouvelAppartement->addChild('Type', $type);
$nouvelAppartement->addChild('NbPersonnes', $nbpersonnes);
$nouvelAppartement->addChild('AdresseLocation', $adresselocation);
$nouvelAppartement->addChild('photo', $photo);
$nouvelAppartement->addChild('Equipements', $equipements);
$nouvelAppartement->addChild('CodeTarif', $codetarif);
$nouvelAppartement->addChild('Num', $num);

// Enregistre les modifications dans le fichier XML avec indentation
$xmlString = $xml->asXML();
$dom = new DOMDocument("1.0");
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xmlString);
$dom->save($xmlFile);

            echo '<div class="alert alert-success" role="alert">L\'appartement a été ajoutée avec succès !</div>';

            //reinitialiser les champs du formulaire
            $categorie = '';
            $type = '';
            $nbpersonnes = '';
            $adresselocation = '';
            $photo = '';
            $equipements = '';
            $codetarif = '';
            $num = '';
        }
    }
    
    // Si l'identifiant d'une news est renseigné pour la modifier ou la supprimer
    if (isset($_GET['action']) && isset($_GET['numLocation'])) {
        $action = $_GET['action'];
        $numLocation = $_GET['numLocation'];
    
        // Si on souhaite modifier une news, on pré-remplit le formulaire avec ses informations
        if ($action == 'edit') {
                
            
//require_once('../donnees/Contrat.php');

// Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML
$xml = simplexml_load_file($xmlFile);

foreach ($xml->APPARTEMENTS->APPARTEMENT as $appartement) {
    if ((int)$appartement->NumLocation == $numLocation) {
        $categorie =$appartement->Categorie;
        $type = $appartement->Type;
        $nbpersonnes = $appartement->NbPersonnes;
        $adresselocation = $appartement->AdresseLocation;
        $photo = $appartement->photo;
        $equipements = $appartement->Equipements;
        $codetarif = $appartement->CodeTarif;
        $num= $appartement->Num;
        break;}}

        }
        // Sinon, on supprime la news correspondante
        else if ($action == 'delete') {
// Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML en tant qu'objet DOM
$dom = new DOMDocument();
$dom->load($xmlFile);


// Recherche de l'appartement à supprimer
$appartements = $dom->getElementsByTagName('APPARTEMENT');
$elementASupprimer = null;

foreach ($appartements as $appartement) {
  $numappart = $appartement->getElementsByTagName('NumLocation')->item(0)->nodeValue;
  if ($numappart == $numLocation) {
    $elementASupprimer = $appartement;
    break;
  }
}

// Suppression de l'appartement s'il a été trouvé
if ($elementASupprimer !== null) {
  $elementASupprimer->parentNode->removeChild($elementASupprimer);
  $dom->save($xmlFile);
  echo '<div class="alert alert-success" role="alert">L\'appartement a été supprimé avec succès !</div>';
} else {
  echo '<div class="alert alert-danger" role="alert">L\'appartement à supprimer n\'a pas été trouvé.</div>';
}


      
        }
    }
    
    
    
 // Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML
$xml = simplexml_load_file($xmlFile);   

// Récupération de toutes les news
$allAppartements = $xml->APPARTEMENTS->APPARTEMENT;
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
<br><h1 style="font-family: cursive; text-align:center; font-weight:bold; color: red;">Gestion des Appartements</h1><br>
<!-- Formulaire pour ajouter ou modifier une news -->
<form method="POST" action="liste_appartements.php" enctype="multipart/form-data">
    <?php
    // Si on modifie une news, on ajoute un champ caché pour stocker son identifiant
    if (isset($numLocation)) {
        echo '<input type="hidden" name="numLocation" value="'.$numLocation.'">';
    }
    ?>
    <div class="form-group">
        <label for="categorie"></label>
        <input type="text" class="form-control" id="categorie" name="categorie" placeholder="Categorie" value="<?php echo isset($categorie) ? $categorie : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="type"></label>
        <input type="text" class="form-control" id="type" name="type" placeholder="Type" value="<?php echo isset($type) ? $type : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="nbpersonnes"></label>
        <input type="text" class="form-control" id="nbpersonnes" name="nbpersonnes" placeholder="Nombre de personnes" value="<?php echo isset($nbpersonnes) ? $nbpersonnes : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="adresselocation"></label>
        <input type="text" class="form-control" id="adresselocation" name="adresselocation" placeholder="Adresse de location" value="<?php echo isset($adresselocation) ? $adresselocation : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="photo"></label>
        <input type="file" class="form-control" id="photo" name="photo" accept="image/*" placeholder="Photo" value="" required>
    </div>

    <div class="form-group">
        <label for="equipements"></label>
        <input type="text" class="form-control" id="equipements" name="equipements" placeholder="Equipements" value="<?php echo isset($equipements) ? $equipements : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="codetarif"></label>
        <!--input type="text" class="form-control" id="codetarif" name="codetarif" placeholder="Code du tarif" value="<?php echo isset($codetarif) ? $codetarif : ''; ?>" required-->
        <select name="codetarif" id="codetarif" required class="form-control">
                    <option value="<?php echo isset($codetarif) ? $codetarif : ''; ?>"><?php if (isset($codetarif)) echo "Tarif avant la modification" ; else echo "Choisir le tarif"; ?></option>Tarif avant la modification</option>
                                <?php
                                    // Chemin du fichier XML
                                 $xmlFile = '../donnees/gesap.xml';

                                   // Charger le fichier XML
                                 $xml = simplexml_load_file($xmlFile);

                                   // Parcourir les éléments TARIF du fichier XML
                                 foreach ($xml->TARIFS->TARIF as $tarif) {
                                 $codeTarif = $tarif->CodeTarif;
                                 $prixSemHS = $tarif->PrixsemHS;
                                 $prixSemBS = $tarif->PrixSemBS;
                                 echo '<option value="' . $codeTarif . '">'.' PrixSemHS='.$prixSemHS.' PrixSemBS='.$prixSemHS. '</option>';
                                  }

                                ?></select>
    </div>

    <div class="form-group">
        <label for="num"></label>
        <!--input type="text" class="form-control" id="num" name="num" placeholder="Nom du propriétaire" value="<?php echo isset($num) ? $num : ''; ?>" required-->
        <select name="num" id="num" required class="form-control" placeholder="Choisir le propriétaire">
                    <option value="<?php echo isset($num) ? $num : ''; ?>"><?php if (isset($num)) echo "Le proprietaire avant la modification"; else echo "Choisir le propriétaire";?></option>
                                <?php
                                    // Chemin du fichier XML
                                    $xmlFile = '../donnees/gesap.xml';

                                    // Charger le fichier XML
                                  $xml = simplexml_load_file($xmlFile);
 
                                    // Parcourir les éléments TARIF du fichier XML
                                  foreach ($xml->PROPRIETAIRES->PROPRIETAIRE as $proprietaire) {
                                  $numproprio = $proprietaire->Num;
                                  $nomproprio = $proprietaire->Nom;
                                  $prenomproprio = $proprietaire->Prenom;

                                  echo '<option value="' . $numproprio . '">' .$nomproprio.' '.$prenomproprio. '</option>';
                                   }

                                ?></select>


    </div>
    <br>
    <button type="submit" name="submit" class="btn btn-primary"><?php if (isset($numLocation)) echo 'Modifier'; else echo 'Ajouter'; ?> l'appartement</button>
</form>
<br>
<br>
<h2>Liste des appartements</h2>
<table class="table table-striped">
 <thead>
    <tr>
        <th>Numero de Location</th>
        <th>Categorie</th>
        <th>Type</th>
        <th>Nombre de personnes</th>
        <th>Adresse de location</th>
        <th>Photo</th>
        <th>Equipements</th>
        <th>Code du tarif</th>
        <th>Numero du proprietaire</th>
    </tr>
  </thead>
  <tbody>
<?php

// Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML
$xml = simplexml_load_file($xmlFile);

// Récupération de toutes les news
$allAppartements = $xml->APPARTEMENTS->APPARTEMENT;

// Affichage de chaque news dans le tableau
foreach ($allAppartements as $appartement) {
    echo '<tr>';
    echo '<td>'.$appartement->NumLocation.'</td>';
    echo '<td>'.$appartement->Categorie.'</td>';
    echo '<td>'.$appartement->Type.'</td>';
    echo '<td>'.$appartement->NbPersonnes.'</td>';
    echo '<td>'.$appartement->AdresseLocation.'</td>';
    echo '<td style="width: 600px;"><img style="width: 100%;" src="'.$appartement->photo.'"/></td>';
    echo '<td>'.$appartement->Equipements.'</td>';
    echo '<td>'.$appartement->CodeTarif.'</td>';
    echo '<td>'.$appartement->Num.'</td>';
    echo '<td>';
    echo '<a class="btn btn-primary" href="?action=edit&numLocation='.$appartement->NumLocation.'">&nbsp;&nbsp;&nbsp;Modifier</a>';
    echo '<a class="btn btn-danger" href="?action=delete&numLocation='.$appartement->NumLocation.'">Supprimer</a>';
    echo '</td>';
    echo '</tr>';
}
?>
</tbody>
</table>
</div>
</div>
</div>
<!-- Ajout du CDN de Bootstrap 5 pour les scripts Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>