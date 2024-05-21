<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php 

// Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML
$xml = simplexml_load_file($xmlFile);


  // Récupérer les données du formulaire
  $nomLocataire = $_POST["nomLocataire"];
  $prenomLocataire = $_POST["prenomLocataire"];
  $adresse1Locataire = $_POST["adresse1Locataire"];
  $adresse2Locataire = $_POST["adresse2Locataire"];
  $codePostalLocataire = $_POST["codePostalLocataire"];
  $villeLocataire = $_POST["villeLocataire"];
  $numTel2Locataire = $_POST["numTel2Locataire"];
  $numTel1Locataire = $_POST["numTel1Locataire"];
  $emailLocataire = $_POST["emailLocataire"];

 // Trouver le dernier numéro de propriétaire existant
$lastNumLocataire = (int) $xml->LOCATAIRES->LOCATAIRE[count($xml->LOCATAIRES->LOCATAIRE) - 1]->NumLocataire;

// Incrémenter la valeur maximale pour obtenir la nouvelle valeur de Num
$newNumLocataire = $lastNumLocataire + 1;

// Créer un nouvel élément APPARTEMENT
$nouveauLocataire = $xml->LOCATAIRES->addChild('LOCATAIRE');

// Ajouter les éléments enfants au nouvel élément APPARTEMENT
$nouveauLocataire->addChild('NumLocataire', $newNumLocataire);
$nouveauLocataire->addChild('NomLocataire', $nomLocataire);
$nouveauLocataire->addChild('PrenomLocataire', $prenomLocataire);
$nouveauLocataire->addChild('Adresse1Locataire', $adresse1Locataire);
$nouveauLocataire->addChild('Adresse2Locataire', $adresse2Locataire);
$nouveauLocataire->addChild('CodePostalLocataire', $codePostalLocataire);
$nouveauLocataire->addChild('VilleLocataire', $villeLocataire);
$nouveauLocataire->addChild('NumTel2Locataire', $numTel2Locataire);
$nouveauLocataire->addChild('NumTel1Locataire', $numTel1Locataire);
$nouveauLocataire->addChild('EmailLocataire', $emailLocataire);

// Enregistre les modifications dans le fichier XML avec indentation
$xmlString = $xml->asXML();
$dom = new DOMDocument("1.0");
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xmlString);
$dom->save($xmlFile);

echo '<div class="alert alert-success" role="alert">Le locataire a été ajouté avec succès au fichier XML.</div>';

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>