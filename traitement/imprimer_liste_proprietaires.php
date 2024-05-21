<?php
    require_once('dompdf/autoload.inc.php');
// Chemin du fichier XML
$xmlFile = '../donnees/gesap.xml';

// Charger le fichier XML
$xml = simplexml_load_file($xmlFile);
$proprietaires=$xml->PROPRIETAIRES->PROPRIETAIRE;

    use Dompdf\Dompdf;

    // générer le contenu HTML de la liste des propriétaires
    $html = "<head><style> table {
        border-collapse: collapse;
        border: 1px solid black;
      }
      
      th, td {
        border: 1px solid black;
        padding: 5px;
      } </style></head>";

    $html .= "<h1>Liste des propriétaires</h1>";
    $html .= "<table>";
    $html .= "<tr><th>Numéro</th><th>Nom(s)</th><th>Prénom(s)</th><th>Adresses</th><th>Code postal</th><th>Ville</th><th>Numeros de téléphone</th><th>Email</th></tr>";
    foreach ($proprietaires as $proprietaire) {
        $html .= "<tr><td>{$proprietaire->Num}</td><td>{$proprietaire->Nom}</td><td>{$proprietaire->Prenom}</td><td>{$proprietaire->Adresse1}/{$proprietaire->Adresse2}</td><td>{$proprietaire->CodePostal}</td><td>{$proprietaire->Ville}</td><td>{$proprietaire->NumTel1}/{$proprietaire->NumTel2}</td><td>{$proprietaire->Email}</td></tr>";
    }
    $html .= "</table>";

    // générer le PDF à partir du contenu HTML
    $pdf = new Dompdf();
    $pdf->loadHtml($html);
    $pdf->setPaper('A4', 'landscape');
    $pdf->render();

    // envoyer le PDF au navigateur pour l'affichage ou le téléchargement
    $pdf->stream('liste_proprietaires.pdf', array("Attachment" => 0));


?>