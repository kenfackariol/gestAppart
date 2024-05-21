<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php 

//require_once('../donnees/Contrat.php');

// Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML
$xml = simplexml_load_file($xmlFile);

  // Récupération des données du formulaire
  //$numContrat = $_POST['numContrat'];
  $etat = $_POST['etat'];
  $dateCreation = $_POST['dateCreation'];
  $dateDebut = $_POST['dateDebut'];
  $dateFin = $_POST['dateFin'];
  $numLocation = $_POST['numLocation'];
  $numLocataire = $_POST['numLocataire'];


  //$contrat=New Contrat($numContrat,$etat,$dateCreation,$dateDebut,$dateFin,$numLocation,$nomLocataire,$prenomLocataire);
  //$contrat->ajouterContrat();

  $lastNumContrat = (int) $xml->CONTRATS->CONTRAT[count($xml->CONTRATS->CONTRAT) - 1]->NumContrat;

  // Incrémenter la valeur maximale pour obtenir la nouvelle valeur de Num
$newNumContrat = $lastNumContrat + 1;

// Créer un nouvel élément APPARTEMENT
$nouveauContrat = $xml->CONTRATS->addChild('CONTRAT');

// Ajouter les éléments enfants au nouvel élément APPARTEMENT
$nouveauContrat->addChild('NumContrat', $newNumContrat);
$nouveauContrat->addChild('Etat', $etat);
$nouveauContrat->addChild('DateCreation', $dateCreation);
$nouveauContrat->addChild('DateDebut', $dateDebut);
$nouveauContrat->addChild('Datefin', $dateFin);
$nouveauContrat->addChild('NumLocation', $numLocation);
$nouveauContrat->addChild('NumLocataire', $numLocataire);

// Enregistre les modifications dans le fichier XML avec indentation
$xmlString = $xml->asXML();
$dom = new DOMDocument("1.0");
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xmlString);
$dom->save($xmlFile);

echo '<div class="alert alert-success" role="alert">Le contrat a été ajouté avec succès au fichier XML.</div>';

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>