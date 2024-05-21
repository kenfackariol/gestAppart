<?php 

require_once('dompdf/autoload.inc.php');

// Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML
$xml = simplexml_load_file($xmlFile);
$locataires=$xml->LOCATAIRES->LOCATAIRE;


    use Dompdf\Dompdf;
    
    $html = "<head><style> table {
        border-collapse: collapse;
        border: 1px solid black;
      }
      
      th, td {
        border: 1px solid black;
        padding: 5px;
      } </style></head>";
      
    $html .= '<h1>Liste des locataires</h1>';
    $html .= '<table>';
    $html .= '<tr><th>Numéro</th><th>Nom(s)</th><th>Prénom(s)</th><th>Adresses</th><th>Code postal</th><th>Ville</th><th>Numeros de téléphone</th><th>Email</th></tr>';
    foreach ($locataires as $locataire) {
        $html .= '<tr>';
        $html .= '<td>' . $locataire->NumLocataire. '</td>';
        $html .= '<td>' . $locataire->NomLocataire. '</td>';
        $html .= '<td>' . $locataire->PrenomLocataire. '</td>';
        $html .= '<td>' . $locataire->Adresse1Locataire . '/ ' . $locataire->Adresse2Locataire. '</td>';
        $html .= '<td>'. $locataire->CodePostalLocataire. '</td>'; 
        $html .= '<td>'. $locataire->VilleLocataire.'</td>';
        $html .= '<td>' . $locataire->NumTel1Locataire. '/ ' . $locataire->NumTel2Locataire.'</td>';
        $html .= '<td>' . $locataire->EmailLocataire . '</td>';
        $html .= '</tr>';
    }
    $html .= '</table>';
    $pdf = new Dompdf();
    $pdf->loadHtml($html);
    $pdf->setPaper('A4', 'landscape');
    $pdf->render();
    $pdf->stream("liste_locataires.pdf", array("Attachment" => 0));

?>