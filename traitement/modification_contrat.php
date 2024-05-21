<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<?php 

//require_once('../donnees/Contrat.php');

// Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML
$xml = simplexml_load_file($xmlFile);

  // Récupération des données du formulaire
  $numContrat = $_POST['numContrat'];
  $etat = $_POST['etat'];
  $dateCreation = $_POST['dateCreation'];
  $dateDebut = $_POST['dateDebut'];
  $dateFin = $_POST['dateFin'];
  $numLocation = $_POST['numLocation'];
  $numLocation = $_POST['numLocation'];
  $numLocataire = $_POST['numLocataire'];

  //$contrat=New Contrat($numContrat,$etat,$dateCreation,$dateDebut,$dateFin,$numLocation,$nomLocataire,$prenomLocataire);
  //$contrat->modifierContrat();

  foreach ($xml->CONTRATS->CONTRAT as $contrat) {
    if ((int)$contrat->NumContrat == $numContrat) {
      // Modifier les valeurs du contrat
      $contrat->Etat = $etat;
      $contrat->DateCreation = $dateCreation;
      $contrat->DateDebut = $dateDebut;
      $contrat->Datefin = $dateFin;
      $contrat->NumLocation = $numLocation;
      $contrat->NumLocataire = $numLocataire;


      // Enregistre les modifications dans le fichier XML avec indentation
$xmlString = $xml->asXML();
$dom = new DOMDocument("1.0");
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;
$dom->loadXML($xmlString);
$dom->save($xmlFile);

echo '<div class="alert alert-success" role="alert">Le contrat a été modifié avec succès au fichier XML.</div>';



      break; // Sortir de la boucle une fois que le contrat est trouvé et modifié
    }
  }


?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>