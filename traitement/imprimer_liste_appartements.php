<?php 

require_once('dompdf/autoload.inc.php');



// Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML
$xml = simplexml_load_file($xmlFile);

$rows = $xml->APPARTEMENTS->APPARTEMENT;

use Dompdf\Dompdf;

// créer un objet PDF et définir les paramètres de la page
$pdf = new Dompdf();

// créer le contenu HTML de la liste des appartements
$html = "<head><style> table {
    border-collapse: collapse;
    border: 1px solid black;
  }
  
  th, td {
    border: 1px solid black;
    padding: 5px;
  } </style></head>";
  
$html .= "<h1>Liste des appartements</h1>";
$html .= "<table>";
$html .= "<tr><th>Numéro de location</th><th>Catégorie</th><th>Type</th><th>Nombre de personnes</th><th>Adresse</th><th>Photo</th><th>Équipements</th><th>Code tarif</th><th>Numéro de propriétaire</th></tr>";

// parcourir les résultats de la requête et ajouter chaque appartement dans le contenu HTML
foreach ($rows as $row) {
    $html .= "<tr>";
    $html .= "<td>".$row->NumLocation."</td>";
    $html .= "<td>".$row->Categorie."</td>";
    $html .= "<td>".$row->Type."</td>";
    $html .= "<td>".$row->NbPersonnes."</td>";
    $html .= "<td>".$row->AdresseLocation."</td>";
    //echo '<td><img style="width: 500px; height: 100px;" src="data:image/jpeg;base64,'.$photo.'"/></td>';
    $photo=base64_encode(file_get_contents('../presentation/'.$row->photo));
    $html .= '<td style="width: 400px;"><img style="width: 100%;" src="data:image/jpeg;base64,'.$photo.'"/></td>';

    //$html .= "<td>".$row['Photo']."</td>";

    $html .= "<td>".$row->Equipements."</td>";
    $html .= "<td>".$row->CodeTarif."</td>";
    $html .= "<td>".$row->Num."</td>";
    $html .= "</tr>";
}

$html .= "</table>";
// ajouter le contenu HTML au document PDF et l'afficher
$pdf->loadHtml($html);
$pdf->setPaper('A4', 'landscape');
$pdf->render();
$pdf->stream("liste_appartements.pdf", array('Attachment' => 0));
echo $html;


?>