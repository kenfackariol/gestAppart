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
if (isset($_GET['num'])) {
    $xmlFile = '../donnees/gesap.xml';

            // Charger le fichier XML
    $xml = simplexml_load_file($xmlFile);

    $num = $_GET['num'];
    $resultat=array();
    $i=0;
    foreach ($xml->APPARTEMENTS->APPARTEMENT as $appartement) {
       
        if ((int)$appartement->Num == $num) {
        $resultat[$i]=$appartement;
        $i=$i+1;    
           // Sortir de la boucle une fois que le contrat est trouvé et modifié
        }
      }

      if($resultat){
        echo "<br> <br>
        <h2>Liste de(s) appartement(s) du propriétaire choisi</h2>
        <br>
        <table class='table table-striped'>    
        <thead>
            <tr>
                <th>Numero de Location</th>
                <th>Categorie</th>
                <th>Type</th>
                <th>Nombre de personnes</th>
                <th>Adresse de location</th>
                <th>Photo</th>
                <th>Equipements</th>
                <th>Code du tarif</th>
                <th>Numero du proprietaire</th>
            </tr>
          </thead>
          <tbody>";
    // Affichage de chaque news dans le tableau
foreach ($resultat as $appartement) {
        
        echo '<tr>';
        echo '<td>'.$appartement->NumLocation.'</td>';
        echo '<td>'.$appartement->Categorie.'</td>';
        echo '<td>'.$appartement->Type.'</td>';
        echo '<td>'.$appartement->NbPersonnes.'</td>';
        echo '<td>'.$appartement->AdresseLocation.'</td>';
        $photo="../presentation/".$appartement->photo;
        echo '<td style="width: 600px;"><img style="width: 100%;" src="'.$photo.'"/></td>';
        echo '<td>'.$appartement->Equipements.'</td>';
        echo '<td>'.$appartement->CodeTarif.'</td>';
        echo '<td>'.$appartement->Num.'</td>';
        echo '<td>';
        echo '</tr>';
    }
}

else echo "L'appartement de ce propriétaire n'a pas encore été enregistré. ";


} else {
  echo "<p>Aucun numéro de propriétaire spécifié.</p>";
}
?>
</tbody>
</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
</body>
</html>
