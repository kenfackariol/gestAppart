<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php 

// Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML
$xml = simplexml_load_file($xmlFile);

//require_once('../donnees/Tarif.php');

$prixSemHS = $_POST['prixsemHS'];
$prixSemBS = $_POST['prixsemBS'];

// Trouver le dernier numéro de propriétaire existant
$lastCodeTarif = (int) $xml->TARIFS->TARIF[count($xml->TARIFS->TARIF) - 1]->CodeTarif;

// Incrémenter la valeur maximale pour obtenir la nouvelle valeur de Num
$newCodeTarif = $lastCodeTarif + 1;

// Créer un nouvel élément APPARTEMENT
$nouveauTarif = $xml->TARIFS->addChild('TARIF');

// Ajouter les éléments enfants au nouvel élément APPARTEMENT
$nouveauTarif->addChild('CodeTarif', $newCodeTarif);
$nouveauTarif->addChild('PrixsemHS', $prixSemHS);
$nouveauTarif->addChild('PrixSemBS', $prixSemBS);

// Enregistre les modifications dans le fichier XML avec indentation
$xmlString = $xml->asXML();
$dom = new DOMDocument("1.0");
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xmlString);
$dom->save($xmlFile);

echo '<div class="alert alert-success" role="alert">Le tarif a été ajouté avec succès au fichier XML.</div>';

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>