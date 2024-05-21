<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des tarifs</title>
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
        $prixsemHS=$_POST['prixsemHS'];
        $prixSemBS = $_POST['prixSemBS'];


    
        // Si l'identifiant de la news est renseigné, on modifie la news
        if (isset($_POST['codeTarif'])) {
            $codeTarif = $_POST['codeTarif'];
            //$appartement = new Appartement($categorie, $type, $nbpersonnes, $adresselocation, $photo, $equipements,$codetarif,$nomproprio,$prenomproprio); // création d'une instance de News avec les nouvelles données
            //$appartement->setNumLocation($numLocation); // set l'id de la news
            //$manager->updateAppartement($appartement,$numLocation); // mise à jour de la news dans la base de données
            
            //require_once('../donnees/Contrat.php');

            // Chemin du fichier XML
             $xmlFile = '../donnees/gesap.xml';

              // Charger le fichier XML
            $xml = simplexml_load_file($xmlFile);

            foreach ($xml->TARIFS->TARIF as $tarif) {
                if ((int)$tarif->CodeTarif == $codeTarif) {
                  // Modifier les valeurs du contrat
                  $tarif->PrixsemHS = $prixsemHS;
                  $tarif->PrixSemBS = $prixSemBS;
            
                  // Enregistre les modifications dans le fichier XML avec indentation
            $xmlString = $xml->asXML();
            $dom = new DOMDocument("1.0");
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            $dom->loadXML($xmlString);
            $dom->save($xmlFile);
            // Message de succès après la modification
            echo '<div class="alert alert-success" role="alert">Le tarif a été modifié avec succès !</div>';

            $prixSemBS='';
            $prixsemHS = '';

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
$lastCodeTarif = (int) $xml->TARIFS->TARIF[count($xml->TARIFS->TARIF) - 1]->CodeTarif;

// Incrémenter la valeur maximale pour obtenir la nouvelle valeur de Num
$newCodeTarif = $lastCodeTarif + 1;

// Créer un nouvel élément APPARTEMENT
$nouvauTarif = $xml->TARIFS->addChild('TARIF');

// Ajouter les éléments enfants au nouvel élément APPARTEMENT
$nouvauTarif->addChild('CodeTarif', $newCodeTarif);
$nouvauTarif->addChild('PrixsemHS', $prixsemHS);
$nouvauTarif->addChild('PrixSemBS', $prixSemBS);

// Enregistre les modifications dans le fichier XML avec indentation
$xmlString = $xml->asXML();
$dom = new DOMDocument("1.0");
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xmlString);
$dom->save($xmlFile);

            echo '<div class="alert alert-success" role="alert">Le tarif a été ajouté avec succès !</div>';

            //reinitialiser les champs du formulaire
            $prixSemBS='';
            $prixsemHS = '';

        }
    }
    
    // Si l'identifiant d'une news est renseigné pour la modifier ou la supprimer
    if (isset($_GET['action']) && isset($_GET['codeTarif'])) {
        $action = $_GET['action'];
        $codeTarif = $_GET['codeTarif'];
    
        // Si on souhaite modifier une news, on pré-remplit le formulaire avec ses informations
        if ($action == 'edit') {
                
            
//require_once('../donnees/Contrat.php');

// Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML
$xml = simplexml_load_file($xmlFile);

foreach ($xml->TARIFS->TARIF as $tarif) {
    if ((int)$tarif->CodeTarif == $codeTarif) {
        $prixSemBS =$tarif->PrixSemBS;
        $prixsemHS = $tarif->PrixsemHS;
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
$tarifs = $dom->getElementsByTagName('TARIF');
$elementASupprimer = null;

foreach ($tarifs as $tarif) {
  $codetar = $tarif->getElementsByTagName('CodeTarif')->item(0)->nodeValue;
  if ($codetar == $codeTarif) {
    $elementASupprimer = $tarif;
    break;
  }
}

// Suppression de l'appartement s'il a été trouvé
if ($elementASupprimer !== null) {
  $elementASupprimer->parentNode->removeChild($elementASupprimer);
  $dom->save($xmlFile);
  echo '<div class="alert alert-success" role="alert">Le tarif a été supprimé avec succès !</div>';
} else {
  echo '<div class="alert alert-danger" role="alert">Le tarif à supprimer n\'a pas été trouvé.</div>';
}


      
        }
    }
    
    
    
 // Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML
$xml = simplexml_load_file($xmlFile);   

// Récupération de toutes les news
$allTarifs = $xml->TARIFS->TARIF;
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
<br><h1 style="font-family: cursive; text-align:center; font-weight:bold; color: red;">Gestion des tarifs</h1><br>
<!-- Formulaire pour ajouter ou modifier une news -->
<form method="POST" action="modification_tarifs.php" enctype="multipart/form-data">
    <?php
    // Si on modifie une news, on ajoute un champ caché pour stocker son identifiant
    if (isset($codeTarif)) {
        echo '<input type="hidden" name="codeTarif" value="'.$codeTarif.'">';
    }
    ?>
    <div class="form-group">
        <label for="prixSemBS"></label>
        <input type="text" class="form-control" id="prixSemBS" name="prixSemBS" placeholder="Prix de la semaine basse" value="<?php echo isset($prixSemBS) ? $prixSemBS : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="prixsemHS"></label>
        <input type="text" class="form-control" id="prixsemHS" name="prixsemHS" placeholder="Prix de la semaine haute" value="<?php echo isset($prixsemHS) ? $prixsemHS : ''; ?>" required>
    </div>
    <br>
    <button type="submit" name="submit" class="btn btn-primary"><?php if (isset($codeTarif)) echo 'Modifier'; else echo 'Ajouter'; ?> le propriétaire</button>
</form>
<br>
<br>
<h2>Liste des tarifs</h2>
<table class="table table-striped">
 <thead>
    <tr>
        <th>Code du tarif</th>
        <th>Prix de la semaine haute</th>
        <th>Prix de la semaine basse</th>
    </tr>
  </thead>
  <tbody>
<?php

// Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML
$xml = simplexml_load_file($xmlFile);

// Récupération de toutes les news
$allTarifs = $xml->TARIFS->TARIF;

// Affichage de chaque news dans le tableau
foreach ($allTarifs as $tarif) {
    echo '<tr>';
    echo '<td>'.$tarif->CodeTarif.'</td>';
    echo '<td>'.$tarif->PrixsemHS.'</td>';
    echo '<td>'.$tarif->PrixSemBS.'</td>';
    echo '<td>';
    echo '<a class="btn btn-primary" href="?action=edit&codeTarif='.$tarif->CodeTarif.'">&nbsp;&nbsp;&nbsp;Modifier</a>';
    echo '<a class="btn btn-danger" href="?action=delete&codeTarif='.$tarif->CodeTarif.'">Supprimer</a>';
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