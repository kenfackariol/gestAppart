<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php 

//require_once('../donnees/Proprietaire.php');

// Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML
$xml = simplexml_load_file($xmlFile);

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$adresse1 = $_POST['adresse1'];
$adresse2 = $_POST['adresse2'];
$codePostal = $_POST['codePostal'];
$ville = $_POST['ville'];
$numTel1 = $_POST['numTel1'];
$numTel2 = $_POST['numTel2'];
$caCumule = $_POST['caCumule'];
$email = $_POST['email'];

//$proprietaire= New Proprietaire($nom,$prenom,$adresse1,$adresse2,$codePostal,$ville,$numTel1,$numTel2,$caCumule,$email);

//$proprietaire->ajouterProprietaire();



// Trouver le dernier numéro de propriétaire existant
$lastNum = (int) $xml->PROPRIETAIRES->PROPRIETAIRE[count($xml->PROPRIETAIRES->PROPRIETAIRE) - 1]->Num;

// Incrémenter la valeur maximale pour obtenir la nouvelle valeur de Num
$newNum = $lastNum + 1;


// Créer un nouvel élément proprietaire
$nouveauProprietaire = $xml->PROPRIETAIRES->addChild('PROPRIETAIRE');

// Ajouter les données du proprietaire avec la nouvelle valeur de Num
$nouveauProprietaire->addChild('Num', $newNum);
$nouveauProprietaire->addChild('Nom', $nom);
$nouveauProprietaire->addChild('Prenom', $prenom);
$nouveauProprietaire->addChild('Adresse1', $adresse1);
$nouveauProprietaire->addChild('Adresse2', $adresse2);
$nouveauProprietaire->addChild('CodePostal', $codePostal);
$nouveauProprietaire->addChild('Ville', $ville);
$nouveauProprietaire->addChild('NumTel2', $numTel2);
$nouveauProprietaire->addChild('NumTel1', $numTel1);
$nouveauProprietaire->addChild('CAcumule', $caCumule);
$nouveauProprietaire->addChild('Email', $email);


// Enregistre les modifications dans le fichier XML avec indentation
$xmlString = $xml->asXML();
$dom = new DOMDocument("1.0");
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xmlString);
$dom->save($xmlFile);

echo '<div class="alert alert-success" role="alert">Le propriétaire a été ajouté avec succès au fichier XML.</div>';
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>