<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des propriétaires</title>
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
        $caCumule = $_POST['caCumule'];

    
        // Si l'identifiant de la news est renseigné, on modifie la news
        if (isset($_POST['num'])) {
            $num = $_POST['num'];
            //$appartement = new Appartement($categorie, $type, $nbpersonnes, $adresselocation, $photo, $equipements,$codetarif,$nomproprio,$prenomproprio); // création d'une instance de News avec les nouvelles données
            //$appartement->setNumLocation($numLocation); // set l'id de la news
            //$manager->updateAppartement($appartement,$numLocation); // mise à jour de la news dans la base de données
            
            //require_once('../donnees/Contrat.php');

            // Chemin du fichier XML
             $xmlFile = '../donnees/gesap.xml';

              // Charger le fichier XML
            $xml = simplexml_load_file($xmlFile);

            foreach ($xml->PROPRIETAIRES->PROPRIETAIRE as $proprietaire) {
                if ((int)$proprietaire->Num == $num) {
                  // Modifier les valeurs du contrat
                  $proprietaire->Nom = $nom;
                  $proprietaire->Prenom = $prenom;
                  $proprietaire->Adresse1 = $adresse1;
                  $proprietaire->Adresse2 = $adresse2;
                  $proprietaire->CodePostal = $codePostal;
                  $proprietaire->Ville = $ville;
                  $proprietaire->NumTel2 = $numTel2;
                  $proprietaire->NumTel1 = $numTel1;
                  $proprietaire->CAcumule = $caCumule;
                  $proprietaire->Email = $email;
            
            
                  // Enregistre les modifications dans le fichier XML avec indentation
            $xmlString = $xml->asXML();
            $dom = new DOMDocument("1.0");
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            $dom->loadXML($xmlString);
            $dom->save($xmlFile);
            // Message de succès après la modification
            echo '<div class="alert alert-success" role="alert">Le proprietaire a été modifié avec succès !</div>';

            $nom='';
            $prenom = '';
            $adresse1 = '';
            $adresse2 = '';
            $codePostal = '';
            $ville = '';
            $numTel1 = '';
            $numTel2 = '';
            $email = '';
            $caCumule = '';

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
$lastNum = (int) $xml->PROPRIETAIRES->PROPRIETAIRE[count($xml->PROPRIETAIRES->PROPRIETAIRE) - 1]->Num;

// Incrémenter la valeur maximale pour obtenir la nouvelle valeur de Num
$newNum = $lastNum + 1;

// Créer un nouvel élément APPARTEMENT
$nouvauProprietaire = $xml->PROPRIETAIRES->addChild('PROPRIETAIRE');

// Ajouter les éléments enfants au nouvel élément APPARTEMENT
$nouvauProprietaire->addChild('Num', $newNum);
$nouvauProprietaire->addChild('Nom', $nom);
$nouvauProprietaire->addChild('Prenom', $prenom);
$nouvauProprietaire->addChild('Adresse1', $adresse1);
$nouvauProprietaire->addChild('Adresse2', $adresse2);
$nouvauProprietaire->addChild('CodePostal', $codePostal);
$nouvauProprietaire->addChild('Ville', $ville);
$nouvauProprietaire->addChild('NumTel2', $numTel2);
$nouvauProprietaire->addChild('NumTel1', $numTel1);
$nouvauProprietaire->addChild('CAcumule', $caCumule);
$nouvauProprietaire->addChild('Email', $email);

// Enregistre les modifications dans le fichier XML avec indentation
$xmlString = $xml->asXML();
$dom = new DOMDocument("1.0");
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xmlString);
$dom->save($xmlFile);

            echo '<div class="alert alert-success" role="alert">Le proprietaire a été ajouté avec succès !</div>';

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
            $caCumule = '';
        }
    }
    
    // Si l'identifiant d'une news est renseigné pour la modifier ou la supprimer
    if (isset($_GET['action']) && isset($_GET['num'])) {
        $action = $_GET['action'];
        $num = $_GET['num'];
    
        // Si on souhaite modifier une news, on pré-remplit le formulaire avec ses informations
        if ($action == 'edit') {
                
            
//require_once('../donnees/Contrat.php');

// Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML
$xml = simplexml_load_file($xmlFile);

foreach ($xml->PROPRIETAIRES->PROPRIETAIRE as $proprietaire) {
    if ((int)$proprietaire->Num == $num) {
        $nom =$proprietaire->Nom;
        $prenom = $proprietaire->Prenom;
        $adresse1 = $proprietaire->Adresse1;
        $adresse2 = $proprietaire->Adresse2;
        $codePostal = $proprietaire->CodePostal;
        $ville = $proprietaire->Ville;
        $numTel1 = $proprietaire->NumTel1;
        $numTel2 = $proprietaire->NumTel2;
        $caCumule = $proprietaire->CAcumule;
        $email= $proprietaire->Email;
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
$proprietaires = $dom->getElementsByTagName('PROPRIETAIRE');
$elementASupprimer = null;

foreach ($proprietaires as $proprietaire) {
  $numproprio = $proprietaire->getElementsByTagName('Num')->item(0)->nodeValue;
  if ($numproprio == $num) {
    $elementASupprimer = $proprietaire;
    break;
  }
}

// Suppression de l'appartement s'il a été trouvé
if ($elementASupprimer !== null) {
  $elementASupprimer->parentNode->removeChild($elementASupprimer);
  $dom->save($xmlFile);
  echo '<div class="alert alert-success" role="alert">Le proprietaire a été supprimé avec succès !</div>';
} else {
  echo '<div class="alert alert-danger" role="alert">Le proprietaire à supprimer n\'a pas été trouvé.</div>';
}


      
        }
    }
    
    
    
 // Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML
$xml = simplexml_load_file($xmlFile);   

// Récupération de toutes les news
$allProprietaires = $xml->PROPRIETAIRES->PROPRIETAIRE;
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
<br><h1 style="font-family: cursive; text-align:center; font-weight:bold; color: red;">Gestion des Propriétaires</h1><br>
<!-- Formulaire pour ajouter ou modifier une news -->
<form method="POST" action="modification_proprietaires.php" enctype="multipart/form-data">
    <?php
    // Si on modifie une news, on ajoute un champ caché pour stocker son identifiant
    if (isset($num)) {
        echo '<input type="hidden" name="num" value="'.$num.'">';
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

    <div class="form-group">
    <label for="caCumule"></label>
    <input type="number" class="form-control" id="caCumule" name="caCumule" placeholder="Chiffre d'affaires cumulé" value="<?php echo isset($caCumule) ? $caCumule : ''; ?>" required>
    </div>
    <br>
    <button type="submit" name="submit" class="btn btn-primary"><?php if (isset($num)) echo 'Modifier'; else echo 'Ajouter'; ?> le propriétaire</button>
</form>
<br>
<br>
<h2>Liste des propriétaires</h2>
<table class="table table-striped">
 <thead>
    <tr>
        <th>Numéro du Propriétaire</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Adresse 1</th>
        <th>Adresse 2</th>
        <th>Code postal</th>
        <th>Ville</th>
        <th>Numéro de téléphone 1</th>
        <th>Numéro de téléphone 2</th>
        <th>Chiffre d'affaires cumulé</th>
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
$allProprietaires = $xml->PROPRIETAIRES->PROPRIETAIRE;

// Affichage de chaque news dans le tableau
foreach ($allProprietaires as $proprietaire) {
    echo '<tr>';
    echo '<td>'.$proprietaire->Num.'</td>';
    echo '<td>'.$proprietaire->Nom.'</td>';
    echo '<td>'.$proprietaire->Prenom.'</td>';
    echo '<td>'.$proprietaire->Adresse1.'</td>';
    echo '<td>'.$proprietaire->Adresse2.'</td>';
    echo '<td>'.$proprietaire->CodePostal.'</td>';
    echo '<td>'.$proprietaire->Ville.'</td>';
    echo '<td>'.$proprietaire->NumTel1.'</td>';
    echo '<td>'.$proprietaire->NumTel2.'</td>';
    echo '<td>'.$proprietaire->CAcumule.'</td>';
    echo '<td>'.$proprietaire->Email.'</td>';
    echo '<td>';
    echo '<a class="btn btn-primary" href="?action=edit&num='.$proprietaire->Num.'">&nbsp;&nbsp;&nbsp;Modifier</a>';
    echo '<a class="btn btn-danger" href="?action=delete&num='.$proprietaire->Num.'">Supprimer</a>';
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