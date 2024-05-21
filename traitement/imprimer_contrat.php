<?php 
require_once('dompdf/autoload.inc.php');

// Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML
$xml = simplexml_load_file($xmlFile);

global $bdd; // récupérer la connexion PDO à la base de données
$numContrat = $_POST['numContrat'];

/*// préparer la requête SQL pour récupérer la liste des appartements
$sql = "SELECT * FROM CONTRAT WHERE NumContrat=? ";
$stmt = $bdd->prepare($sql);

$stmt->bindValue(1, $numContrat);

$stmt->execute();

if($stmt->rowCount()==0){ 
  echo "Le contrat n'existe pas. ";
  exit();
}*/

$contr;

foreach ($xml->CONTRATS->CONTRAT as $contrat) {
  if ((int)$contrat->NumContrat == $numContrat) { 

    $contr=$contrat; 
    break;}}

use Dompdf\Dompdf;



// Créer le contenu HTML du contrat
$html = "<head>
  <meta charset='utf-8'>
  <title>Contrat de location</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    h1 {
      text-align: center;
    }
    table {
      width: 100%;
      margin-bottom: 20px;
      border-collapse: collapse;
    }
    th {
      background-color: #ddd;
      text-align: left;
      padding: 8px;
    }
    td {
      padding: 8px;
      border-bottom: 1px solid #ddd;
    }
    .sign1{
display: inline-block;
float: left;
    }
    .sign2{
      display: inline-block;
      float: right;      
          }
  </style>
</head>";

$html .= "<h1>Contrat de location</h1>";
$html .= "<table>";
$html .= "<tr>";
$html .= "<th>Numéro de contrat:</th>";
$html .= "<td>{$contr->NumContrat}</td>";
$html .= "</tr>";
$html .= "<tr>";
$html .= "<th>État:</th>";
$html .= "<td>{$contr->Etat}</td>";
$html .= "</tr>";
$html .= "<tr>";
$html .= "<th>Date de création:</th>";
$html .= "<td>{$contr->DateCreation}</td>";
$html .= "</tr>";
$html .= "<tr>";
$html .= "<th>Date de début:</th>";
$html .= "<td>{$contr->DateDebut}</td>";
$html .= "</tr>";
$html .= "<tr>";
$html .= "<th>Date de fin:</th>";
$html .= "<td>{$contr->Datefin}</td>";
$html .= "</tr>";
$html .= "<tr>";
$html .= "<th>Numéro de location de l'appartement:</th>";
$html .= "<td>{$contr->NumLocation}</td>";
$html .= "</tr>";
$html .= "<tr>";
foreach ($xml->APPARTEMENTS->APPARTEMENT as $appartement) {
  if ((int)$appartement->NumLocation == $contr->NumLocation) {
   $appart=$appartement;
   foreach ($xml->PROPRIETAIRES->PROPRIETAIRE as $proprietaire) {
    if ((int)$proprietaire->Num == $appart->Num) {
      $proprio=$proprietaire;
      $html .= "<th>Nom(s) et Prénom(s) du propriétaire:</th>";
      $html .= "<td>{$proprio->Nom}"." ". "{$proprio->Prenom}</td>";
      break;
  }}
  break;}}
  $html .= "</tr>";
  $html .= "<tr>";
  foreach ($xml->LOCATAIRES->LOCATAIRE as $locataire) {
    if ((int)$locataire->NumLocataire == $contr->NumLocataire) {
     $loca=$locataire;
     $html .= "<th>Nom(s) et Prénom(s) du locataire:</th>";
     $html .= "<td>{$loca->NomLocataire}"." ". "{$loca->PrenomLocataire}</td>";
     break;}
    }

$html .= "</tr>";
$html .= "</table>";
$html .= "</br></br></br></br></br>";
$html .= '<div class="signature">';
$html .= "<div class='sign1'><h2>Signature du propriétaire</h2></div>";
$html .= "<div class='sign2'><h2>Signature du locataire</h2></div>";
$html .= "</div>";

// créer un objet PDF et définir les paramètres de la page
$pdf = new Dompdf();

// ajouter le contenu HTML au document PDF et l'afficher
$pdf->loadHtml($html);
$pdf->setPaper('A4', 'landscape');
$pdf->render();
$pdf->stream("contrat.pdf", array("Attachment" => 0));

?>