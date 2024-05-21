<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des locataires</title>
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
        $nom=$_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse1 = $_POST['adresse1'];
        $adresse2 = $_POST['adresse2'];
        $codePostal = $_POST['codePostal'];
        $ville = $_POST['ville'];
        $numTel1 = $_POST['numTel1'];
        $numTel2 = $_POST['numTel2'];
        $email = $_POST['email'];

    
        // Si l'identifiant de la news est renseigné, on modifie la news
        if (isset($_POST['numLocataire'])) {
            $numLocataire = $_POST['numLocataire'];
            //$appartement = new Appartement($categorie, $type, $nbpersonnes, $adresselocation, $photo, $equipements,$codetarif,$nomproprio,$prenomproprio); // création d'une instance de News avec les nouvelles données
            //$appartement->setNumLocation($numLocation); // set l'id de la news
            //$manager->updateAppartement($appartement,$numLocation); // mise à jour de la news dans la base de données
            
            //require_once('../donnees/Contrat.php');

            // Chemin du fichier XML
             $xmlFile = '../donnees/gesap.xml';

              // Charger le fichier XML
            $xml = simplexml_load_file($xmlFile);

            foreach ($xml->LOCATAIRES->LOCATAIRE as $locataire) {
                if ((int)$locataire->NumLocataire == $numLocataire) {
                  // Modifier les valeurs du contrat
                  $locataire->NomLocataire = $nom;
                  $locataire->PrenomLocataire = $prenom;
                  $locataire->Adresse1Locataire = $adresse1;
                  $locataire->Adresse2Locataire = $adresse2;
                  $locataire->CodePostalLocataire = $codePostal;
                  $locataire->VilleLocataire = $ville;
                  $locataire->NumTel2Locataire = $numTel2;
                  $locataire->NumTel1Locataire = $numTel1;
                  $locataire->EmailLocataire = $email;
            
            
                  // Enregistre les modifications dans le fichier XML avec indentation
            $xmlString = $xml->asXML();
            $dom = new DOMDocument("1.0");
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            $dom->loadXML($xmlString);
            $dom->save($xmlFile);
            // Message de succès après la modification
            echo '<div class="alert alert-success" role="alert">Le locataire a été modifié avec succès !</div>';

            $nom='';
            $prenom = '';
            $adresse1 = '';
            $adresse2 = '';
            $codePostal = '';
            $ville = '';
            $numTel1 = '';
            $numTel2 = '';
            $email = '';

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
$lastNumLocataire = (int) $xml->LOCATAIRES->LOCATAIRE[count($xml->LOCATAIRES->LOCATAIRE) - 1]->NumLocataire;

// Incrémenter la valeur maximale pour obtenir la nouvelle valeur de Num
$newNumLocataire = $lastNumLocataire + 1;

// Créer un nouvel élément APPARTEMENT
$nouvauLocataire = $xml->LOCATAIRES->addChild('LOCATAIRE');

// Ajouter les éléments enfants au nouvel élément APPARTEMENT
$nouvauLocataire->addChild('NumLocataire', $newNumLocataire);
$nouvauLocataire->addChild('NomLocataire', $nom);
$nouvauLocataire->addChild('PrenomLocataire', $prenom);
$nouvauLocataire->addChild('Adresse1Locataire', $adresse1);
$nouvauLocataire->addChild('Adresse2Locataire', $adresse2);
$nouvauLocataire->addChild('CodePostalLocataire', $codePostal);
$nouvauLocataire->addChild('VilleLocataire', $ville);
$nouvauLocataire->addChild('NumTel2Locataire', $numTel2);
$nouvauLocataire->addChild('NumTel1Locataire', $numTel1);
$nouvauLocataire->addChild('EmailLocataire', $email);

// Enregistre les modifications dans le fichier XML avec indentation
$xmlString = $xml->asXML();
$dom = new DOMDocument("1.0");
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xmlString);
$dom->save($xmlFile);

            echo '<div class="alert alert-success" role="alert">Le locataire a été ajouté avec succès !</div>';

            //reinitialiser les champs du formulaire
            $nom='';
            $prenom = '';
            $adresse1 = '';
            $adresse2 = '';
            $codePostal = '';
            $ville = '';
            $numTel1 = '';
            $numTel2 = '';
            $email = '';
        }
    }
    
    // Si l'identifiant d'une news est renseigné pour la modifier ou la supprimer
    if (isset($_GET['action']) && isset($_GET['numLocataire'])) {
        $action = $_GET['action'];
        $numLocataire = $_GET['numLocataire'];
    
        // Si on souhaite modifier une news, on pré-remplit le formulaire avec ses informations
        if ($action == 'edit') {
                
            
//require_once('../donnees/Contrat.php');

// Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML
$xml = simplexml_load_file($xmlFile);

foreach ($xml->LOCATAIRES->LOCATAIRE as $locataire) {
    if ((int)$locataire->NumLocataire == $numLocataire) {
        $nom =$locataire->NomLocataire;
        $prenom = $locataire->PrenomLocataire;
        $adresse1 = $locataire->Adresse1Locataire;
        $adresse2 = $locataire->Adresse2Locataire;
        $codePostal = $locataire->CodePostalLocataire;
        $ville = $locataire->VilleLocataire;
        $numTel1 = $locataire->NumTel1Locataire;
        $numTel2 = $locataire->NumTel2Locataire;
        $email= $locataire->EmailLocataire;
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
$locataires = $dom->getElementsByTagName('LOCATAIRE');
$elementASupprimer = null;

foreach ($locataires as $locataire) {
  $numloc = $locataire->getElementsByTagName('NumLocataire')->item(0)->nodeValue;
  if ($numloc == $numLocataire) {
    $elementASupprimer = $locataire;
    break;
  }
}

// Suppression de l'appartement s'il a été trouvé
if ($elementASupprimer !== null) {
  $elementASupprimer->parentNode->removeChild($elementASupprimer);
  $dom->save($xmlFile);
  echo '<div class="alert alert-success" role="alert">Le locataire a été supprimé avec succès !</div>';
} else {
  echo '<div class="alert alert-danger" role="alert">Le locataire à supprimer n\'a pas été trouvé.</div>';
}


      
        }
    }
    
    
    
 // Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML
$xml = simplexml_load_file($xmlFile);   

// Récupération de toutes les news
$allLocataires = $xml->LOCATAIRES->LOCATAIRE;
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
<br><h1 style="font-family: cursive; text-align:center; font-weight:bold; color: red;">Gestion des Locataires</h1><br>
<!-- Formulaire pour ajouter ou modifier une news -->
<form method="POST" action="modification_locataires.php" enctype="multipart/form-data">
    <?php
    // Si on modifie une news, on ajoute un champ caché pour stocker son identifiant
    if (isset($numLocataire)) {
        echo '<input type="hidden" name="numLocataire" value="'.$numLocataire.'">';
    }
    ?>
    <div class="form-group">
        <label for="nom"></label>
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" value="<?php echo isset($nom) ? $nom : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="prenom"></label>
        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" value="<?php echo isset($prenom) ? $prenom : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="adresse1"></label>
        <input type="text" class="form-control" id="adresse1" name="adresse1" placeholder="Adresse numéro 1:" value="<?php echo isset($adresse1) ? $adresse1 : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="adresse2"></label>
        <input type="text" class="form-control" id="adresse2" name="adresse2" placeholder="Adresse numéro 2:" value="<?php echo isset($adresse2) ? $adresse2 : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="codePostal"></label>
        <input type="text" class="form-control" id="codePostal" name="codePostal" placeholder="codePostal" value="<?php echo isset($codePostal) ? $codePostal : ''; ?>" required>
    </div>

    <div class="form-group">
        <label for="ville"></label>
        <input type="text" class="form-control" id="ville" name="ville" placeholder="Ville" value="<?php echo isset($ville) ? $ville : ''; ?>" required>
    </div>

    <div class="form-group">
    <label for="numTel1"></label>
    <input type="text" class="form-control" id="numTel1" name="numTel1" placeholder="Numéro de téléphone 1" value="<?php echo isset($numTel1) ? $numTel1 : ''; ?>" required>
    </div>

    <div class="form-group">
    <label for="numTel2"></label>
    <input type="text" class="form-control" id="numTel2" name="numTel2" placeholder="Numéro de téléphone 2" value="<?php echo isset($numTel2) ? $numTel2 : ''; ?>" required>
    </div>

    <div class="form-group">
    <label for="email"></label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo isset($email) ? $email : ''; ?>" required>
    </div>
    <br>
    <button type="submit" name="submit" class="btn btn-primary"><?php if (isset($numLocataire)) echo 'Modifier'; else echo 'Ajouter'; ?> le propriétaire</button>
</form>
<br>
<br>
<h2>Liste des propriétaires</h2>
<table class="table table-striped">
 <thead>
    <tr>
        <th>Numéro du Locataire</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Adresse 1</th>
        <th>Adresse 2</th>
        <th>Code postal</th>
        <th>Ville</th>
        <th>Numéro de téléphone 1</th>
        <th>Numéro de téléphone 2</th>
        <th>Email</th>
    </tr>
  </thead>
  <tbody>
<?php

// Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML
$xml = simplexml_load_file($xmlFile);

// Récupération de toutes les news
$allLocataires = $xml->LOCATAIRES->LOCATAIRE;

// Affichage de chaque news dans le tableau
foreach ($allLocataires as $locataire) {
    echo '<tr>';
    echo '<td>'.$locataire->NumLocataire.'</td>';
    echo '<td>'.$locataire->NomLocataire.'</td>';
    echo '<td>'.$locataire->PrenomLocataire.'</td>';
    echo '<td>'.$locataire->Adresse1Locataire.'</td>';
    echo '<td>'.$locataire->Adresse2Locataire.'</td>';
    echo '<td>'.$locataire->CodePostalLocataire.'</td>';
    echo '<td>'.$locataire->VilleLocataire.'</td>';
    echo '<td>'.$locataire->NumTel1Locataire.'</td>';
    echo '<td>'.$locataire->NumTel2Locataire.'</td>';
    echo '<td>'.$locataire->EmailLocataire.'</td>';
    echo '<td>';
    echo '<a class="btn btn-primary" href="?action=edit&numLocataire='.$locataire->NumLocataire.'">&nbsp;&nbsp;&nbsp;Modifier</a>';
    echo '<a class="btn btn-danger" href="?action=delete&numLocataire='.$locataire->NumLocataire.'">Supprimer</a>';
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