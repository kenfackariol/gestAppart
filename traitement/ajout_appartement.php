<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php 

//require_once('../donnees/Appartement.php');

// Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML
$xml = simplexml_load_file($xmlFile);

$dossier_images="images/";

$categorie = $_POST['categorie'];
$type = $_POST['type'];
$nbPersonnes = $_POST['nbPersonnes'];
$adresseLocation = $_POST['adresseLocation'];
$photo = $dossier_images.basename($_FILES['photo']['name']);
$equipements = $_POST['equipements'];
$codeTarif = $_POST['codeTarif'];
$num = $_POST['num'];

//$appartement=New Appartement($categorie,$type,$nbPersonnes,$adresseLocation,$photo,$equipements,$codeTarif,$nom,$prenom);

//$appartement->ajouterAppartement();

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
$nouvelAppartement->addChild('NbPersonnes', $nbPersonnes);
$nouvelAppartement->addChild('AdresseLocation', $adresseLocation);
$nouvelAppartement->addChild('photo', $photo);
$nouvelAppartement->addChild('Equipements', $equipements);
$nouvelAppartement->addChild('CodeTarif', $codeTarif);
$nouvelAppartement->addChild('Num', $num);

// Enregistre les modifications dans le fichier XML avec indentation
$xmlString = $xml->asXML();
$dom = new DOMDocument("1.0");
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xmlString);
$dom->save($xmlFile);

echo '<div class="alert alert-success" role="alert">L\'appartement a été ajouté avec succès au fichier XML.</div>';


?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>