<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des contrats du locataire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style> body{ font-family: cursive;} </style>
</head>
<body>
<?php
// Récupérer le numéro de locataire à partir des paramètres de requête
if (isset($_GET['numLocataire'])) {
    $xmlFile = '../donnees/gesap.xml';

            // Charger le fichier XML
    $xml = simplexml_load_file($xmlFile);

    $numLocataire = $_GET['numLocataire'];
    $resultat=array();
    $i=0;
    foreach ($xml->CONTRATS->CONTRAT as $contrat) {
       
        if ((int)$contrat->NumLocataire == $numLocataire) {
        $resultat[$i]=$contrat;
        $i=$i+1;    
           // Sortir de la boucle une fois que le contrat est trouvé et modifié
        }
      }

      if($resultat){
        echo '<br> <br>
        <h2>Liste de(s) contrat(s) du locataire choisi</h2>
        <br>
        <table class="table table-striped" id="tableau">';
        echo '<tr><th>Numéro de contrat</th><th>Etat</th><th>Date de création</th><th>Date de début</th><th>Date de fin</th><th>Numéro de location</th><th>Numéro du locataire</th></tr>';
    // Affichage de chaque news dans le tableau
foreach ($resultat as $contrat) {
    // Afficher le tableau
   
    
    echo '<tr>';
    echo '<td>'.$contrat->NumContrat.'</td>';
    echo '<td>'.$contrat->Etat.'</td>';
    echo '<td>'.$contrat->DateCreation.'</td>';
    echo '<td>'.$contrat->DateDebut.'</td>';
    echo '<td>'.$contrat->Datefin.'</td>';
    echo '<td>'.$contrat->NumLocation.'</td>';
    echo '<td>'.$contrat->NumLocataire.'</td>';
    echo '<td>';
    echo '</tr>';
}
      }

else echo "Ce locataire n'a pas de contrat. ";


} else {
  echo "<p>Aucun numéro de locataire spécifié.</p>";
}
?>
</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
</body>
</html>
