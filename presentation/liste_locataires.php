
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des locataires</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style> body{ font-family: cursive;} </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
<br><h1 style="font-family: cursive; text-align:center; font-weight:bold; color: red;">Rechercher Locataire</h1><br>
<form method="POST" action="">

    <div class="form-group">
        <label for="rechercher"></label>
        <input type="text" class="form-control" id="rechercher" name="rechercher" placeholder="Rechercher un locataire selon le nom..." >
    </div>

</form>
</div>
</div>
</div>
<br>
<br>
<h2>Liste des locataires</h2>

<?php
// Charger le contenu du fichier XML

$xmlFile = '../donnees/gesap.xml';

            // Charger le fichier XML
$xml = simplexml_load_file($xmlFile);

// Récupérer tous les locataires
$locataires = $xml->LOCATAIRES->LOCATAIRE;

// Afficher le tableau
echo '<table class="table table-striped" id="tableau">';
echo '<tr><th>Numéro Locataire</th><th>Nom</th><th>Prénom</th><th>Adresse</th><th>Code Postal</th><th>Ville</th><th>Numéro de Téléphone</th><th>Email</th><th>Action</th></tr>';

foreach ($locataires as $locataire) {
    $numLocataire = $locataire->NumLocataire;
    $nom = $locataire->NomLocataire;
    $prenom = $locataire->PrenomLocataire;
    $adresse = $locataire->Adresse1Locataire;
    $codePostal = $locataire->CodePostalLocataire;
    $ville = $locataire->VilleLocataire;
    $telephone = $locataire->NumTel1Locataire;
    $email = $locataire->EmailLocataire;

    echo '<tr>';
    echo "<td>$numLocataire</td>";
    echo "<td>$nom</td>";
    echo "<td>$prenom</td>";
    echo "<td>$adresse</td>";
    echo "<td>$codePostal</td>";
    echo "<td>$ville</td>";
    echo "<td>$telephone</td>";
    echo "<td>$email</td>";
    echo "<td><a class='btn btn-primary' href='../traitement/voir_contrat.php?numLocataire=$numLocataire'>Voir le(s) contrat(s)</a></td>";
    echo '</tr>';
}

echo '</table>';
?>

</tbody>
</table>
</div>
</div>
</div>
<script>
// Récupérer l'élément de recherche
var searchInput = document.getElementById("rechercher");

// Ajouter un gestionnaire d'événements pour détecter les changements dans la barre de recherche
searchInput.addEventListener("input", function(event) {
  var searchTerm = event.target.value.toLowerCase(); // Convertir la saisie en minuscules pour une recherche insensible à la casse
  var tableau=document.getElementById("tableau");
  // Parcourir chaque ligne du tableau et afficher/masquer en fonction de la correspondance avec le terme de recherche
  for (var i = 0; i < tableau.rows.length; i++) {
    var row = tableau.rows[i];
    var name = row.cells[1].textContent.toLowerCase(); // Supposer que le nom du locataire est dans la deuxième cellule
    
    if (name.includes(searchTerm)) {
      row.style.display = ""; // Afficher la ligne si le terme de recherche est inclus dans le nom
    } else {
      row.style.display = "none"; // Masquer la ligne sinon
    }
  }
});

</script>
<!-- Ajout du CDN de Bootstrap 5 pour les scripts Javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>
